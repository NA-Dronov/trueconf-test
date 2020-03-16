<?php

namespace App\Action;

use App\Domain\User\Service\UsersListGetter;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class UserGetListAction
{
    private $usersListGetter;

    public function __construct(UsersListGetter $usersListGetter)
    {
        $this->usersListGetter = $usersListGetter;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Invoke the Domain with inputs and retain the result
        $users = $this->usersListGetter->getUsers();

        // Build the HTTP response
        return $response->withJson($users)->withStatus(201);
    }
}
