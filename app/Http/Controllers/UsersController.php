<?php

namespace App\Http\Controllers;

use App\Services\UsersService;
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
    }


}
