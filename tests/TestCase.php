<?php

namespace AbdulqdosAlabinie\LaravelDiskMonitor\Tests;

use AbdulqdosAlabinie\LaravelDiskMonitor\LaravelDiskMonitorServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'AbdulqdosAlabinie\\LaravelDiskMonitor\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelDiskMonitorServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        //        config()->set('database.default', 'testing');
        Schema::dropAllTables();
        $migration = include_once __DIR__.'/../database/migrations/create_disk_monitor_entries_table.php.stub';
        $migration->up();
        /*
         foreach (\Illuminate\Support\Facades\File::allFiles(__DIR__ . '/../database/migrations') as $migration) {
            (include $migration->getRealPath())->up();
         }
         */

        //        Route::diskMonitor('disk-monitor');
    }
}
