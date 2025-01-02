<?php

namespace App\Repositories\University;

use App\Models\Address;
use App\Models\University;
use App\Models\WorkShop;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Job\JobRepositoryInterface;
use App\Repositories\University\UniversityRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;

class UniversityRepository extends BaseRepository implements UniversityRepositoryInterface
{
    protected $companyId;
    protected $jobRepository;

    public function __construct(JobRepositoryInterface $jobRepository)
    {
        parent::__construct();
        $this->jobRepository = $jobRepository;
    }

    public function getModel()
    {
        return University::class;
    }

    public function popularUniversities()
    {
        $universitiesAll = $this->model::with('collaborations')
            ->get()
            ->sortByDesc(function ($university) {
                return $university->collaborations->count();
            });

        return $universitiesAll;
    }

    public function findUniversity($request)
    {
        $companyId = auth()->guard('admin')->user()?->company?->id;
        $name = $request->searchName;
        $provinceId = $request->searchProvince;
        $query = $this->model::query()
            ->join('addresses', 'universities.id', '=', 'addresses.university_id')
            ->select('universities.*')
            ->with('collaborations');
        if (!empty($name)) {
            $query->where('universities.name', 'like', '%' . $name . '%');
        }
        if (!empty($provinceId)) {
            $query->where('addresses.province_id', $provinceId);
        }
        if ($companyId) {
            $query->withCount([
                'collaborations as is_collaborated' => function ($subQuery) use ($companyId) {
                    $subQuery->where('company_id', $companyId)->whereIn('status', [1, 2]);
                }
            ])->orderByDesc('is_collaborated');
        } else {
            $query->inRandomOrder();
        }
        $universities = $query->paginate(LIMIT_10);

        return $universities;
    }

    public function getDetailUniversity($slug)
    {
        try {
            $detail = $this->model::with(['user', 'majors', 'students', 'collaborations'])
                ->where('universities.slug', $slug)
                ->select(
                    'universities.*'
                )->firstOrFail();
            $address = Address::query()
                ->with('province', 'district', 'ward')
                ->where('university_id', $detail->id)
                ->first();
            return [
                'detail' => $detail,
                'address' => $address,
            ];
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Không thể tìm thấy trường học');
        }
    }

    public function getWorkShops($slug)
    {
        $workshops = $this->model::where('slug', $slug)
            ->firstOrFail()
            ->workshops()
            ->where('status', 1)
            ->get();


        return $workshops;
    }

    public function totalRecord()
    {
        $totalStudentWorkshopColabJob = $this->model::withCount([
            'students as totalStudents',
            'universityJobs as totalUniversityJobs' => function ($query) {
                $query->where('status', STATUS_APPROVED);
            },

            'collaborations as totalCollaborations' => function ($query) {
                $query->where('status', STATUS_APPROVED);
            },
            'workshops as totalWorkshops'
        ])
            ->where('id', auth()->guard('admin')->user()?->university?->id)
            ->first();

        $totalStudents = $totalStudentWorkshopColabJob->totalStudents ?? 0;
        $totalUniversityJobs = $totalStudentWorkshopColabJob->totalUniversityJobs ?? 0;
        $totalCollaborations = $totalStudentWorkshopColabJob->totalCollaborations ?? 0;
        $totalWorkshops = $totalStudentWorkshopColabJob->totalWorkshops ?? 0;

        return [
            'totalStudents' => $totalStudents,
            'totalUniversityJobs' => $totalUniversityJobs,
            'totalCollaborations' => $totalCollaborations,
            'totalWorkshops' => $totalWorkshops
        ];
    }

    public function getStudentMatchingJob($idJob, $universityId) {
        $jobSkills = $this->jobRepository->find($idJob)->skills->pluck('id');

        $query = $this->model::where('id', $universityId)->with([
            'students' => function ($query) use ($jobSkills) {
                $query->whereHas('skills', function ($query) use ($jobSkills) {
                    $query->whereIn('skills.id', $jobSkills);
                });
            }
        ]);
        return $query->first();
    }
}
