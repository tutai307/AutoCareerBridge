<?php

namespace App\Repositories\Auth\Managements;

use App\Repositories\Base\BaseRepositoryInterface;

interface AuthRepositoryInterface extends BaseRepositoryInterface
{
    public function userConfirm($token);
}
