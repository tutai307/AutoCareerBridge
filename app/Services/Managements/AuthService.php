<?php

namespace App\Services\Managements;

use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterCheck;
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
        ];

        // Mail::to($data['email'])->send(new RegisterCheck());
        

        // return $this->authRepository->create($data);
    }
}
