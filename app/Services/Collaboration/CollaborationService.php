<?php

namespace App\Services\Collaboration;


use App\Repositories\Collaboration\CollaborationRepositoryInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class CollaborationService
{
    protected $collabRepository;

    public function __construct(CollaborationRepositoryInterface $collabRepository)
    {
        $this->collabRepository = $collabRepository;
    }

    public function getIndexService(string $activeTab, int $page, $accountId = null)
    {
        $accountId = $accountId ?? \Auth::guard('admin')->user()->company->id;
        $statusMapping = [
            'request' => 1,
            'accept' => 2,
            'reject' => 3,
        ];

        // Lấy trạng thái từ mapping, mặc định là 'active'
        $status = $statusMapping[$activeTab] ?? 2;

        $data = $this->collabRepository->getIndexRepository($status, $page, $accountId);
        $dataTab = [
            'pending' => $this->collabRepository->getIndexRepository(1, $page, $accountId),
            'accepted' => $this->collabRepository->getIndexRepository(2, $page, $accountId),
            'rejected' => $this->collabRepository->getIndexRepository(3, $page, $accountId),
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
    public function sendRequest(array $data)
    {
        $company = \Auth::guard('admin')->user()->company;
        $data['company_id'] = $company->id;
        $data['start_date'] = Carbon::now();
        $data['status'] = STATUS_PENDING;
        return $this->collabRepository->create($data);
    }
}
