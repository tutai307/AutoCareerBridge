<?php

namespace App\Services\Job;

use App\Repositories\Job\JobRepositoryInterface;

class JobService
{
    protected $jobRepository;

    public function __construct(JobRepositoryInterface $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    public function getJobs(array $filters)
    {
        return $this->jobRepository->getJobs($filters);
    }
}
