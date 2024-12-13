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
            'complete' => STATUS_COMPLETE,
        ];

        // Lấy trạng thái từ mapping, mặc định là 'active'
        $status = $statusMapping[$activeTab] ?? STATUS_APPROVED;

        $data = $this->collabRepository->getIndexRepository($status, $page, $accountId);
        $dataTab = [
            'pending' => $this->collabRepository->getIndexRepository(STATUS_PENDING, $page, $accountId),
            'accepted' => $this->collabRepository->getIndexRepository(STATUS_APPROVED, $page, $accountId),
            'rejected' => $this->collabRepository->getIndexRepository(STATUS_REJECTED, $page, $accountId),
            'completed' => $this->collabRepository->getIndexRepository(STATUS_COMPLETE, $page, $accountId),
        ];
        return [
            'data' => $data,
            'status' => ucfirst($activeTab),
            ...$dataTab
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

    public function changeStatus($args){
        $collab = $this->collabRepository->find($args['id']);
        if (!$collab) {
            throw new \Exception(__('message.university.collaboration.not_found'));
        }
        if ($collab->created_by == auth('admin')->user()->role) {
            throw new \Exception(__('message.university.collaboration.not_permission'));
        }
        $collab->status = (int) $args['status'];
        if ($args['status'] == STATUS_REJECTED) {
            $collab->response_message = $args['res_message'];
        }
        $collab->save();
        return $collab;
    }

    public function findById(int $id)
    {
        return $this->collabRepository->find($id);
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
