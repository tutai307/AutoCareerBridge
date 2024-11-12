<?php

namespace App\Services\Managements;

use Illuminate\Support\Str;
use App\Events\EmailConfirmationRequired;
use App\Repositories\Auth\Managements\AuthRepositoryInterface;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register($data)
    {
        $data = [
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
            'remember_token' => Str::random(60),
        ];

        $user =  $this->authRepository->create($data);
        EmailConfirmationRequired::dispatch($user);
    }

    public function confirmMailRegister($token)
    {
        $user = $this->authRepository->userConfirm($token);
        return $user;
    }

    public function login($data)
    {
        $user = $this->authRepository->login($data);
        $credentialsByEmail = ['email' => $data['email'], 'password' => $data['password']];
        $credentialsByUsername = ['user_name' => $data['email'], 'password' => $data['password']];

        if (auth()->guard('admin')->attempt($credentialsByEmail) || auth()->guard('admin')->attempt($credentialsByUsername)) {
            return $user;
        }

        return null;
    }
}
