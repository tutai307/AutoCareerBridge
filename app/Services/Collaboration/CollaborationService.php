<?php

namespace App\Services\Collaboration;


use App\Events\CollaborationRequestEvent;
use App\Mail\CollaborationRequestMail;
use App\Repositories\Collaboration\CollaborationRepositoryInterface;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Fluent;

class CollaborationService
{
    protected $collabRepository;

    public function __construct(CollaborationRepositoryInterface $collabRepository)
    {
        $this->collabRepository = $collabRepository;
    }

    public function getIndexService(string $activeTab, int $page, $accountId = [])
    {
        $user = auth('admin')->user();
        if($user->role == ROLE_COMPANY) {
            $accountId['company'] = $user->company->id;
        }else if($user->role == ROLE_UNIVERSITY) {
            $accountId['university'] = $user->university->id;
        }

        $statusMapping = [
            'request' => STATUS_PENDING,
            'accept' => STATUS_APPROVED,
            'reject' => STATUS_REJECTED,
        ];

        // Lấy trạng thái từ mapping, mặc định là 'active'
        $status = $statusMapping[$activeTab] ?? STATUS_APPROVED;

        $data = $this->collabRepository->getIndexRepository($status, $page, $accountId);
        $dataTab = [
            'pending' => $this->collabRepository->getIndexRepository(STATUS_PENDING, $page, $accountId),
            'accepted' => $this->collabRepository->getIndexRepository(STATUS_APPROVED, $page, $accountId),
            'rejected' => $this->collabRepository->getIndexRepository(STATUS_REJECTED, $page, $accountId),
        ];
        return [
            'data' => $data,
            'status' => ucfirst($activeTab),
            'pending' => $dataTab['pending'],
            'accepted' => $dataTab['accepted'],
            'rejected' => $dataTab['rejected'],
        ];
    }

    public function searchAllCollaborations(?string $search, int $page)
    {
        $query = $this->collabRepository->searchAcrossStatuses($search, $page);
        return [
            'data' => $query,
            'status' => 'Search Results'
        ];
    }

    /**
     * Gửi yêu cầu hợp tác qua email.
     *
     * @param array $data
     * @return mixed
     */
    public function sendCollaborationEmail(array $data): mixed
    {
        $user = auth('admin')->user();

        $data['company_id'] = $user->company->id;
        $data['status'] = STATUS_PENDING;

        $collaborationRequest = $this->collabRepository->create($data)->load('company.user');

        try {
            if ($collaborationRequest->company && $collaborationRequest->company->user) {
                CollaborationRequestEvent::dispatch($collaborationRequest); // Truyền đối tượng
            } else {
                return null;
            }

            return $collaborationRequest;
        } catch (\Exception $e) {
            Log::error('Error sending email: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'collaborationRequest' => optional($collaborationRequest)->toArray(),
            ]);

            return response()->json([
                'error' => 'An error occurred while sending the email.',
            ], 500);
        }
    }

}
