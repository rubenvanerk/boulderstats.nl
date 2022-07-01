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

        if (is_array($userAttributes['ascends'])) {
            $userAttributes['ascends'] = collect($userAttributes['ascends']);
        }

        return new User($userAttributes);
    }
}
