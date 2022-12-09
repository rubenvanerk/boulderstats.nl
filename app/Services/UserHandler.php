<?php

namespace App\Services;

use Cookie;

class UserHandler
{
    public function getUsers(): array
    {
        return unserialize(Cookie::get('userIds')) ?: [];
    }

    public function addUser(int $userId): void
    {
        $users = $this->getUsers();
        if (!in_array($userId, $users, true)) {
            $users[] = $userId;
        }
        Cookie::queue('userIds', serialize($users));
    }

    public function removeUser(int $userId): void
    {
        $users = $this->getUsers();
        $users = array_diff($users, [$userId]);
        Cookie::queue('userIds', serialize($users));
    }
}
