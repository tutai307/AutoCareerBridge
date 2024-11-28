<?php

namespace App\Services\Job;

use App\Repositories\Job\JobRepositoryInterface;
use App\Repositories\Major\MajorRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class JobService
{
    protected $jobRepository;
    protected $majorRepository;

    public function __construct(JobRepositoryInterface $jobRepository, MajorRepositoryInterface $majorRepository)
    {
        $this->jobRepository = $jobRepository;
        $this->majorRepository = $majorRepository;
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

    public function update($id, array $job)
    {
        return $this->jobRepository->update($id, $job);
    }

    public function filterJobByMonth()
    {
        return $this->jobRepository->filterJobByMonth();
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
