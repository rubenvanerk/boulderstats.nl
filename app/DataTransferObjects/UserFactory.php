<?php

namespace App\DataTransferObjects;

class UserFactory
{
    public static function make(array $userAttributes): User
    {
        if (isset($userAttributes['fullName'])) {
            $userAttributes['full_name'] = $userAttributes['fullName'];
        }

        if (isset($userAttributes['scoreCount'])) {
            $userAttributes['score_count'] = $userAttributes['scoreCount'];
        }

        return new User($userAttributes);
    }
}
