<?php

use Slim\App;

return function (App $app) {
    $app->get('/', \App\Action\HomeAction::class);
    $app->get('/users', \App\Action\UserGetListAction::class);
    $app->get('/users/{id}', \App\Action\UserGetAction::class);
    $app->post('/users', \App\Action\UserCreateAction::class);
    $app->delete('/users/{id}', \App\Action\UserDeleteAction::class);
    $app->patch('/users/{id}', \App\Action\UserUpdateAction::class);
};
