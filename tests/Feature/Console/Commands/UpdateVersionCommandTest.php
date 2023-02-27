<?php

use CodingMonkeys\DashboardConnector\Console\Commands\UpdateVersionCommand;
use CodingMonkeys\DashboardConnector\Helpers\RequestHelper;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

use function Pest\Laravel\artisan;

beforeEach(function() {
    Http::fake([
        'https://dashboard.codingmonkeys.nl/api/v1/update' => Http::response(200)
    ]);
});

it('runs the command during a deployment', function () {

    config()->set('dashboard-connector.site_token', 'test-token');

    artisan(UpdateVersionCommand::class, ['deployment' => true])
        ->assertExitCode(0);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://dashboard.codingmonkeys.nl/api/v1/update'
            && $request->method() === 'PUT'
            && $request['token'] === 'test-token'
            && $request['laravel_version'] === app()->version()
            && $request['php_version'] === phpversion()
            && ! is_null($request['pinged_at'])
            && ! is_null($request['deployed_at']); // Send deployed at attribute during a deployment
    });
});

it('runs the command when it received a ping request', function () {

    config()->set('dashboard-connector.site_token', 'test-token');

    $this->get('coding-monkeys/connector/refresh');

    Http::assertSent(function ($request) {
        return $request->url() === 'https://dashboard.codingmonkeys.nl/api/v1/update'
            && $request->method() === 'PUT'
            && $request['token'] === 'test-token'
            && $request['laravel_version'] === app()->version()
            && $request['php_version'] === phpversion()
            && ! is_null($request['pinged_at'])
            && ! isset($request['deployed_at']); // Don't send deployed at attribute sduring a ping request.
    });
});

it('fails when no site token is set', function () {

    config()->set('dashboard-connector.site_token', null);

    artisan(UpdateVersionCommand::class)
        ->expectsOutput('No site token specified')
        ->assertExitCode(1);

    Http::assertNothingSent();
});