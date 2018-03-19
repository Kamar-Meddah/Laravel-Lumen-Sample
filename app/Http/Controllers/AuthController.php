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



    public function signin(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        $res =null;

        if (preg_match('/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/', $username)) {
            $res = $this->authService->signin(null,$username,$password);
        } else {
            $res = $this->authService->signin($username,null,$password);
        }

        return response()->json(['token'=>$res]);
    }
}
