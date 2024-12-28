<?php

namespace App\Services\University;

use App\Models\Company;
use App\Models\CompanyWorkshop;
use App\Models\WorkShop;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Repositories\Notification\NotificationRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Workshop\WorkshopRepositoryInterface;
use App\Services\Notification\NotificationService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WorkshopService
{
    protected $workshopRepository;
    protected $notificationRepository;
    protected $companyRepository;
    protected $notificationService;

    public function __construct(
        WorkshopRepositoryInterface $workshopRepository,
        NotificationRepositoryInterface $notificationRepository,
        CompanyRepositoryInterface $companyRepository,
        NotificationService $notificationService
    ) {
        $this->notificationRepository = $notificationRepository;
        $this->workshopRepository = $workshopRepository;
        $this->companyRepository = $companyRepository;
        $this->notificationService = $notificationService;
    }

    public function getAll() {
        return $this->workshopRepository->getAll();
    }

    public function getWorkShopClient() {
        return $this->workshopRepository->getWorkShopClient();
    }
    public function getWorkShopsHot() {
        return $this->workshopRepository->getWorkShopsHot();
    }

    public function createWorkshop($request)
    {
        $user = Auth::guard('admin')->user();
        if ($user->role === ROLE_SUB_UNIVERSITY) {
            $universityId = $user->academicAffair->university_id;
        }
        if ($user->role === ROLE_UNIVERSITY) {
            $universityId = $user->university->id;
        }
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'university_id' => $universityId,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'amount' => $request->amount,
            'content' => $request->content,
        ];


        if ($request->hasFile('avatar_path') && $request->file('avatar_path')->isValid()) {
            $data['avatar_path'] = $request->file('avatar_path')->store('workshops', 'public');
            $data['avatar_path'] = '/storage/' . $data['avatar_path'];
        }

        return $this->workshopRepository->create($data);
    }
    public function updateWorkshop($request, $id): mixed
    {
        $user = Auth::guard('admin')->user();
        if ($user->role === ROLE_SUB_UNIVERSITY) {
            $universityId = $user->academicAffair->university_id;
        }
        if ($user->role === ROLE_UNIVERSITY) {
            $universityId = $user->university->id;
        }
        $workshop = $this->workshopRepository->find($id);
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'university_id' => $universityId,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'amount' => $request->amount,
            'content' => $request->content,
        ];

        if ($request->hasFile('avatar_path') && $request->file('avatar_path')->isValid()) {
            if (!empty($workshop->avatar_path)) {
                $filePath = str_replace('/storage', '', $workshop->avatar_path);
                if (Storage::exists($filePath)) {
                    Storage::delete($filePath);
                }
            }

            $data['avatar_path'] = $request->file('avatar_path')->store('workshops', 'public');
            $data['avatar_path'] = '/storage/' . $data['avatar_path'];
        }
        return $workshop->update($data);
    }


    public function getWorkshops($filters)
    {
        return $this->workshopRepository->getWorkshop($filters);
    }

    public function getWorkshop($id)
    {
        return $this->workshopRepository->find($id);
    }

    public function applyWorkShop($companyId, $workshopId)
    {
        $workShop = $this->workshopRepository->find($workshopId);
        $company = $this->companyRepository->find($companyId);
        $universityId = $workShop->university_id;
        $notification = $this->notificationRepository->create([
            'title' => 'Công ty ' . $company->name . ' đã yêu cầu tham gia workshop ' . $workShop->name,
            'university_id' => $universityId,
            'link' => route('university.manageCompanyWorkshop') . '?tab=pending',
            'type' => TYPE_WORKSHOPS,
        ]);
        $this->notificationService->renderNotificationRealtime($notification, null, $universityId);
        return $this->workshopRepository->applyWorkShop($companyId, $workshopId);
    }

    public function manageCompanyWorkshop()
    {
        $universityId = Auth::guard('admin')->user()->university->id ?? Auth::guard('admin')->user()->academicAffair->university->id;
        return $this->workshopRepository->manageCompanyWorkshop($universityId);
    }

    public function updateStatusWorkShop($companyId, $workshopId, $status)
    {
        try {
            $university = Auth::guard('admin')->user()->university ?? Auth::guard('admin')->user()->academicAffair->university;
            $companyWorkshop = $this->workshopRepository->findCompanyWorkshop($companyId, $workshopId);
            if ($status == STATUS_APPROVED) {
                $notification = $this->notificationRepository->create([
                    'title' => ' Yêu cầu tham gia workshop ' . $companyWorkshop->workshops->name . ' được trường học chấp nhận',
                    'company_id' => $companyId,
                    'link' => route('detailUniversity', $university->slug),
                    'type' => TYPE_WORKSHOPS,
                ]);
                $this->notificationService->renderNotificationRealtime($notification, $companyId);
            } else {
                $notification = $this->notificationRepository->create([
                    'title' => 'Yêu cầu tham gia workshop ' . $companyWorkshop->workshops->name .  ' bị trường học từ chối',
                    'company_id' => $companyId,
                    'link' => route('detailUniversity', $university->slug),
                    'type' => TYPE_WORKSHOPS,
                ]);
                $this->notificationService->renderNotificationRealtime($notification, $companyId);
            }
            return $this->workshopRepository->updateStatusWorkShop($companyId, $workshopId, $status);
        } catch (Exception $e) {
            Log::error($e->getFile() . ':' . $e->getLine() . ' - ' . 'Lỗi khi tạo thông báo: ' . ' - ' . $e->getMessage());

            return null;
        }
    }

    public function workshopApplied(){
        $companyId = Auth::guard('admin')->user()->company->id ?? Auth::guard('admin')->user()->hiring->company->id;
        return $this->workshopRepository->workshopApplied($companyId);
    }
}
