<?php

namespace App\Repositories\Collaboration;

use App\Repositories\Base\BaseRepositoryInterface;

interface CollaborationRepositoryInterface extends BaseRepositoryInterface
{
    public function getByStatus(int $status);
}
