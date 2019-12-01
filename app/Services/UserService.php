<?php

namespace App\Services;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;

class UserService
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * UserService constructor.
     * @param $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     *
     * @return mixed
     */
    public function register(string $name, string $email, string $password)
    {
        return $this->repository->create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'email_verified_at' => Carbon::now()
        ]);
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @return null
     */
    public function login(string $email, string $password)
    {
        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            return null;
        }

        $token = Auth::user()->createToken(config('app.name'));
        $token->token->expires_at = Carbon::now()->addDay();

        $token->token->save();

        return $token;
    }

    /**
     * @return mixed
     */
    public function logoutCurrentUser()
    {
        return Auth::user()->token()->revoke();
    }

    /**
     * @return mixed
     */
    public function fetchUsersExceptMe()
    {
        $myId = Auth::user()->id;

        return $this->repository->where('id', $myId, '<>')->get();
    }
}