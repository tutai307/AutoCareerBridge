<?php

namespace App\Repositories\Job;

use App\Models\Job;
use App\Repositories\Base\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    /**
     * @throws Exception
     */
    public function findJob($slug)
    {
        try {
            $query = $this->model->select(
                'jobs.*',
                'companies.name as company_name',
                'companies.avatar_path as company_avatar_path',
                'majors.name as major_name',
                DB::raw('GROUP_CONCAT(skills.name) as skills')
            )
                ->join('hirings', 'jobs.hiring_id', '=', 'hirings.user_id')
                ->join('companies', 'hirings.company_id', '=', 'companies.id')
                ->join('majors', 'jobs.major_id', '=', 'majors.id')
                ->join('job_skills', 'jobs.id', '=', 'job_skills.job_id')
                ->join('skills', 'job_skills.skill_id', '=', 'skills.id')
                ->where('jobs.slug', $slug)->groupBy('jobs.id', 'companies.name', 'companies.avatar_path', 'majors.name');
            $job = $query->first();
            if(!$job) return [
                'error' => 'Job not found'
            ];
            if ($job && $job->skills) {
                $job->skills = str_replace(',', ', ', $job->skills);
            }
            return $job;
        }catch (Exception $exception){
            Log::error($exception->getMessage());
            return [
                'error' => $exception->getMessage()
            ];
        }

    }
}
