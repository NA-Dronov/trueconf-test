<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserData;
use Jajo\JSONDB;
use Selective\Config\Configuration;

/**
 * Repository.
 */
class UserRepository
{
    /**
     * @var JSONDB Json database
     */
    private $jsondb;
    private $config;

    /**
     * Constructor.
     *
     * @param JSONDB $jsondb The jsondb
     * @param Configuration $configuration The configuration object
     */
    public function __construct(JSONDB $jsondb, Configuration $configuration)
    {
        $this->jsondb = $jsondb;
        $this->config = $configuration;
    }

    /**
     * Insert user row.
     *
     * @param UserData $user The user
     *
     * @return int The new ID
     */
    public function insertUser(UserData $user): int
    {
        $index = $this->getCurrentIndex();

        $row = [
            'user_id' => $index,
            'username' => $user->username,
            'first_name' => $user->firstName,
            'last_name' => $user->lastName,
            'email' => $user->email,
        ];


        $this->jsondb->insert('users.json', $row);

        $this->increaseCurrentIndex();

        return $index;
    }

    /**
     * Update user row.
     *
     * @param UserData $user The user data
     *
     * @return bool true if success, false otherwise
     */
    public function updateUser(UserData $user, int $id): bool
    {
        $row = ['username' => $user->username];

        $fields = ['first_name' => 'first_name', 'last_name' => 'last_name', 'email' => 'email'];

        foreach ($fields as $table_name => $class_name) {
            if (!empty($user->$class_name)) {
                $row[$table_name] = $user->$class_name;
            }
        }

        $this->jsondb->update($row)
            ->from('users.json')
            ->where(['user_id' => $id])
            ->trigger();

        return true;
    }

    /**
     * Get user row.
     *
     * @param int $user_id The user id to search
     *
     * @return UserData data of found user
     */
    public function getUser(int $user_id): UserData
    {
        $fields = [
            'user_id',
            'username',
            'first_name',
            'last_name',
            'email',
        ];

        $users = $this->jsondb->select(implode(',', $fields))
            ->from('users.json')
            ->where(['user_id' => $user_id])
            ->get();

        // Collect input from the HTTP request
        $data = array_pop($users);

        // Mapping
        $user = new UserData($data);

        return $user;
    }

    /**
     * Delete user row.
     *
     * @param int $user_id The user id to delete
     *
     * @return bool true if success, false otherwise
     */
    public function deleteUser(int $user_id): bool
    {
        $this->jsondb->delete()
            ->from('users.json')
            ->where(['user_id' => $user_id])
            ->trigger();

        $user = $this->getUser($user_id);

        return !is_null($user->user_id) ? false : true;
    }

    /**
     * Get user rows.
     *
     * @return array data of found users
     */
    public function getUsers(): array
    {
        $fields = [
            'user_id',
            'username',
            'first_name',
            'last_name',
            'email',
        ];

        $users = $this->jsondb->select(implode(',', $fields))
            ->from('users.json')
            ->get();

        return $users;
    }

    private function getCurrentIndex()
    {
        $meta_file = $this->config->getString('json_location') . DIRECTORY_SEPARATOR . 'users_meta.json';
        $contents = json_decode(file_get_contents($meta_file), true);
        return $contents;
    }

    private function increaseCurrentIndex()
    {
        $meta_file = $this->config->getString('json_location') . DIRECTORY_SEPARATOR . 'users_meta.json';
        $contents = json_decode(file_get_contents($meta_file), true);
        $contents += 1;
        file_put_contents($meta_file, json_encode($contents));
    }
}
