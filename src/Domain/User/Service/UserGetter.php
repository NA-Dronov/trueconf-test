<?php

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserData;
use App\Domain\User\Repository\UserRepository;
use UnexpectedValueException;

/**
 * Service.
 */
final class UserGetter
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
     * Get user.
     *
     * @param int $user_id The user ID
     *
     * @return UserData The user data
     */
    public function getUser(int $user_id): UserData
    {
        // Get user
        $user = $this->repository->getUser($user_id);

        return $user;
    }
}
