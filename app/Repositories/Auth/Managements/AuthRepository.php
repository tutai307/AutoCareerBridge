<?php

namespace App\Repositories\Auth\Managements;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use App\Repositories\Base\BaseRepository;

class AuthRepository extends BaseRepository implements AuthRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function userConfirm($token)
    {
        $user = User::where('remember_token', $token)->first();
        if (empty($user)) {
            return null;
        }

        $cachedToken = Cache::get('email_verification_' . $user->id);
        if ($cachedToken === $user->token) {
            $user->email_verified_at = now();
            $user->remember_token = null;
            $user->save();
        };

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
}
