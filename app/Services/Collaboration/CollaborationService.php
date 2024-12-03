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

    public function getIndexService(string $activeTab, int $page)
    {
        $statusMapping = [
            'request' => 1,
            'accept' => 2,
            'reject' => 3,
        ];

        // Lấy trạng thái từ mapping, mặc định là 'active'
        $status = $statusMapping[$activeTab] ?? 2;

        $data = $this->collabRepository->getIndexRepository($status, $page);
        $dataTab = [
            'pending' => $this->collabRepository->getIndexRepository(1, $page),
            'accepted' => $this->collabRepository->getIndexRepository(2, $page),
            'rejected' => $this->collabRepository->getIndexRepository(3, $page),
        ];

        return [
            'data' => $data,
            'status' => ucfirst($activeTab),
            'pending' => $dataTab['pending'],
            'accepted' => $dataTab['accepted'],
            'rejected' => $dataTab['rejected'],
        ];
    }

    public function searchAllCollaborations(?string $search, ?string $dateRange, int $page)
    {
        $query = $this->collabRepository->searchAcrossStatuses($search, $dateRange, $page);
        return [
            'data' => $query,
            'status' => 'Search Results'
        ];
    }
}
