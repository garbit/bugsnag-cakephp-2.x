<?php

/**
 * Configure the Error handler used to handle errors for your application. By default
 * ErrorHandler::handleError() is used. It will display errors using Debugger, when debug > 0
 * and log errors with CakeLog when debug = 0.
 * @see ErrorHandler for more information on error handling and configuration.
 */

Configure::write('Error', array(
    'handler' => 'BugsnagErrorHandler::handleError',
    'level' => E_ALL & ~E_DEPRECATED,
	'trace' => true
));

/**
 * Configure the Exception handler used for uncaught exceptions. By default,
 * ErrorHandler::handleException() is used. It will display a HTML page for the exception, and
 * while debug > 0, framework errors like Missing Controller will be displayed. When debug = 0,
 * framework errors will be coerced into generic HTTP errors.
 * @see ErrorHandler for more information on exception handling and configuration.
 */

Configure::write('Exception', array(
    'handler' => 'BugsnagErrorHandler::handleException',
	'renderer' => 'ExceptionRenderer',
	'log' => true
));
