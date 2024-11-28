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
            'jobs.id',
            'jobs.name',
            'jobs.slug',
            'jobs.status',
            'jobs.created_at',
            'jobs.end_date',
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

    public function totalRecord()
    {
        $totalUsers = DB::table('users')->count();
        $totalCompanies = DB::table('companies')->count();
        $totalUniversities = DB::table('universities')->count();
        $totalJobs = DB::table('jobs')->count();

        return [
            'users' => $this->formatNumber($totalUsers),
            'companies' => $this->formatNumber($totalCompanies),
            'universities' => $this->formatNumber($totalUniversities),
            'jobs' => $this->formatNumber($totalJobs),
        ];
    }

    function formatNumber(int $number)
    {
        if ($number >= 1000000000) {
            return number_format($number / 1000000000, 1) . 'b';
        } elseif ($number >= 1000000) {
            return number_format($number / 1000000, 1) . 'm';
        } elseif ($number >= 1000) {
            return number_format($number / 1000, 1) . 'k';
        }
        return (string)$number;
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

    public function getJobForUniversity($slug)
    {
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
            ->where('jobs.status', 1)
            ->where('jobs.slug', $slug)->groupBy('jobs.id', 'companies.name', 'companies.avatar_path', 'majors.name');
        $job = $query->first();
        if ($job && $job->skills) {
            $job->skills = str_replace(',', ', ', $job->skills);
        }
        return $job;
    }

    public function checkStatus($data){
        $id = $data['id'];
        $query = $this->model->select('jobs.status')->where('jobs.id', $id)->where('jobs.status', '=', '0')->where('jobs.id', '=', $id)->get();
        return $query;
    }

    public function filterJobByMonth(){
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $query = $this->model->select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('created_at', '>=', $currentYear - 2)
            ->where(function($query) use ($currentYear, $currentMonth) {
                $query->whereYear('created_at', $currentYear)
                    ->whereMonth('created_at', '<=', $currentMonth);
            })
            ->orWhere('created_at', '<', $currentYear)
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc');

        $data = $query->get();

        $result = [];
        for ($year = $currentYear - 2; $year <= $currentYear; $year++) {
            $months = ($year == $currentYear) ? $currentMonth : 12;
            $result[$year] = array_fill(1, $months, 0);
        }

        foreach ($data as $row) {
            $result[$row->year][$row->month] = $row->total;
        }

        return $result;
    }

    public function getJob($slug){
        return $this->model->with(['skills', 'major'])->where('slug', $slug)->first();
    }

    public function updateJob(string $slug,array $job){
        return $this->model->where('slug', $slug)->update($job);
    }
}
