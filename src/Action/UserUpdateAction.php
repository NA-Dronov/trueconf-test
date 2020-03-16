<?php

namespace App\Action;

use App\Domain\User\Data\UserData;
use App\Domain\User\Service\UserUpdater;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class UserUpdateAction
{
    private $userUpdater;

    public function __construct(UserUpdater $userUpdater)
    {
        $this->userUpdater = $userUpdater;
    }

    public function __invoke(ServerRequest $request, Response $response, $args): Response
    {
        // Get id from the route args
        $id = intval($args['id']);

        if (is_array($args['id']) || $id < 1) {
            return $response->withJson(['message' => 'Invalid user_id'])->withStatus(404);
        }

        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        // Mapping
        $user = new UserData($data);

        // Invoke the Domain with inputs and retain the result
        $result = $this->userUpdater->updateUser($user, $id);

        // Build the HTTP response
        return $response->withJson(['result' => $result])->withStatus(201);
    }
}
