<?php

namespace App\Action;

use App\Domain\User\Data\UserData;
use App\Domain\User\Service\UserDeleter;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class UserDeleteAction
{
    private $userDeleter;

    public function __construct(UserDeleter $userDeleter)
    {
        $this->userDeleter = $userDeleter;
    }

    public function __invoke(ServerRequest $request, Response $response, $args): Response
    {
        // Get id from the route args
        $id = intval($args['id']);

        if (is_array($args['id']) || $id < 1) {
            return $response->withJson(['message' => 'Invalid user_id'])->withStatus(404);
        }

        // Invoke the Domain with inputs and retain the result
        $result = $this->userDeleter->deleteUser($id);

        // Build the HTTP response
        return $response->withJson(['result' => $result])->withStatus(201);
    }
}
