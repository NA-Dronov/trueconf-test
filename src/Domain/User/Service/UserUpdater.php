<?php

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserData;
use App\Domain\User\Repository\UserRepository;
use UnexpectedValueException;

/**
 * Service.
 */
final class UserUpdater
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
     * Update user.
     *
     * @param UserData $user The user data
     * @param int $id The user id
     *
     * @return bool true if success, false otherwise
     */
    public function updateUser(UserData $user, int $id): bool
    {
        // Validation
        if (empty($user->username)) {
            throw new UnexpectedValueException('Username required');
        }

        // Update user
        $result = $this->repository->updateUser($user, $id);

        return $result;
    }
}
