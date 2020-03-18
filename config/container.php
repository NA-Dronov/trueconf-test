<?php

use Psr\Container\ContainerInterface;
use Selective\Config\Configuration;
use Slim\App;
use Slim\Factory\AppFactory;
use Jajo\JSONDB;

return [
    Configuration::class => function () {
        return new Configuration(require __DIR__ . '/main_config.php');
    },

    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);
        $app = AppFactory::create();
        // Optional: Set the base path to run the app in a sub-directory
        // The public directory must not be part of the base path
        $app->setBasePath($container->get(Configuration::class)->getString('base_path'));

        return $app;
    },

    JSONDB::class => function (ContainerInterface $container) {
        $location = $container->get(Configuration::class)->getString('json_location');

        $db_tables = [
            'users'
        ];

        $create_table = function ($table) use ($location) {
            $loc = $location . DIRECTORY_SEPARATOR . $table;
            unlink($loc . '.json');
            unlink($loc . '_meta.json');

            if (!is_dir($location)) {
                mkdir($location);
            }

            $handle_table = fopen($loc . '.json', 'w');
            $handle_table_meta = fopen($loc . '_meta.json', 'w');
            fwrite($handle_table, json_encode([]));
            fwrite($handle_table_meta, json_encode(1));
            fclose($handle_table);
            fclose($handle_table_meta);
        };

        foreach ($db_tables as $table) {
            if (
                !file_exists($location . DIRECTORY_SEPARATOR . $table . '_meta.json')
                || !file_exists($location . DIRECTORY_SEPARATOR . $table . '.json')
            ) {
                $create_table($table);
            }
        }

        return new JSONDB($container->get(Configuration::class)->getString('json_location'));
    }
];
