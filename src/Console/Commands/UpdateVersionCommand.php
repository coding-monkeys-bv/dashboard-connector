<?php

namespace CodingMonkeys\DashboardConnector\Console\Commands;

use CodingMonkeys\DashboardConnector\Helpers\RequestHelper;
use Illuminate\Console\Command;

class UpdateVersionCommand extends Command
{
    protected $signature = 'command:cm-update {deployment?}';
    protected $description = 'Update application data at Coding Monkeys dashboard.';

    public function handle()
    {
        // Return when no site token is available.
        if (is_null(config('dashboard-connector.site_token'))) {

            $this->error('No site token specified');
            
            return Command::FAILURE;
        }

        $requestHelper = new RequestHelper();
        $requestHelper->pushApplicationData($this->argument('deployment') ?? false);

        return Command::SUCCESS;
    }
}
