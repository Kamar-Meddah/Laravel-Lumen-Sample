<?php

namespace App\Services;

use App\Models\User;
use Exception;

class AuthService
{
    public function signup($username, $password, $email)
    {
        try {
            $usernameExist = User::all()->where('username', '=', $username)->first();
            if ($usernameExist !== null) {
                return 'username exist';
            }
            $emailExist = User::all()->where('email', '=', $email)->first();
            if ($emailExist !== null) {
                return 'email exist';
            }
            $user = new User();
            $user->username = $username;
            $user->email = $email;
            $user->password = password_hash($password, 1);
            return $user->saveOrFail();
        } catch (Exception $e) {
            return false;
        }
    }
}