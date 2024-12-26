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

    public function getAllJobs();

    public function getAppliedJobs($university_id);

    public function getUniversityJob($company_id);

    public function updateStatusUniversityJob($id, $status);

    public function findUniversityJob($id);

    public function searchJobs($keySearch, $province, $major, $fields, $skills);

    public function filterJobByDateRange(array $data);

    public function getJobChart($dateFrom, $dateTo);
}
