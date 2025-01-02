<?php

namespace App\Services\Job;

use App\Events\NotifyJobChangeStatusEvent;
use App\Mail\NewJobPostedMail;
use App\Mail\SendMailApprovedJobCompany;
use App\Mail\SendMailRejectJobCompany;
use App\Mail\SendMailStudent;
use App\Mail\SendMailUniversityApplyJob;
use App\Models\UniversityJob;
use App\Models\WorkShop;
use App\Repositories\Collaboration\CollaborationRepositoryInterface;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Repositories\Job\JobRepositoryInterface;
use App\Repositories\Major\MajorRepositoryInterface;
use App\Repositories\Notification\NotificationRepositoryInterface;
use App\Repositories\University\UniversityRepositoryInterface;
use App\Services\Notification\NotificationService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class JobService
{
    protected $jobRepository;
    protected $majorRepository;
    protected $collaborationRepository;
    protected $notificationRepository;
    protected $universityRepository;
    protected $notificationService;
    protected $companyRepository;

    public function __construct(
        CompanyRepositoryInterface       $companyRepository,
        JobRepositoryInterface           $jobRepository,
        MajorRepositoryInterface         $majorRepository,
        CollaborationRepositoryInterface $collaborationRepository,
        NotificationRepositoryInterface  $notificationRepository,
        UniversityRepositoryInterface    $universityRepository,
        NotificationService              $notificationService
    ) {
        $this->companyRepository = $companyRepository;
        $this->jobRepository = $jobRepository;
        $this->majorRepository = $majorRepository;
        $this->collaborationRepository = $collaborationRepository;
        $this->notificationRepository = $notificationRepository;
        $this->universityRepository = $universityRepository;
        $this->notificationService = $notificationService;
    }

    public function getAll()
    {
        return $this->jobRepository->getAll();
    }
    public function totalRecord()
    {
        return $this->jobRepository->totalRecord();
    }

    public function getJobs(array $filters)
    {
        return $this->jobRepository->getJobs($filters);
    }

    public function getMajors()
    {
        return $this->majorRepository->getAll();
    }

    public function findJob($slug)
    {
        return $this->jobRepository->findJob($slug);
    }

    public function checkStatus(array $data)
    {
        return $this->jobRepository->checkStatus($data);
    }

    public function updateStatus($job, $dataRequest)
    {
        $companyId = $job->company_id;
        $collaborations = $this->collaborationRepository->getUniversityCollaboration($companyId);
        $company = $job->company->user;
        if ($dataRequest['status'] == STATUS_APPROVED) {
            $notification = $this->notificationRepository->create([
                'title' => 'Tin ' . $job->name . ' được phê duyệt',
                'company_id' => $companyId,
                'link' => route('company.showJob', $job->slug),
                'type' => TYPE_JOB,
            ]);

            $this->notificationService->renderNotificationRealtime($notification, $companyId);

            $notifications = [];
            $emails = [];
            foreach ($collaborations as $collaboration) {
                $universityEmail = $collaboration->university->email ?? null;
                if ($universityEmail) {
                    // Tạo thông báo và lưu vào mảng
                    $notification = $this->notificationRepository->create([
                        'title' => $company->company->name . ' vừa đăng tin ' . $job->name,
                        'university_id' => $collaboration->university->id,
                        'link' => route('university.jobDetail', $job->slug),
                        'type' => TYPE_COMPANY,
                    ]);

                    $notifications[] = [
                        'notification' => $notification,
                        'university_id' => $collaboration->university->id,
                    ];

                    $emails[] = [
                        'email' => $universityEmail,
                        'company' => $company,
                        'job' => $job,
                    ];
                }
            }

            // Gửi thông báo thời gian thực
            foreach ($notifications as $data) {
                $this->notificationService->renderNotificationRealtime(
                    $data['notification'],
                    null,
                    $data['university_id']
                );
            }

            // Gửi email
            foreach ($emails as $data) {
                Mail::to($data['email'])->queue(new NewJobPostedMail($data['company'], $data['job']));
            }
        } else {
            $notification = $this->notificationRepository->create([
                'title' => 'Tin ' . $job->name . ' bị từ chối',
                'company_id' => $companyId,
                'link' => route('company.showJob', $job->slug),
                'type' => TYPE_JOB,
            ]);
            $this->notificationService->renderNotificationRealtime($notification, $companyId);

            Mail::to($company->email)->queue(new SendMailRejectJobCompany($company, $job));
        }
        return $job->update($dataRequest);
    }

    public function getApplyJobs()
    {
        return $this->jobRepository->getApplyJobs();
    }

    public function checkApplyJob($id, $slug)
    {
        return $this->jobRepository->checkApplyJob($id, $slug);
    }

    public function filterJobByMonth()
    {
        return $this->jobRepository->filterJobByMonth();
    }

    public function filterJobByDateRange(array $data)
    {
        return $this->jobRepository->filterJobByDateRange($data);
    }

    public function getJobForUniversity($slug)
    {
        return $this->jobRepository->findJob($slug);
    }

    public function applyJob($job_id, $university_id)
    {
        try {
            $university = $this->universityRepository->find($university_id);
            $job = $this->jobRepository->find($job_id);

            if (empty($university) && empty($job)) {
                return null;
            }

            $company = $job->company;
            $resultUniversityApplyJob = $this->jobRepository->applyJob($job_id, $university_id);

            if ($resultUniversityApplyJob && $company) {
                $notification = $this->notificationRepository->create([
                    'title' => $university->name . ' ứng tuyển ' . $job->name,
                    'company_id' => $company->id,
                    'link' => route('company.showJob', $job->slug),
                    'type' => TYPE_UNIVERSITY,
                ]);
                $this->notificationService->renderNotificationRealtime($notification, $company->id);

                Mail::to($company->user->email)
                    ->queue(new SendMailUniversityApplyJob($university, $company, $job));
                return $resultUniversityApplyJob;
            } else {
                return null;
            }
        } catch (Exception $e) {
            Log::error($e->getFile() . ':' . $e->getLine() . ' - ' . 'Lỗi khi xử lý ứng tuyển: ' . ' - ' . $e->getMessage());
            return null;
        }
    }

    public function createJob(array $data, array $skills)
    {
        $job = [
            'name' => $data['name'],
            'slug' => $data['slug'],
            'detail' => $data['detail'],
            'major_id' => $data['major_id'],
            'end_date' => $data['end_date'],
            'user_id' => Auth::guard('admin')->user()->id,
            'company_id' => Auth::guard('admin')->user()->hiring->company_id ?? Auth::guard('admin')->user()->company->id,
            'status' => STATUS_PENDING,
        ];
        $detail = $this->jobRepository->create($job);
        $detail->skills()->detach();
        foreach ($skills as $skill) {
            $detail->skills()->attach($skill);
        }
    }

    public function updateJob(string $id, array $data, array $skills)
    {
        $job = $this->jobRepository->find($id);

        if (!$job) {
            return back()->with('status_fail', 'Không tìm thấy bài tuyển dụng, không thể cập nhật!');
        }

        $data = [
            'name' => $data['name'],
            'slug' => $data['slug'],
            'detail' => $data['detail'],
            'major_id' => $data['major_id'],
            'end_date' => $data['end_date'],
        ];
        $this->jobRepository->update($id, $data);

        $job->skills()->detach();
        foreach ($skills as $skill) {
            $job->skills()->attach($skill);
        }
    }

    public function getJob($slug)
    {
        return $this->jobRepository->getJob($slug);
    }

    public function find($id)
    {
        return $this->jobRepository->find($id);
    }

    public function deleteJob($id)
    {
        return $this->jobRepository->delete($id);
    }

    public function getPostsByCompany(array $filters)
    {
        return $this->jobRepository->getPostsByCompany($filters);
    }

    public function getAllJobs()
    {
        return $this->jobRepository->getAllJobs();
    }

    public function getAppliedJobs($university_id)
    {
        return $this->jobRepository->getAppliedJobs($university_id);
    }

    public function manageUniversityJob()
    {
        $comany_id = auth()->guard('admin')->user()->company->id ?? auth()->guard('admin')->user()->hiring->company_id;
        return $this->jobRepository->getUniversityJob($comany_id);
    }

    public function updateStatusUniversityJob($id, $status)
    {
        try {
            $universityJob = $this->jobRepository->findUniversityJob($id);
            $universityId = $universityJob->university_id;
            $jobId = $universityJob->job_id;
            $job = $this->jobRepository->find($jobId);
            if ($status == STATUS_APPROVED) {
                $notification = $this->notificationRepository->create([
                    'title' => 'Công việc ' . $job->name . ' được doanh nghiệp chấp nhận',
                    'university_id' => $universityId,
                    'link' => route('university.jobDetail', $job->slug),
                    'type' => TYPE_JOB,
                ]);
                $this->notificationService->renderNotificationRealtime($notification, null, $universityId);

                $university = $this->universityRepository->getStudentMatchingJob($jobId, $universityId);
                if ($university) {
                    foreach ($university->students as $student) {
                        Mail::to($student->email)
                            ->queue(new SendMailStudent($job, $job->company));
                    }
                }
            } else {
                $notification = $this->notificationRepository->create([
                    'title' => 'Công việc ' . $job->name . ' bị doanh nghiệp từ chối',
                    'university_id' => $universityId,
                    'link' => route('university.jobDetail', $job->slug),
                    'type' => TYPE_JOB,
                ]);
                $this->notificationService->renderNotificationRealtime($notification, null, $universityId);
            }
            return $this->jobRepository->updateStatusUniversityJob($id, $status);
            // return $this->jobRepository->updateStatusUniversityJob($id, 1);
        } catch (Exception $e) {
            Log::error($e->getFile() . ':' . $e->getLine() . ' - ' . 'Lỗi khi xử lý ứng tuyển: ' . ' - ' . $e->getMessage());
            return null;
        }
    }

    public function searchJobs($keySearch, $province, $major, $fields, $skills)
    {
        return $this->jobRepository->searchJobs($keySearch, $province, $major, $fields, $skills);
    }

    public function getJobChart($dateFrom, $dateTo)
    {
        $records =  $this->jobRepository->getJobChart($dateFrom, $dateTo);
        $jobApperoved = [];
        $jobDelete = [];
        $date = [];

        foreach ($records as $value) {
            array_push($jobApperoved, $value->total_approved_jobs);
            array_push($jobDelete, $value->total_deleted_jobs);
            array_push($date, $value->created_date);
        }

        return [
            'jobApperoved' => $jobApperoved,
            'jobDelete' => $jobDelete,
            'date' => $date
        ];
    }
}
