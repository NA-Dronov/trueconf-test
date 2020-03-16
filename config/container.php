<?php

use Psr\Container\ContainerInterface;
use Selective\Config\Configuration;
use Slim\App;
use Slim\Factory\AppFactory;

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

];
