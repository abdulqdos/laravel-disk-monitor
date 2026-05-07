<?php

it('can return a view' , function () {
    Route::diskMonitor('');
    $this->get('/')->assertOk()->assertViewIs('disk-monitor::entries');
});
