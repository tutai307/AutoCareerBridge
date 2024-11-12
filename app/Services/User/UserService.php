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

    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->create($data);
    }
}
