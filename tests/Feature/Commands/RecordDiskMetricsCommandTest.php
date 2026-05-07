<?php

use AbdulqdosAlabinie\LaravelDiskMonitor\Commands\RecordDiskMetricsCommand;
use AbdulqdosAlabinie\LaravelDiskMonitor\Models\DiskMonitorEntry;

beforeEach(function () {
   Storage::fake('local'); // make a fake storage
    Storage::fake('anotherDisk'); // make a fake storage

});

it('will record files in a single disk', function () {
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

it('will record files in a multiple  disks', function () {

    // Set File into Disk
    Storage::disk('anotherDisk')->put('test.text', 'test');

    // Set Disks into monitor
    config()->set('disk-monitor.disk_names', ['local' , 'anotherDisk']);
    $this->artisan(RecordDiskMetricsCommand::class)->assertExitCode(0);
    $this->assertCount(2 , DiskMonitorEntry::get());

    // Define Entries
    $entries =  DiskMonitorEntry::get();

    // asserts
    $this->assertEquals('local', $entries[0]->disk_name);
    $this->assertEquals(0, $entries[0]->file_count);

    $this->assertEquals('anotherDisk', $entries[1]->disk_name);
    $this->assertEquals(1, $entries[1]->file_count);

});

