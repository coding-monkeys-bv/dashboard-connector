<?php

namespace CodingMonkeys\DashboardConnector\Console\Commands;

use CodingMonkeys\DashboardConnector\Helpers\RequestHelper;
use Illuminate\Console\Command;

class UpdateVersionCommand extends Command
{
    protected $signature = 'command:cm-update';
    protected $description = 'Update application data at Coding Monkeys dashboard.';

    public function handle()
    {
        $requestHelper = new RequestHelper();
        $requestHelper->pushApplicationData(true);
    }
}
