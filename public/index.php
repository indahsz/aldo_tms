<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Perbaiki path untuk maintenance mode
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Sesuaikan path vendor
require __DIR__.'/../vendor/autoload.php';

// Sesuaikan path bootstrap Laravel
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
