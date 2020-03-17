<?php

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserData;
use App\Domain\User\Repository\UserRepository;
use UnexpectedValueException;

/**
 * Service.
 */
final class UsersListGetter
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param UserRepository $repository The repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get users.
     *
     * @return array The users array
     */
    public function getUsers($query): array
    {
        // Get users
        $users = $this->repository->getUsers($query);

        return $users;
    }
}
