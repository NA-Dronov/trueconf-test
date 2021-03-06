<?php

namespace App\Action;

use App\Domain\User\Data\UserData;
use App\Domain\User\Service\UserCreator;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class UserCreateAction
{
    private $userCreator;

    public function __construct(UserCreator $userCreator)
    {
        $this->userCreator = $userCreator;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        // Mapping
        $user = new UserData($data);

        // Invoke the Domain with inputs and retain the result
        $userId = $this->userCreator->createUser($user);

        // Build the HTTP response
        return $response->withJson(['user_id' => $userId])->withStatus(201);
    }
}
