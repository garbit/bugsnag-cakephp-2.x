<?php

// Bugsnag API
Configure::write('bugsnag_api_key', YOUR_BUGSNAG_API_KEY_HERE);

// Add these two lines at the bottom of your bootstrap.php file
App::import('Vendor', array('file' => 'autoload'));
App::import('vendors', array('file' => 'BugsnagErrorHandler'));
