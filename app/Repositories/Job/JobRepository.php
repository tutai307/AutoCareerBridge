<?php

namespace App\Repositories\Job;

use App\Models\Job;
use App\Repositories\Base\BaseRepository;

class JobRepository extends BaseRepository implements JobRepositoryInterface
{
    public function getModel()
    {
        return Job::class;
    }

    public function getJobs(array $filters)
    {
        $query = $this->model->select(
            'jobs.name',
            'jobs.slug',
            'jobs.status',
            'jobs.created_at',
            'companies.name as company_name',
            'majors.name as major_name'
        )
            ->join('hirings', 'jobs.hiring_id', '=', 'hirings.user_id')
            ->join('companies', 'hirings.company_id', '=', 'companies.id')
            ->join('majors', 'jobs.major_id', '=', 'majors.id');



        if (isset($filters['status'])) {
            $query->where('jobs.status', $filters['status']);
        }

        if (isset($filters['search'])) {
            $query->where('jobs.name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('companies.name', 'like', '%' . $filters['search'] . '%');
        }

        if (isset($filters['major'])) {
            $query->where('jobs.major_id', $filters['major']);
        }

        $query->orderBy('jobs.status', 'asc');
        return $query->paginate(LIMIT_10)->withQueryString();
    }
}
