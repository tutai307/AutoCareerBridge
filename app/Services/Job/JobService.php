<?php

namespace App\Services\Job;

use App\Mail\NewJobPostedMail;
use App\Mail\SendMailApprovedJobCompany;
use App\Mail\SendMailRejectJobCompany;
use App\Mail\SendMailUniversityApplyJob;
use App\Repositories\Collaboration\CollaborationRepositoryInterface;
use App\Repositories\Job\JobRepositoryInterface;
use App\Repositories\Major\MajorRepositoryInterface;
use App\Repositories\Notification\NotificationRepositoryInterface;
use App\Repositories\University\UniversityRepositoryInterface;
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

    public function __construct(JobRepositoryInterface $jobRepository, MajorRepositoryInterface $majorRepository, CollaborationRepositoryInterface $collaborationRepository, NotificationRepositoryInterface $notificationRepository, UniversityRepositoryInterface $universityRepository)
    {
        $this->jobRepository = $jobRepository;
        $this->majorRepository = $majorRepository;
        $this->collaborationRepository = $collaborationRepository;
        $this->notificationRepository = $notificationRepository;
        $this->universityRepository = $universityRepository;
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
            Mail::to($company->email)->queue(new SendMailApprovedJobCompany($company, $job));
            $this->notificationRepository->create([
                'title' => 'Tin ' . $job->name . ' được phê duyệt',
                'company_id' => $companyId,
                'link' => route('company.editJob', $job->slug),
                'type' => TYPE_JOB,
            ]);

            foreach ($collaborations as $collaboration) {
                $universityEmail = $collaboration->university->email ?? null;
                if ($universityEmail) {
                    Mail::to($universityEmail)->queue(new NewJobPostedMail($company, $job));
                    $this->notificationRepository->create([
                        'title' => $company->company->name . ' vừa đăng tin ' . $job->name,
                        'university_id' => $collaboration->university->id,
                        'link' => route('university.jobDetail', $job->slug),
                        'type' => TYPE_COMPANY,
                    ]);
                }
            }
        } else {
            $this->notificationRepository->create([
                'title' => 'Tin ' . $job->name . ' bị từ chối',
                'company_id' => $companyId,
                'link' => route('company.editJob', $job->slug),
                'type' => TYPE_JOB,
            ]);

            Mail::to($company->email)->queue(new SendMailRejectJobCompany($company, $job));
        }
        return $job->update(['status' => STATUS_PENDING]);

        // return $job->update($dataRequest);
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

    public function getJobForUniversity($slug)
    {
        return $this->jobRepository->findJob($slug);
    }

    public function applyJob($job_id, $university_id)
    {
        try {
            $university = $this->universityRepository->find($university_id);
            $job = $this->jobRepository->find($job_id);

            if (!$university || !$job) {
                throw new Exception('Không tìm thấy dữ liệu đại học hoặc công việc.');
            }

            $company = $job->company;
            $resultUniversityApplyJob = $this->jobRepository->applyJob($job_id, $university_id);

            if ($resultUniversityApplyJob && $company) {
                $this->notificationRepository->create([
                    'title' => $university->name . ' ứng tuyển ' . $job->name,
                    'company_id' => $company->id,
                    'link' => route('company.editJob', $job->slug),
                    'type' => TYPE_UNIVERSITY,
                ]);

                Mail::to($company->user->email)
                    ->queue(new SendMailUniversityApplyJob($university, $company, $job));

                return $resultUniversityApplyJob;
            }

            throw new Exception('Ứng tuyển không thành công.');
        } catch (Exception $e) {
            Log::error('Lỗi khi xử lý ứng tuyển: ' . $e->getLine() . ' - ' . $e->getMessage());
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
            return back()->with('status_fail', 'Không tìm thấy bài đăng, không thể cập nhật!');
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
}
