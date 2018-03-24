<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Auth;

class AuthService
{

    public function login(User $user, string $password)
    {
        try {
            if (password_verify($password, $user->password)) {
                $array = [
                    "iss" => $user->username,
                    "sub" => $user->id,
                    "iat" => time(),
                    "exp" => time() + 60 * 60 * 24,
                    'jti' => uniqid(),
                    'role' => $user->role,
                ];
                $jwtToken = JWT::encode($array, env('APP_KEY'), 'HS256');
                $user->token = $jwtToken;
                $user->saveOrFail();
                return $jwtToken;
            } else {
                return null;
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

    public function checkResetToken(string $code): ?User
    {
        return $this->findWith('reset_token', $code);
    }

    public function setResetToken(User $user, string $token): bool
    {
        try {
            $user->reset_token = $token;
            return $user->saveOrFail();
        } catch (Exception $e) {
            return true;
        }
    }

    public function checkToken(string $token)
    {
        try {
            JWT::decode($token, env('APP_KEY'), ['HS256']);
            $user = User::all()->where('token', '=', $token)->first();
            return $user !== null;
        } catch (Exception $e) {
            return false;
        }
    }

    public function logout()
    {
        try {
            Auth::user()->token = null;
            return Auth::user()->saveOrFail();
        } catch (Exception $e) {
            return false;
        }
    }

    public function changePassword(User $user, string $password): bool
    {
        try {
            $user->password = $this->generateHash($password);
            $user->reset_token = null;
            return $user->saveOrFail();
        } catch (Exception $e) {
            return false;
        }
    }

    private function generateHash(string $value): string
    {
        return password_hash($value, PASSWORD_BCRYPT);
    }

}