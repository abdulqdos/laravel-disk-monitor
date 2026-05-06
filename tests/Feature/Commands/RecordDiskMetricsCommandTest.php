<?php

use AbdulqdosAlabinie\LaravelDiskMonitor\Commands\RecordDiskMetricsCommand;
use AbdulqdosAlabinie\LaravelDiskMonitor\Models\DiskMonitorEntry;

beforeEach(function () {
   Storage::fake('local'); // make a fake storage
});

it('will record zero files to empty disks', function () {
    // Creat Disk
    Storage::disk('local')->put('test.text', 'test');

    // Run Command
    $this
        ->artisan(RecordDiskMetricsCommand::class)
        ->assertExitCode(0);

    // Test Disk
    $last = DiskMonitorEntry::last();
    $this->assertCount(1, DiskMonitorEntry::get());
    $this->assertEquals(1, $last->file_count);
});
