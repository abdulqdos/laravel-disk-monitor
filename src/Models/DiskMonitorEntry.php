<?php

namespace AbdulqdosAlabinie\LaravelDiskMonitor\Models;

use Illuminate\Database\Eloquent\Model;

class DiskMonitorEntry extends Model
{
    public $guarded = [];

    public $casts = [
        'file_count' => 'integer',
    ];

    public static function last()
    {
        return static::orderByDesc('id')->first();
    }
}
