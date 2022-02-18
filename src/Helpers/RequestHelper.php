<?php

namespace CodingMonkeys\DashboardConnector\Helpers;

use Illuminate\Support\Facades\Http;

class RequestHelper
{
    public function pushApplicationData($deployment = false)
    {
        if (is_null(config('dashboard-connector.site_token'))) {
            if ($deployment == false) {
                $this->error('No site token available!');
            }

            return;
        }

        $data = [
            'token' => config('dashboard-connector.site_token'),
            'laravel_version' => app()->version(),
            'php_version' => phpversion(),
        ];

        if ($deployment) {
            $data['deployed_at'] = now();
        }

        Http::put('https://dashboard.codingmonkeys.nl/api/v1/update', $data);
    }
}
