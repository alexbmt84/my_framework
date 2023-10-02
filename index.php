<?php

    session_start();

    const ROOT = __DIR__;

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    define('BASE_URI', substr(__DIR__,
    strlen($_SERVER['DOCUMENT_ROOT'])));

    require_once(implode(DIRECTORY_SEPARATOR, ['application', 'autoload.php']));

    $app = new MyFramework\Core();
    $app->run();