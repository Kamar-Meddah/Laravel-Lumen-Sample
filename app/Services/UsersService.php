<?php

namespace App\Services;

use App\Models\User;

class UsersService
{
    public function create(string $username, string $email, string $password): bool
    {
        try {
            $user = new User();
            $user->username = $username;
            $user->email = $email;
            $user->password = password_hash($password, PASSWORD_BCRYPT);
            return $user->saveOrFail();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function findWith(string $column, string $value): bool
    {
        return User::all()->where($column, '=', $value)->first() !== null;
    }
}