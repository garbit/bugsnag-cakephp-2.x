<?php

class BugsnagErrorHandler extends ErrorHandler
{

    public static function handleException(Exception $exception) {

        $bugsnag = Bugsnag\Client::make(Configure::read('bugsnag_api_key'));
        $bugsnag->notifyException($exception);

        return parent::handleException($exception);
    }

    /**
     * Set as the default error handler by CakePHP. Use Configure::write('Error.handler', $callback), to use your own
     * error handling methods. This function will use Debugger to display errors when debug > 0. And
     * will log errors to CakeLog, when debug == 0.
     *
     * You can use Configure::write('Error.level', $value); to set what type of errors will be handled here.
     * Stack traces for errors can be enabled with Configure::write('Error.trace', true);
     *
     * @param integer $code Code of error
     * @param string $description Error description
     * @param string $file File on which error occurred
     * @param integer $line Line that triggered the error
     * @param array $context Context
     * @return boolean true if error was handled
     */
    public static function handleError($code, $description, $file = null, $line = null, $context = null) {

        $errorConfig = Configure::read('Error');
        list($error, $log) = self::mapErrorCode($code);
        if ($log === LOG_ERR) {
            return self::handleFatalError($code, $description, $file, $line);
        }

        $message = $error . ' (' . $code . '): ' . $description . ' in [' . $file . ', line ' . $line . ']';

        $bugsnag = Bugsnag\Client::make(Configure::read('bugsnag_api_key'));
        $bugsnag->notifyError($error, $error . ' (' . $code . '): ' . $description . ' in [' . $file . ', line ' . $line . ']');

        return parent::handleError($code, $description, $file, $line, $context);
    }

    /**
     * Generate an error page when some fatal error happens.
     *
     * @param integer $code Code of error
     * @param string $description Error description
     * @param string $file File on which error occurred
     * @param integer $line Line that triggered the error
     * @return boolean
     */
        public static function handleFatalError($code, $description, $file, $line) {

            $bugsnag = Bugsnag\Client::make(Configure::read('bugsnag_api_key'));
            $bugsnag->notifyError('FatalError', 'Fatal Error (' . $code . '): ' . $description . ' in [' . $file . ', line ' . $line . ']');

            return parent::handleFatalError($code, $description, $file, $line);

        }

    public static function mapErrorCode($code) {
        return parent::mapErrorCode($code);
    }

}

?>