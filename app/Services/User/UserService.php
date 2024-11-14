<?php

namespace App\Services\User;

use App\Repositories\User\UserRepositoryInterface;
use Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers(array $filters)
    {
        return $this->userRepository->getUsers($filters);
    }

    public function createUser($request)
    {
        $data = [
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'active' => 0,
        ];
        return $this->userRepository->create($data);
    }
}
