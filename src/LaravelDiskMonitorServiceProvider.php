<?php

namespace AbdulqdosAlabinie\LaravelDiskMonitor;

use AbdulqdosAlabinie\LaravelDiskMonitor\Http\Controllers\DiskMetricsController;
use AbdulqdosAlabinie\LaravelDiskMonitor\Models\DiskMonitorEntry;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use AbdulqdosAlabinie\LaravelDiskMonitor\Commands\RecordDiskMetricsCommand;

class LaravelDiskMonitorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-disk-monitor')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_disk_monitor_table')
            ->hasCommand(RecordDiskMetricsCommand::class);


    }

    public function packageRegistered(): void
    {
        Route::macro('diskMonitor', function (string $prefix) {
            Route::prefix($prefix)->group(function () {
                Route::get('/' , [DiskMetricsController::class , '__invoke']);
            });
        });
    }
}
