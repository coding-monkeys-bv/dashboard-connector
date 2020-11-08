<?php

namespace CodingMonkeys\DashboardConnector\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateVersionCommand extends Command
{
    protected $signature = 'command:cm-update';
    protected $description = 'Update application data at Coding Monkeys dashboard.';

    public function handle()
    {
        if (is_null(config('dashboard-connector.site_token'))) {
            $this->error('No site token available!');

            return;
        }

        Http::put('https://dashboard.codingmonkeys.nl/api/v1/update', [
            'token' => config('dashboard-connector.site_token'),
            'version' => app()->version(),
        ]);
    }
}
