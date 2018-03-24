<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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


    public function reset(Request $request)
    {
        $code = $request->get('code');
        $password = $request->get('password');
        $res = false;
        $user = $this->authService->checkResetToken($code);
        if ($user !== null) {
            if ($this->authService->changePassword($user, $password)) {
                $res = ['valid' => true];
            };
        } else {
            $res = ['valid' => false];
        }
        return response()->json($res);
    }


    public function checkEmail(Request $request)
    {
        $email = $request->get('email');
        $res = null;

        $user = $this->authService->checkEmailOrUsernameExist($email);
        if ($user !== null) {
            $token = uniqid();
            $this->authService->setResetToken($user, $token);
            try {
                Mail::send(['emails.passwordReset.passwordReset', 'emails.passwordReset.passwordResetText'], ['token' => $token], function ($message) use ($email) {
                    $message->to($email)->subject('password recovery');
                });
            } catch (Exception $e) {
            }
            $res = ['valid' => true];
        } else {
            $res = ['valid' => false];
        }
        return response()->json($res);
    }

}
