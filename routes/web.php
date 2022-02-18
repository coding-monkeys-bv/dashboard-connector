<?php

use CodingMonkeys\DashboardConnector\Helpers\RequestHelper;
use Illuminate\Support\Facades\Route;

Route::get('coding-monkeys/connector/refresh', function () {
    $requestHelper = new RequestHelper();
    $requestHelper->pushApplicationData();
});
