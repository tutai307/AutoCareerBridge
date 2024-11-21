<?php

namespace App\Repositories\Major;

use App\Repositories\Base\BaseRepositoryInterface;

interface MajorRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel();
    public function getMajors(array $filters);
}
