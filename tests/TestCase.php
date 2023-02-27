<?php

namespace CodingMonkeys\DashboardConnector\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use CodingMonkeys\DashboardConnector\DashboardConnectorServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            DashboardConnectorServiceProvider::class,
        ];
    }
}
