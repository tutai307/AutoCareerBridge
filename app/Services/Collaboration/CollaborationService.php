<?php

namespace App\Services\Collaboration;


use App\Repositories\Collaboration\CollaborationRepositoryInterface;

class CollaborationService
{
    protected $collabRepository;

    public function __construct(CollaborationRepositoryInterface $collabRepository)
    {
        $this->collabRepository = $collabRepository;
    }
    public function getShipsByStatus(int $status)
    {
        return $this->collabRepository->getByStatus($status);
    }
}
