<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class AuthController extends Controller
{
    private $authService;


    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
        $this->middleware('auth', ['only' => [
            'logout'
        ]]);
    }


    public function login(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        $res = null;

        $user = $this->authService->checkEmailOrUsernameExist($username);
        if ($user !== null) {
            $serviceRes = $this->authService->login($user, $password);
            if ($serviceRes) {
                $res = ['token' => $serviceRes, "message" => 'Successfully Logged'];
            } else {
                $res = ['token' => null, "message" => 'Wrong Password'];
            }
        } else {
            $res = ['token' => null, 'message' => 'Account does not exist'];
        }
        return response()->json($res);
    }

    public function checkToken(Request $request)
    {
        $res = $this->authService->checkToken($request->input('token'));
        return response()->json(['valid' => $res]);
    }

    public function logout()
    {
        return response()->json(["disconnected" => $this->authService->logout()]);
    }

}
