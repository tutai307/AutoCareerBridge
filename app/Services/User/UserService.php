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
            'active' => ACTIVE,
            'email_verified_at' => now(),
        ];
        return $this->userRepository->create($data);
    }

    public function updateUser(string $id, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $this->userRepository->update($id, $data);
    }

    public function deleteUser(string $id)
    {
        return $this->userRepository->delete($id);
    }

    public function getUserById(int $id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function updateToggleStatus(int $id, array $data){
        $data['active'] = $data['status'] == 'active' ? ACTIVE : INACTIVE;
        return $this->userRepository->updateToggleStatus($id, $data);
    }
}
