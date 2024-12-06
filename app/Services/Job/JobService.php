<?php

namespace App\Services\Job;

use App\Mail\NewJobPostedMail;
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

    public function updateStatus($job)
    {
        $companyId = $job->company_id;
        $collaborations = $this->collaborationRepository->getUniversityCollaboration($companyId);

        // dd($job->company->user->email);
        // dd($collaborations->toArray());

        // $emailCompany = $job->company->user->email;
        // foreach ($collaborations as $collaboration) {
        //     if ($collaboration->university->email) {
        //         Mail::to($collaboration->university->email)->from($emailCompany)->send(new NewJobPostedMail());
        //     }
        // }

        $emailCompany = $job->company->user;

        foreach ($collaborations as $collaboration) {
            if (!empty($collaboration->university->email)) {
                Mail::to($collaboration->university->email)->send(
                    new NewJobPostedMail($emailCompany) // Truyền email công ty vào
                );
            }
        }


        // $data = [
        //     'status' => $job->status === STATUS_PENDING  ? STATUS_APPROVED : STATUS_PENDING
        // ];
        $data = [
            'status' => $job->status === STATUS_PENDING
        ];
        return $job->update($data);
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
            'hiring_id' => Auth::guard('admin')->user()->id,
            'status' => STATUS_APPROVED,
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
            'status' => STATUS_APPROVED,
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
}
