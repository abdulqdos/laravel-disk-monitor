<?php

namespace AbdulqdosAlabinie\LaravelDiskMonitor\Http\Controllers;

use Illuminate\Routing\Controller;
use AbdulqdosAlabinie\LaravelDiskMonitor\Models\DiskMonitorEntry;

class DiskMetricsController extends Controller
{
    public function __invoke()
    {
        $entries = DiskMonitorEntry::latest()->get();

        return view('disk-monitor::entries', compact('entries'));
    }
}
