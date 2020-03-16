<?php

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserData;
use App\Domain\User\Repository\UserRepository;
use UnexpectedValueException;

/**
 * Service.
 */
final class UserCreator
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
     * Create a new user.
     *
     * @param UserData $user The user data
     *
     * @return int The new user ID
     */
    public function createUser(UserData $user): int
    {
        // Validation
        if (empty($user->username)) {
            throw new UnexpectedValueException('Username required');
        }

        // Insert user
        $userId = $this->repository->insertUser($user);

        return $userId;
    }
}
