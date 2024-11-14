<?php

namespace App\Services\Job;

use App\Repositories\Job\JobRepositoryInterface;
use App\Repositories\Major\MajorRepositoryInterface;

class JobService
{
    protected $jobRepository;
    protected $majorRepository;

    public function __construct(JobRepositoryInterface $jobRepository, MajorRepositoryInterface $majorRepository)
    {
        $this->jobRepository = $jobRepository;
        $this->majorRepository = $majorRepository;
    }


    public function getJobs(array $filters)
    {
        return $this->jobRepository->getJobs($filters);
    }

    public function getMajors()
    {
        return $this->majorRepository->getAll();
    }
}
