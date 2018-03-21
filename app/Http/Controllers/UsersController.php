<?php

namespace App\Http\Controllers;

use App\Services\UsersService;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class UsersController extends Controller
{
    private $usersService;

    /**
     * Create a new controller instance.
     *
     * @param UsersService $usersService
     */
    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
        $this->middleware('auth', ['only' => [
            'passwordReset'
        ]]);
    }

    public function signup(Request $request)
    {
        $res = [];
        $username = $request->get('username');
        $email = $request->get('email');
        $password = $request->get('password');

        if ($this->usersService->findWith('username', $username)) {
            $res = ['created' => false, 'message' => 'username exist'];
        } else if ($this->usersService->findWith('email', $email)) {
            $res = ['created' => false, 'message' => 'Email exist'];
        } else {
            $res = ['created' => $this->usersService->create($username, $email, $password), 'message' => 'Successfully created'];
        }

        return response()->json($res);
    }

    public function passwordReset(Request $request)
    {
        $new = (string)$request->input('new');
        $old = (string)$request->input('old');
        $res=[];

        if($this->usersService->updatePassword($new,$old)){
            $res = ['updated'=> true, 'message'=> 'Password successfully updated'];
        }else{
            $res = ['updated'=> false, 'message'=> 'Wrong Password'];
        }
        return response()->json($res);
    }

}
