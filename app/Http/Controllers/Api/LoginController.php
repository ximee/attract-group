<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ValidateLoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
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
     * @param ValidateLoginRequest $validatedRequest
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(ValidateLoginRequest $validatedRequest)
    {
        $token = $this->userService->login($validatedRequest->input('email'), $validatedRequest->input('password'));

        if (!$token) {
            return response()->json([
                'message' => 'Wrong credentials!'
            ], 403);
        }

        return response()->json([
            'token_type' => 'Bearer',
            'token' => $token->accessToken,
            'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString()
        ], 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->userService->logoutCurrentUser();

        return response()->json([
            'message' => 'You have been successfully logged out!',
        ], 200);
    }
}
