<?php

    spl_autoload_register(function ($class) {

        $directories = [
        '/application/',
        '/models/',
        '/views/',
        '/controllers/'
        ];

        foreach ($directories as $directory) {

            $filePath = $_SERVER['DOCUMENT_ROOT'] . $directory . $class . '.class.php';

            if (file_exists($filePath)) {

                require_once $filePath;
                break;

            }

        }

    });
