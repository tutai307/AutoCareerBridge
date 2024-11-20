<?php

namespace App\Repositories\Auth\Managements;

use App\Models\User;
use App\Repositories\Base\BaseRepository;

class AuthRepository extends BaseRepository implements AuthRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function userConfirm($token)
    {
        $user = $this->model->where('remember_token', $token)->first();
        if (empty($user)) {
            return null;
        }

        return $user;
    }

    public function login($data)
    {
        $user = $this->model->where(function ($query) use ($data) {
            $query->where('email', $data['email'])
                ->orWhere('user_name', $data['email']);
        })->first();

        if (empty($user)) {
            return null;
        }
        return $user;
    }

    public function checkForgotPassword($email)
    {
        $user = $this->model->where('email', $email)->whereNotNull('email_verified_at')->first();
        if (empty($user)) {
            return null;
        }
        return $user;
    }
}
