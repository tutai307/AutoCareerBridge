<?php

namespace App\Services\Collaboration;


use App\Mail\SendMailColab;
use App\Repositories\Collaboration\CollaborationRepositoryInterface;
use App\Repositories\Notification\NotificationRepositoryInterface;
use App\Services\Notification\NotificationService;
use Illuminate\Support\Facades\Mail;

class CollaborationService
{
    protected $collabRepository;
    protected $notificationRepository;

    protected $notificationService;

    public function __construct(CollaborationRepositoryInterface $collabRepository, NotificationRepositoryInterface $notificationRepository, NotificationService $notificationService)
    {
        $this->collabRepository = $collabRepository;
        $this->notificationRepository = $notificationRepository;
        $this->notificationService = $notificationService;
    }

    public function getIndexService(string $activeTab, $accountId = [])
    {
        $user = auth('admin')->user();
        if ($user->role == ROLE_COMPANY) {
            $accountId['company'] = $user->company->id;
        } else if ($user->role == ROLE_UNIVERSITY) {
            $accountId['university'] = $user->university->id;
        }

        $statusMapping = [
            'request' => STATUS_PENDING,
            'accept' => STATUS_APPROVED,
            'reject' => STATUS_REJECTED,
            'complete' => STATUS_COMPLETE,
            'receive' => STATUS_PENDING,
        ];

        // Lấy trạng thái từ mapping, mặc định là 'active'
        $status = $statusMapping[$activeTab] ?? STATUS_APPROVED;

        $data = $this->collabRepository->getIndexRepository($status, $accountId, $activeTab == 'receive');
        $dataTab = [
            'pending' => $this->collabRepository->getIndexRepository(STATUS_PENDING, $accountId),
            'accepted' => $this->collabRepository->getIndexRepository(STATUS_APPROVED, $accountId),
            'rejected' => $this->collabRepository->getIndexRepository(STATUS_REJECTED, $accountId),
            'completed' => $this->collabRepository->getIndexRepository(STATUS_COMPLETE, $accountId),
            'received' => $this->collabRepository->getIndexRepository(STATUS_PENDING, $accountId, true),
        ];
        return [
            'data' => $data,
            'status' => ucfirst($activeTab),
            ...$dataTab
        ];
    }

    public function searchAllCollaborations(?string $search, ?string $dateRang)
    {
        $query = $this->collabRepository->searchAcrossStatuses($search, $dateRang);
        return [
            'data' => $query,
            'status' => 'Search Results'
        ];
    }

    public function changeStatus($args)
    {
        $collab = $this->collabRepository->find($args['id']);

        if (!$collab) {
            throw new \Exception(__('message.university.collaboration.not_found'));
        }
        if ($collab->created_by == auth('admin')->user()->role) {
            throw new \Exception(__('message.university.collaboration.not_permission'));
        }
        $collab->status = (int)$args['status'];
        if ($args['status'] == STATUS_REJECTED) {
            $collab->response_message = $args['res_message'];
        } else {
            $collab->start_date = now();
        }
        $collab->save();

        //gửi email thông báo
        if ($collab->created_by == ROLE_COMPANY) {
            $title = 'Trường ' . $collab->university->name . ' đã ' . ($args['status'] == STATUS_APPROVED ? 'chấp nhận' : 'từ chối') . ' yêu cầu hợp tác của bạn!';
            $mail = $collab->company->user->email;
            $link = route('company.collaboration', ['search' => $collab->title]);
        } else {
            $title = 'Công ty ' . $collab->company->name . ' đã ' . ($args['status'] == STATUS_APPROVED ? 'chấp nhận' : 'từ chối') . ' yêu cầu hợp tác của bạn!';
            $mail = $collab->university->user->email;
            $link = route('university.collaboration', ['search' => $collab->title]);
        }

        Mail::to($mail)->queue(new SendMailColab($collab->company, $collab->university, $collab->created_by, $collab->status, $link));
        $notification = $this->notificationRepository->create([
            'title' => $title,
            'link' => $link,
            'type' => TYPE_COLLABORATION,
            ...($collab->created_by == ROLE_COMPANY ? ['company_id' => $collab->company_id] : ['university_id' => $collab->university_id])
        ]);
        $recipientIds = $collab->created_by == ROLE_COMPANY ? [$collab->company_id, null] : [null, $collab->university_id];
        $this->notificationService->renderNotificationRealtime($notification, ...$recipientIds);
        return $collab;
    }

    public function findById(int $id): mixed
    {
        return $this->collabRepository->find($id);
    }

    /**
     * Gửi yêu cầu hợp tác qua email.
     *
     * @param array $data
     * @return mixed
     */
    public function sendCollaborationEmail(array $data)
    {

        $user = auth('admin')->user();
        if ($user->role == ROLE_COMPANY) {
            $sendTo = ROLE_UNIVERSITY;
            $data['company_id'] = $user->company->id;

            if (!isset($data['university_id'])) {
                throw new \Exception(__('message.university.collaboration.university_not_found'));
            }

            $title = 'Công ty ' . $user->company->name . ' muốn hợp tác với bạn!';
            $link = route('university.collaboration', ['search' => $data['title']]);

        } else if ($user->role == ROLE_UNIVERSITY) {
            $sendTo = ROLE_COMPANY;
            $data['university_id'] = $user->university->id;

            if (!isset($data['company_id'])) {
                throw new \Exception(__('message.university.collaboration.company_not_found'));
            }

            $title = 'Trường ' . $user->university->name . ' muốn hợp tác với bạn!';
            $link = route('company.collaboration', ['search' => $data['title']]);
        }

        $data['status'] = STATUS_PENDING;
        $data['created_by'] = $user->role;

        $collab = $this->collabRepository->create($data);

        if ($sendTo == ROLE_COMPANY) {
            $mail = $collab->company->user->email;
        } else {
            $mail = $collab->university->user->email;
        }

        Mail::to($mail)->queue(new SendMailColab($collab->company, $collab->university, $sendTo, $collab->status, $link));
        $notification = $this->notificationRepository->create([
            'title' => $title,
            'link' => $link,
            'type' => TYPE_COLLABORATION,
            ...($sendTo == ROLE_COMPANY ? ['company_id' => $collab->company_id] : ['university_id' => $collab->university_id])
        ]);

        $recipientIds = $sendTo == ROLE_COMPANY ? [$collab->company_id, null] : [null, $collab->university_id];
        $this->notificationService->renderNotificationRealtime($notification, ...$recipientIds);

        return $collab;
    }
}
