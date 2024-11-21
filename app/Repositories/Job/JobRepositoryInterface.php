<?php

namespace App\Repositories\Job;

use App\Repositories\Base\BaseRepositoryInterface;

interface JobRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel();
    public function getJobs(array $filters);

    public function checkStatus(array $data);

    public function findJob($slug);
}
