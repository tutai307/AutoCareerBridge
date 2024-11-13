<?php

namespace App\Services\Managements;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Events\EmailConfirmationRequired;
use App\Repositories\Auth\Managements\AuthRepositoryInterface;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register($request)
    {
        $data = [
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'remember_token' => Str::random(60),
        ];

        $user =  $this->authRepository->create($data);
        EmailConfirmationRequired::dispatch($user);
    }

    public function confirmMailRegister($token)
    {
        $user = $this->authRepository->userConfirm($token);
        if (!empty($user)) {
            $cachedToken = Cache::get('email_verification_' . $user->id);
            if ($cachedToken === $user->token) {
                $user->email_verified_at = now();
                $user->remember_token = null;
                $user->save();
            };
        }
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
