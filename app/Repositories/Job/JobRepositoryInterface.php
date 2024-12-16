<?php

namespace App\Repositories\Job;

use App\Repositories\Base\BaseRepositoryInterface;

interface JobRepositoryInterface extends BaseRepositoryInterface
{
    public function getJobs(array $filters);

    public function checkStatus(array $data);

    public function findJob($slug);

    public function totalRecord();

    public function filterJobByMonth();

    public function getApplyJobs();

    public function checkApplyJob($id, $slug);

    public function applyJob($job_id, $university_id);

    public function getJob($slug);

    public function updateJob(string $slug, array $job);

    public function getPostsByCompany(array $filters);

    public function getAppliedJobs($university_id);
}
