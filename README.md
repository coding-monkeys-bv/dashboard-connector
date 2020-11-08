# Coding Monkeys dashboard connector  

This package provides a connection with the Coding Monkeys API.  
In order to use this package, a token should be provided by Coding Monkeys.  

## Installation  

Require the package using composer:  

```bash
composer require codingmonkeys/dashboard-connector
```

## Usage

Publish the config file by using:  

```bash
php artisan vendor:publish --provider="CodingMonkeys\DashboardConnector\DashboardConnectorServiceProvider" --tag=dashboard-connector:config
```

Add environment variable:  

CM_SITE_ENV_TOKEN=""  

Send application details to the Coding Monkeys dashboard:  

```bash
php artisan command:cm-update
```