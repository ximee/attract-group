<?php

namespace App\Http\Controllers\Api;

use App\Services\UserService;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * UserController constructor.
     * @param $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function fetchUsersExceptMe()
    {
        $users = $this->userService->fetchUsersExceptMe();

        if ($users->isEmpty()) {
            return response()->json([
                'message' => 'No users except me found!'
            ], 404);
        }

        return $users;
    }
}
