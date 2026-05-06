<?php

namespace AbdulqdosAlabinie\LaravelDiskMonitor\Commands;

use AbdulqdosAlabinie\LaravelDiskMonitor\Models\DiskMonitorEntry;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RecordDiskMetricsCommand extends Command
{
    public $signature = 'laravel-disk-monitor:record-metrics';

    public $description = 'My command';

    public function handle(): int
    {

        $this->comment('Recording metrics');
        $diskName = config('disk-monitor.disk_name');

        $filesCount = count(Storage::disk($diskName)->allFiles());

        DiskMonitorEntry::create([
            'disk_name' => $diskName,
            'file_count' => $filesCount
        ]);

        $this->comment('All done');

        return self::SUCCESS;
    }
}
