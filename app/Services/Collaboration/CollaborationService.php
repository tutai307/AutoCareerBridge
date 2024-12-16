<?php

namespace App\Services\Collaboration;


use App\Events\CollaborationRequestEvent;
use App\Mail\CollaborationRequestMail;
use App\Mail\SendMailColab;
use App\Repositories\Collaboration\CollaborationRepositoryInterface;
use App\Repositories\Notification\NotificationRepositoryInterface;
use App\Services\Notification\NotificationService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Fluent;

use function PHPUnit\Framework\isEmpty;

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
            'receive' => STATUS_PENDING,
        ];

        // Lấy trạng thái từ mapping, mặc định là 'active'
        $status = $statusMapping[$activeTab] ?? STATUS_APPROVED;

        $data = $this->collabRepository->getIndexRepository($status, $page, $accountId);
        $dataTab = [
            'pending' => $this->collabRepository->getIndexRepository(STATUS_PENDING, $page, $accountId),
            'accepted' => $this->collabRepository->getIndexRepository(STATUS_APPROVED, $page, $accountId),
            'rejected' => $this->collabRepository->getIndexRepository(STATUS_REJECTED, $page, $accountId),
            'completed' => $this->collabRepository->getIndexRepository(STATUS_COMPLETE, $page, $accountId),
            'received' => $this->collabRepository->getIndexRepository(STATUS_PENDING, $page, $accountId, true),
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
        }else{
            $collab->start_date = now();
        }
        $collab->save();

        //gửi email thông báo
        if($collab->created_by == ROLE_COMPANY){
            $title = 'Trường '.$collab->university->name . ' đã ' . ($args['status'] == STATUS_APPROVED ? 'chấp nhận' : 'từ chối') . ' yêu cầu hợp tác của bạn!';
            $mail = $collab->company->user->email;
            $link = route('company.collaboration', ['search' => $collab->title]);
        }else{
            $title = 'Công ty '.$collab->company->name . ' đã ' . ($args['status'] == STATUS_APPROVED ? 'chấp nhận' : 'từ chối') . ' yêu cầu hợp tác của bạn!';
            $mail = $collab->university->user->email;
            $link = route('university.collaboration', ['search' => $collab->title]);
        }

        Mail::to($mail)->queue(new SendMailColab($collab->company, $collab->university, $collab->created_by, $collab->status, $link));
        $this->notificationRepository->create([
            'title' => $title,
            'link' => $link,
            'type' => TYPE_COLLABORATION,
            ...($collab->created_by == ROLE_COMPANY ? ['company_id' => $collab->company_id] : ['university_id' => $collab->university_id])
        ]);

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
        $data['status'] = STATUS_PENDING;
        $user = auth('admin')->user();
        $data['created_by'] = $user->role;
        if($user->role == ROLE_COMPANY){
            $sendTo = ROLE_UNIVERSITY;
            $data['company_id'] = $user->company->id;
            if(!isset($data['university_id'])){
                throw new \Exception(__('message.university.collaboration.university_not_found'));
            }
            $title = 'Công ty '.$user->company->name . ' muốn hợp tác với bạn!';
            $link = route('university.collaboration', ['search' => $data['title']]);
        }else if($user->role == ROLE_UNIVERSITY){
            $sendTo = ROLE_COMPANY;
            $data['university_id'] = $user->university->id;
            if(!isset($data['company_id'])){
                throw new \Exception(__('message.university.collaboration.company_not_found'));
            }
            $title = 'Trường '.$user->university->name . ' muốn hợp tác với bạn!';
            $link = route('company.collaboration', ['search' => $data['title']]);
        }
        // dd($data);
        $collab = $this->collabRepository->create($data);
        if($sendTo == ROLE_COMPANY){
            $mail = $collab->company->user->email;
        }else{
            $mail = $collab->university->user->email;
        }
        
        Mail::to($mail)->queue(new SendMailColab($collab->company, $collab->university, $sendTo, $collab->status, $link));
        $noti = $this->notificationRepository->create([
            'title' => $title,
            'link' => $link,
            'type' => TYPE_COLLABORATION,
            ...($sendTo == ROLE_COMPANY ? ['company_id' => $collab->company_id] : ['university_id' => $collab->university_id])
        ]);
        $a = $sendTo == ROLE_COMPANY ? [$collab->company_id, null] : [null, $collab->university_id];
        $this->notificationService->renderNotificationRealtime($noti, ...$a);
        return $collab;

    }

}
