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
    public function getDataByTab(string $activeTab, int $page)
    {
        $statusMapping = [
            'request' => 1,
            'accept' => 2,
            'reject' => 3,
        ];

        // Lấy trạng thái từ mapping, mặc định là 'active'
        $status = $statusMapping[$activeTab] ?? 2;

        // Gọi repository để lấy danh sách dữ liệu theo trạng thái
        $data = $this->collabRepository->getByStatus($status, $page);

        $dataTab = [
            'pending' => $this->collabRepository->getByStatus(1, $page),
            'accepted' => $this->collabRepository->getByStatus(2, $page),
            'rejected' => $this->collabRepository->getByStatus(3, $page),
        ];

        return [
            'data' => $data,
            'status' => ucfirst($activeTab),
            'pending' => $dataTab['pending'],
            'accepted' => $dataTab['accepted'],
            'rejected' => $dataTab['rejected'],
        ];
    }

}
