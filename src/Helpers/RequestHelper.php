<?php

namespace CodingMonkeys\DashboardConnector\Helpers;

use Illuminate\Support\Facades\Http;

class RequestHelper
{
    public function pushApplicationData($deployment = false)
    {
        // Return when no site token is available.
        if (is_null(config('dashboard-connector.site_token'))) {
            return;
        }

        // Collect app data.
        $data = [
            'token' => config('dashboard-connector.site_token'),
            'laravel_version' => app()->version(),
            'php_version' => phpversion(),
            'pinged_at' => now()->format('Y-m-d H:i:s'),
        ];

        // Only add deployed at timestamp when this request
        // has been triggered via a deployment.
        if ($deployment) {
            $data['deployed_at'] = now()->format('Y-m-d H:i:s');
        }

        $domain = app()->isLocal()
            ? 'dashboard.test'
            : 'dashboard.codingmonkeys.nl';

        // Send data to dashboard.
        Http::put('https://'.$domain.'/api/v1/update', $data);
    }
}
