<?php

namespace AbdulqdosAlabinie\LaravelDiskMonitor\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AbdulqdosAlabinie\LaravelDiskMonitor\LaravelDiskMonitor
 */
class LaravelDiskMonitor extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \AbdulqdosAlabinie\LaravelDiskMonitor\LaravelDiskMonitor::class;
    }
}
