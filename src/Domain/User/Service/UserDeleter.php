<?php

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserData;
use App\Domain\User\Repository\UserRepository;
use UnexpectedValueException;

/**
 * Service.
 */
final class UserDeleter
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
     * Delete user.
     *
     * @param UserData $user The user data
     * @param int $user_id The user ID
     *
     * @return bool true if success, false otherwise
     */
    public function deleteUser(int $user_id): bool
    {
        $result = $this->repository->deleteUser($user_id);

        return $result;
    }
}
