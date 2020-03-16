<?php

namespace App\Action;

use App\Domain\User\Service\UserGetter;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class UserGetAction
{
    private $userGetter;

    public function __construct(UserGetter $userGetter)
    {
        $this->userGetter = $userGetter;
    }

    public function __invoke(ServerRequest $request, Response $response, $args): Response
    {
        // Get id from the route args
        $id = intval($args['id']);

        if (is_array($args['id']) || $id < 1) {
            return $response->withJson(['message' => 'Invalid user_id'])->withStatus(404);
        }

        // Invoke the Domain with inputs and retain the result
        $user = $this->userGetter->getUser($id);

        // Build the HTTP response
        if (!is_null($user->user_id)) {
            return $response->withJson($user)->withStatus(201);
        } else {
            return $response->withJson(['message' => 'User not found'])->withStatus(404);
        }
    }
}
