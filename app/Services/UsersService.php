<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersService
{
    public function create(string $username, string $email, string $password): bool
    {
        try {
            $user = new User();
            $user->username = $username;
            $user->email = $email;
            $user->password = $this->generateHash($password);
            return $user->saveOrFail();
        } catch (\Exception $e) {
            return false;
        }
    }

    private function generateHash(string $value): string
    {
        return password_hash($value, PASSWORD_BCRYPT);
    }

    public function findWith(string $column, string $value): bool
    {
        return User::all()->where($column, '=', $value)->first() !== null;
    }

    public function updatePassword(string $newPassword, string $oldPassword)
    {
        if ($this->checkPassword($oldPassword, Auth::user()->password)) {
            Auth::user()->password = $this->generateHash($newPassword);
            return Auth::user()->saveOrFail();
        } else {
            return false;
        }

    }

    private function checkPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}