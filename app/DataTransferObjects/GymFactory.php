<?php

namespace App\DataTransferObjects;

class GymFactory
{
    public static function make(array $userAttributes): Gym
    {
        if (isset($userAttributes['idName'])) {
            $userAttributes['id_name'] = $userAttributes['idName'];
        }

        return new Gym($userAttributes);
    }
}
