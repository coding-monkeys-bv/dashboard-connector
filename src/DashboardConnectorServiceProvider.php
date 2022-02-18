<?php

namespace CodingMonkeys\DashboardConnector;

use CodingMonkeys\DashboardConnector\Console\Commands\UpdateVersionCommand;
use Illuminate\Support\ServiceProvider;

class DashboardConnectorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *cda.
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/dashboard-connector.php' => base_path('config/dashboard-connector.php'),
        ], 'dashboard-connector:config');

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Merge config file.
        $this->mergeConfigFrom(__DIR__.'/../config/dashboard-connector.php', 'dashboard-connector');

        // Activate commands.
        if ($this->app->runningInConsole()) {
            $this->commands([
                UpdateVersionCommand::class,
            ]);
        }
    }
}
