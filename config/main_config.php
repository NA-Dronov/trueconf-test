<?php

// Error reporting
error_reporting(0);
ini_set('display_errors', '0');

$config = [];
// App Path Settings
$config['root'] = dirname(__DIR__);
$config['public'] = $config['root'] . DIRECTORY_SEPARATOR . 'public';
$config['temp'] = $config['root'] . DIRECTORY_SEPARATOR . 'var';
$config['json_location'] = $config['root'] . DIRECTORY_SEPARATOR . 'database';
// URL Settings
$config['base_path'] = '/trueconf-test';

// Error Handling Middleware settings
$config['error_handler_middleware'] = [

    // Should be set to false in production
    'display_error_details' => true,

    // Parameter is passed to the default ErrorHandler
    // View in rendered output by enabling the "displayErrorDetails" setting.
    // For the console and unit tests we also disable it
    'log_errors' => true,

    // Display error details in error log
    'log_error_details' => true,
];

return $config;
