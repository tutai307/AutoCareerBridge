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
}
