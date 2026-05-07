<?php

namespace AbdulqdosAlabinie\LaravelDiskMonitor\Http\Controllers;

use AbdulqdosAlabinie\LaravelDiskMonitor\Models\DiskMonitorEntry;
use Illuminate\Routing\Controller;

class DiskMetricsController extends Controller
{
    public function __invoke()
    {
        $entries = DiskMonitorEntry::latest()->get();

        return view('disk-monitor::entries', compact('entries'));
    }
}
