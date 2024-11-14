<?php

namespace App\Repositories\Auth\Managements;

use App\Repositories\Base\BaseRepositoryInterface;

interface AuthRepositoryInterface extends BaseRepositoryInterface
{
    public function userConfirm($token);
    public function login($data);
    public function checkForgotPassword($email);
}
