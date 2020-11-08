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

CM_SITE_TOKEN=""  

Send application details to the Coding Monkeys dashboard:  

```bash
php artisan command:cm-update
```

## Automatic updates

Add the artisan command to the post-autoload-dump hook in composer.json for automatic updates.

```bash
"post-autoload-dump": [
    "Illuminate\\Foundation\\ComposerScripts::postAutoloadDump",
    "@php artisan package:discover --ansi",
    "@php artisan command:cm-update"
],
```