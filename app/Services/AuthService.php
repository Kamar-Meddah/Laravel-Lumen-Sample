<?php

namespace App\Services;

use App\Models\User;
use Exception;

class AuthService
{

    public function signin(?string $username, ?string $email, string $password)
    {
        try {
            if ($email) {
                $user = User::all()->where('email', '=', $username)->first();
            } else {
                $user = User::all()->where('username', '=', $username)->first();
            }

                if (password_verify($password, $user)) {
                    $array = $user;
                    $a = JWT::encode($array, env('APP_KEY'), 'HS256');
                    $user->token = $a;
                    $user->save();
                }


        } catch (Exception $e) {
            return 'do not exist';
        }
    }

    public function findWith(string $column, string $value): bool
    {
        return User::all()->where($column, '=', $value)->first() !== null;
    }

}