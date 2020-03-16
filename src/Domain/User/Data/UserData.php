<?php

namespace App\Domain\User\Data;

final class UserData
{
    /** @var int */
    public $user_id;

    /** @var string */
    public $username;

    /** @var string */
    public $first_name;

    /** @var string */
    public $last_name;

    /** @var string */
    public $email;

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            foreach ($data as $property_name => $property_value) {
                if (property_exists($this, $property_name)) {
                    $this->$property_name = $property_value;
                }
            }
        }
    }
}
