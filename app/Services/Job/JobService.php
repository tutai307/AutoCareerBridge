<?php

namespace App\Services\Job;

use App\Mail\NewJobPostedMail;
use App\Mail\SendMailApprovedJobCompany;
use App\Mail\SendMailRejectJobCompany;
use App\Repositories\Collaboration\CollaborationRepositoryInterface;
use App\Repositories\Job\JobRepositoryInterface;
use App\Repositories\Major\MajorRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class JobService
{
    protected $jobRepository;
    protected $majorRepository;
    protected $collaborationRepository;

    public function __construct(JobRepositoryInterface $jobRepository, MajorRepositoryInterface $majorRepository, CollaborationRepositoryInterface $collaborationRepository)
    {
        $this->jobRepository = $jobRepository;
        $this->majorRepository = $majorRepository;
        $this->collaborationRepository = $collaborationRepository;
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
        if($dataRequest['status'] == STATUS_APPROVED) {
            Mail::to($company->email)->queue(new SendMailApprovedJobCompany($company, $job));

            foreach ($collaborations as $collaboration) {
                $universityEmail = $collaboration->university->email ?? null;

                if ($universityEmail) {
                    Mail::to($universityEmail)->queue(new NewJobPostedMail($company, $job));
                }
            }
        }else{
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

    public function getJobForUniversity($slug)
    {
        return $this->jobRepository->getJobForUniversity($slug);
    }

    public function applyJob($job_id, $university_id)
    {
        return $this->jobRepository->applyJob($job_id, $university_id);
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

    public function getAppliedJobs($university_id){
        return $this->jobRepository->getAppliedJobs($university_id);
    }
}
