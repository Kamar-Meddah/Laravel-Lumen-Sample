<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Firebase\JWT\JWT;

class AuthService
{

    public function login(User $user, string $password)
    {
        try {
            if (password_verify($password, $user->password)) {
                $array = $user;
                $jwtToken = JWT::encode($array, env('APP_KEY'), 'HS256');
                $user->token = $jwtToken;
                $user->saveOrFail();
                return $jwtToken;
            }else{
                return false;
            }
        } catch (Exception $e) {
            return null;
        }
    }

    public function checkEmailOrUsernameExist(string $username): ?User
    {
        if (preg_match('/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/', $username)) {
            return $this->findWith('email', $username);
        } else {
            return $this->findWith('username', $username);
        }
    }

    private function findWith(string $column, string $value): ?User
    {
        return User::all()->where($column, '=', $value)->first();
    }

}