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
    }

    public function signup(Request $request)
    {
        $username = $request->get('username');
        $email = $request->get('email');
        $password = $request->get('password');
        return response()->json(["created" => $this->authService->signup($username, $password, $email)]);
    }
}
