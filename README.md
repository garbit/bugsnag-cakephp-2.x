# Bugsnag Error Reporting for Cakephp 2.x

This library integrates the Bugsnag error reporting library into your CakePHP 2.x project using composer install provided by https://bugsnag.com

## Getting Started
1. Register with [Bugsnag](https://bugsnag.com) and grab yourself an API key
2. Install the [Bugsnag library](https://docs.bugsnag.com/platforms/php/other) using composer
3. Setup your project with the Bugsnag credentials and import statements in `bootstrap.php`, add the `BugsnagErrorHandler.php` class under `app/vendors`, and define new error handlers in and `core.php`

## Install the Bugsnag Library
Install the Bugsnag library via Composer ([see official docs](https://docs.bugsnag.com/platforms/php/other/))

Open terminal and cd into `your_project_repo/app` and add requirement via composer

    composer require "bugsnag/bugsnag:^3.0"

Then run composer to download and install the bugsnag official library

    composer install

You should now have a new directory under `your_project_repo/app/vendor` with the bugsnag library and associated dependancies in.

Now you need to set up your project with the `BugsnapErrorHandler.php` class and make edits to the `bootstrap.php` and `core.php` configs

## Setup Bugsnag in Cakephp
After installing the Bugsnag library via composer you need to edit two files: `bootstrap.php` and `core.php`.

Edit `app/Config/bootstrap.php` to include the API key provided by Bugsnag and include the `BugsnagErrorHandler.php` and `autoloader` via the `App::import()` function at the bottom of `bootstrap.php`.

```php
// Enter your own Bugsnag API key in bootstrap.php
Configure::write('bugsnag_api_key', YOUR_BUGSNAG_API_KEY_HERE);

// Add these two lines at the bottom of your bootstrap.php file
App::import('Vendor', array('file' => 'autoload'));
App::import('vendors', array('file' => 'BugsnagErrorHandler'));
```

Edit `app/Config/core.php` to override the default CakePHP `Exception` and `Error` handler class. Make sure to remove the existing `Exception` and `Error` configure options and replace them with the two lines below.

```php
Configure::write('Exception', array(
    'handler' => 'BugsnagErrorHandler::handleException',
    'renderer' => 'ExceptionRenderer',
    'log' => true
));

Configure::write('Error', array(
    'handler' => 'BugsnagErrorHandler::handleError',
    'level' => E_ALL & ~E_DEPRECATED,
    'trace' => true
));
```

You should now begin seeing bug reports in the bugsnag console.

Success!

## Prerequisites
* [Composer](https://getcomposer.org) - a tool for dependency management in PHP
* [Cakephp 2.x](https://cakephp.org) - a rapid development framework for PHP

## Authors
Andy Garbett - [@garbit](https://twitter.com/garbit)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
