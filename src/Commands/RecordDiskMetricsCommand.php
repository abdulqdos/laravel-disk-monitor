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
        collect(config('disk-monitor.disk_names'))->each(fn (string $diskName) => $this->recordMetrics($diskName));
        $this->comment('All done');

        return self::SUCCESS;
    }

    protected function recordMetrics(string $diskName): void
    {
        $this->info("Recording metrics for $diskName");
        $disk = Storage::disk($diskName);
        $filesCount = count($disk->allFiles());

        DiskMonitorEntry::create([
            'disk_name' => $diskName,
            'file_count' => $filesCount,
        ]);
    }
}
