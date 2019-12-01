<?php

namespace App\Http\Controllers\Api;

use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ValidateRegisterRequest;

class RegisterController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * RegisterController constructor.
     * @param $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param ValidateRegisterRequest $validatedRequest
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(ValidateRegisterRequest $validatedRequest)
    {
        $user = $this->userService->register($validatedRequest->input('name'), $validatedRequest->input('email'), $validatedRequest->input('password'));

        if (!$user) {
            return response()->json([
                'message' => 'Registration process failed!'
            ], 400);
        }

        return response()->json([
            'message' => 'You were successfully registered! Please, use your email and password to sign in.'
        ], 201);
    }
}
