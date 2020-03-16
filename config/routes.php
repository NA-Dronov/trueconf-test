<?php

use Slim\App;
use Slim\Http\ServerRequest;
use Slim\Http\Response;

return function (App $app) {
    $app->get('/', function (ServerRequest $request, Response $response) {
        $response->getBody()->write('Hello, World!');

        return $response;
    });
};
