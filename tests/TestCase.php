<?php

namespace CodingMonkeys\DashboardConnector\Tests;

use CodingMonkeys\DashboardConnector\DashboardConnectorServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            DashboardConnectorServiceProvider::class,
        ];
    }
}
