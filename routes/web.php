<?php

use CodingMonkeys\DashboardConnector\Console\Commands\UpdateVersionCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('coding-monkeys/connector/refresh', function () {
    Artisan::call(UpdateVersionCommand::class);
});
