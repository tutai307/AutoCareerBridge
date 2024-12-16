<?php

namespace App\Repositories\Collaboration;

use App\Models\Collaboration;
use App\Repositories\Base\BaseRepositoryInterface;

interface CollaborationRepositoryInterface extends BaseRepositoryInterface
{
    public function getIndexRepository(int $status, int $page, $accountId, bool $isReceived = false);

    public function searchAcrossStatuses(?string $search, int $page);

    public function getUniversityCollaboration($companyId);

    public function create($data = []);

}
