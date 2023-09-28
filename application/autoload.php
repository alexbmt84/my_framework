<?php

    function getAllDirectories($baseDir): array {

        $directories = [];

        foreach (scandir($baseDir) as $file) {

            if ($file === '.' || $file === '..') continue;

            if (is_dir($baseDir . DIRECTORY_SEPARATOR . $file)) {
                $directories[] = $file;
            }

        }

        return $directories;

    }

    $directories = getAllDirectories($_SERVER['DOCUMENT_ROOT'] . BASE_URI);

    function recursive_autoload($pattern = ROOT. DIRECTORY_SEPARATOR .'*') : void {

        foreach (glob($pattern, GLOB_MARK) as $item) {

            if (str_ends_with($item, DIRECTORY_SEPARATOR)) {

                recursive_autoload("$item*");

            } else if(str_ends_with($item, '.class.php')) {

                require_once $item;

            }

        }

    }

    spl_autoload_register(function () use ($directories) {

        recursive_autoload();

    });