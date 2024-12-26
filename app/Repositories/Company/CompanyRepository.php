<?php

namespace App\Repositories\Company;

use App\Models\Address;
use App\Models\Company;
use App\Models\District;
use App\Models\Field;
use App\Models\Job;
use App\Models\Province;
use App\Models\University;
use App\Models\Ward;
use App\Repositories\Base\BaseRepository;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompanyRepository extends BaseRepository implements CompanyRepositoryInterface
{
    public $address;
    public $province;
    public $district;
    public $ward;
    public $field;
    public $job;

    public function __construct(Address $address, Province $province, District $district, Ward $ward, Field $field, Job $job)
    {
        parent::__construct();
        $this->address = $address;
        $this->province = $province;
        $this->district = $district;
        $this->ward = $ward;
        $this->field = $field;
        $this->job = $job;
    }

    public function getModel()
    {
        return Company::class;
    }

    public function getUniversity($request)
    {
        $companyId = auth()->guard('admin')->user()?->company?->id;
        $query = University::query()
            ->join('addresses', 'universities.id', '=', 'addresses.university_id')
            ->select('universities.*')
            ->with('collaborations');

        if (!empty($request->searchName)) {
            $query->where('universities.name', 'like', '%' . $request->searchName . '%');
        }
        if (!empty($request->searchProvince)) {
            $query->where('addresses.province_id', $request->searchProvince);
        }
        if ($companyId) {
            $query->withCount([
                'collaborations as is_collaborated' => function ($subQuery) use ($companyId) {
                    $subQuery->where('company_id', $companyId);
                }
            ])->orderByDesc('is_collaborated');
        }
        return $query->paginate(LIMIT_10);
    }

    public function dashboard($companyId)
    {
        $company = $this->model::find($companyId);
        $countHiring = $company->hirings()->count();
        $countCollaboration = $company->collaborations()->count();
        $jobCountFromHirings = $company->hirings()->withCount('jobs')->get()->sum('jobs_count');
        $jobCountFromUsers = $company->user()->withCount('jobs')->get()->sum('jobs_count');
        $jobCount = $jobCountFromHirings + $jobCountFromUsers;
        $countWorkShop = $company->companyWorkshops()->count();
        $currentYear = now()->year;
        $currentMonth = now()->month;
        $query = DB::table('jobs')
            ->select(
                DB::raw('YEAR(jobs.created_at) as year'),
                DB::raw('MONTH(jobs.created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->where(function ($query) use ($company) {
                $query->whereIn('jobs.user_id', $company->hirings()->pluck('user_id')->toArray()) // Công việc từ user
                    ->orWhere('jobs.user_id', $company->user_id); // Công việc từ doanh nghiệp
            })
            ->whereBetween('jobs.created_at', [now()->subYears(2)->startOfYear(), now()->endOfMonth()])
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc');
        $data = $query->get();
        $jobsPerMonthArray = [];
        for ($year = $currentYear - 10; $year <= $currentYear; $year++) {
            $months = ($year == $currentYear) ? $currentMonth : 12;
            $jobsPerMonthArray[$year] = array_fill(1, $months, 0);
        }

        foreach ($data as $row) {
            $jobsPerMonthArray[$row->year][$row->month] = $row->total;
        }
        // dd($jobsPerMonthArray);
        return [
            'countHiring' => $countHiring,
            'countCollaboration' => $countCollaboration,
            'countWorkShop' => $countWorkShop,
            'countJob' => $jobCount,
            'jobsPerYear' => $jobsPerMonthArray,

        ];
    }

    public function getJobStats($companyId)
    {
        $company = $this->model::find($companyId);
        $jobs = $company->hirings()
            ->with('jobs.universities')
            ->get()
            ->pluck('jobs')
            ->flatten()
            ->merge(
                Job::where('user_id', $company->user_id)  // Lấy công việc do chính doanh nghiệp đăng
                    ->with('universities')
                    ->get()
            );

        $jobsByMonthReceived = array_fill(1, 12, 0);
        $jobsByMonthNotReceived = array_fill(1, 12, 0);
        foreach ($jobs as $job) {
            $month = $job->created_at->month;
            if ($job->universities->isNotEmpty()) {
                $jobsByMonthReceived[$month]++;
            } else {
                $jobsByMonthNotReceived[$month]++;
            }
        }
        ksort($jobsByMonthReceived);
        ksort($jobsByMonthNotReceived);
        return [
            'received_jobs' => $jobsByMonthReceived,
            'not_received_jobs' => $jobsByMonthNotReceived,
        ];
    }

    // public function getChart($companyId, $dateFrom, $dateTo)
    // {
    //     if ($dateFrom && $dateTo) {
    //         $dateFrom = "2024-05-09";
    //         $dateTo = "2024-12-25"; // Sửa từ ngày kết thúc
    //         $query = $this->job
    //             ->selectRaw('
    //                 COUNT(CASE WHEN status = ? THEN 1 END) AS total_approved_jobs,
    //                 COUNT(CASE WHEN status = ? THEN 1 END) AS total_reject_jobs,
    //                 DATE(created_at) AS created_date
    //             ', [STATUS_APPROVED, STATUS_REJECTED])
    //             ->whereBetween('created_at', [$dateFrom, $dateTo])
    //             ->where('company_id', $companyId)
    //             ->groupBy(DB::raw('DATE(created_at)'))
    //             ->orderBy('created_date', 'asc');
    //         return $query->get();
    //     } else {
    //         return null;
    //     }
    // }
    public function getChart($companyId, $dateFrom, $dateTo)
    {
        if ($dateFrom && $dateTo) {
            $query = $this->job->withTrashed()
                ->selectRaw('
                    COUNT(CASE WHEN status = ? THEN 1 END) AS total_pending_jobs,
                    COUNT(CASE WHEN status = ? THEN 1 END) AS total_approved_jobs,
                    COUNT(CASE WHEN status = ? THEN 1 END) AS total_reject_jobs,
                    COUNT(CASE WHEN status = ? AND deleted_at IS NOT NULL THEN 1 END) AS total_deleted_jobs,

                    DATE(created_at) AS created_date
                ', [STATUS_PENDING, STATUS_APPROVED, STATUS_REJECTED, STATUS_APPROVED])
                ->whereBetween('created_at', [$dateFrom, $dateTo])
                ->where('company_id', $companyId)
                ->groupBy(DB::raw('DATE(created_at)'))
                ->orderBy('created_date', 'asc');

            return $query->get();
        } else {
            return null;
        }
    }

    public function findUniversity($requet)
    {
        $name = $requet->searchName;
        $provinceId = $requet->searchProvince;
        $query = University::query();
        $query->join('addresses', 'universities.id', '=', 'addresses.university_id');
        if (!empty($name)) {
            $query->where('universities.name', 'like', '%' . $name . '%');
        }
        if (!empty($provinceId)) {
            $query->where('addresses.province_id', $provinceId);
        }
        $universities = $query->select('universities.*')
            ->paginate(LIMIT_10);
        return $universities;
    }

    /**
     * Retrieves the company profile based on the provided user ID.
     * Includes the company address with detailed administrative divisions.
     *
     * @param int $userId
     * @access public
     * @return object|null
     * @throws \Exception
     * @author Hoang Duy Lap
     */
    public function findByUserIdAndSlug($userId)
    {
        $company = $this->model->where('user_id', $userId)
            ->first();

        if ($company) {
            $jobs = $company->jobs
                ->where('status', STATUS_APPROVED)
                ->where('end_date', '>', now())
                ->sortByDesc('created_at') // Sắp xếp theo ngày mới nhất lên đầu
                ->take(PAGINATE_LIST_COMPANY); // Giới hạn số lượng công việc

            $address = $this->address->query()
                ->with('province', 'district', 'ward')
                ->where('company_id', $company->id)
                ->first();

            if ($address) {
                $provinceName = $address->province->name;
                $districtName = $address->district->name;
                $wardName = $address->ward->name;

                $map = $address->specific_address . ', ' . $wardName . ', ' . $districtName . ', ' . $provinceName;
                $address->map = $map;
            }

            $company->address = $address;
            $company->jobs = $jobs;
        }

        return $company;
    }

    /**
     * Retrieves a company profile based on a specific column and value.
     * Includes related fields, address, and administrative divisions.
     *
     * @param string $column
     * @param mixed $value
     * @access public
     * @return object|null
     * @throws \Exception
     * @author Hoang Duy Lap
     */
    public function findCompany($column, $value)
    {
        $companyInfo = $this->model->where($column, $value)->first();

        $allFields = $this->field->all();
        if ($companyInfo) {
            $companyInfo->allFields = $allFields;

            // Lấy các fields liên kết với công ty
            $companyFields = $companyInfo->fields;
            $companyInfo->fields = $companyFields;

            // Lấy địa chỉ của công ty
            $address = $this->address->query()
                ->where('company_id', $companyInfo->id)
                ->with(['province', 'district', 'ward'])
                ->first();

            $companyInfo->address = $address;

            // Lấy danh sách tỉnh/thành phố
            $provinces = $this->province->all();
            $companyInfo->provinces = $provinces;

            if ($address) {
                // Lấy các quận/huyện
                $districts = $this->district->where('province_id', $address->province_id)
                    ->get();
                $companyInfo->districts = $districts;

                // Lấy các phường/xã
                $wards = $this->ward->where('district_id', $address->district_id)
                    ->get();
                $companyInfo->wards = $wards;
            }
        } else {
            // Nếu không có công ty, bạn vẫn trả về tất cả các fields
            $companyInfo = (object)[
                'allFields' => $allFields,
                'fields' => [], // không có fields liên kết khi không có công ty
                'address' => null,
                'provinces' => $this->province->all(),
                'districts' => [],
                'wards' => [],
            ];
        }

        return $companyInfo;
    }

    public function findBySlug($slug)
    {
        return $this->findCompany('slug', $slug);
    }

    public function findById($userId)
    {
        return $this->findCompany('user_id', $userId);
    }

    public function getProvinces()
    {
        $provinces = $this->province->all();
        return $provinces;
    }

    public function getDistricts($provinceId)
    {
        $districts = $this->district->where('province_id', $provinceId)->get();
        return $districts;
    }

    public function getWards($districtId)
    {
        $wards = $this->ward->where('district_id', $districtId)->get();
        return $wards;
    }

    /**
     * Updates or creates a company profile and its associated address.
     * If the company does not exist, it will be created.
     *
     * @param int|string $identifier
     * @param array $data
     * @access public
     * @return object
     * @throws \Exception
     * @author Hoang Duy Lap
     */
    public function updateProfile($identifier, $data)
    {
        $company = is_numeric($identifier)
            ? $this->model->where('user_id', $identifier)->first()
            : $this->model->where('slug', $identifier)->first();

        if (empty($company)) {
            if (is_numeric($identifier)) {
                $company = $this->create([
                    'user_id' => $identifier,
                    'name' => $data['name'],
                    'slug' => $data['slug'],
                    'avatar_path' => $data['avatar_path'] ?? null,
                    'phone' => $data['phone'],
                    'size' => $data['size'],
                    'description' => $data['description'],
                    'about' => $data['about'],
                    'website_link' => $data['website_link'],
                    'is_active' => false
                ]);
            } else {
                throw new Exception('Company information not found');
            }
        } else {
            $this->update($company->id, [
                'name' => $data['name'],
                'slug' => $data['slug'],
                'avatar_path' => $data['avatar_path'] ?? $company->avatar_path,
                'size' => $data['size'],
                'phone' => $company->phone ?: $data['phone'],
                'description' => $data['description'],
                'about' => $data['about'],
                'website_link' => $data['website_link'],
            ]);
        }

        $address = $this->address->where('company_id', $company->id)->first();
        if (!$address) {
            if (!empty($data['specific_address']) && $data['province_id'] && $data['district_id'] && $data['ward_id']) {
                $this->address->create([
                    'company_id' => $company->id,
                    'specific_address' => $data['specific_address'],
                    'province_id' => $data['province_id'],
                    'district_id' => $data['district_id'],
                    'ward_id' => $data['ward_id'],
                ]);
            }
        } else {
            $address->update([
                'specific_address' => $data['specific_address'],
                'province_id' => $data['province_id'],
                'district_id' => $data['district_id'],
                'ward_id' => $data['ward_id'],
            ]);
        }

        if (!empty($data['fields'])) {
            $company->fields()->sync($data['fields']);
        }

        return $company;
    }

    public function getAll()
    {
        return parent::getAll();
    }

    /**
     * Retrieves a company by its slug along with related data.
     * Loads associated addresses, fields, jobs, and their related entities. Filters approved jobs and calculates
     * the remaining job time. Constructs a formatted full address for the company.
     *
     * @param string $slug The slug of the company to retrieve.
     * @access public
     * @return \Illuminate\Database\Eloquent\Model|null The company model with related data or null if not found.
     *
     * @throws \Exception
     * @author Hoang Duy Lap
     */

    public function getCompanyBySlug($slug)
    {
        $company = $this->model->query()
            ->where('slug', $slug)
            ->with([
                'addresses.ward',
                'addresses.district',
                'addresses.province',
                'fields',
                'jobs.user',
                'jobs.major',
                'jobs.skills',
            ])
            ->first();

        if ($company) {
            $company->jobs = $company->jobs
                ->filter(function ($job) {
                    return $job->status === STATUS_APPROVED && $job->end_date > Carbon::now();
                })
                ->map(function ($job) {
                    $job->job_time = Carbon::parse($job->end_date)->startOfDay()->diffInDays(now()->startOfDay());
                    return $job;
                });
        }

        $address = $company->addresses->first();
        if ($address) {
            $ward = $address->ward->name ?? '';
            $district = $address->district->name ?? '';
            $province = $address->province->name ?? '';
            $fullAddress = $address->specific_address . ', ' . $ward . ', ' . $district . ', ' . $province;

            $company->province = $province;
            $company->district = $district;

            $company->address = $fullAddress;
        } else {
            $company->address = 'Address not available';
        }

        return $company;
    }

    public function getCompaniesWithJobsAndAddresses()
    {
        return $this->model->with(['addresses.province'])
            ->withCount(['jobs' => function ($query) {
                $query->where('status', STATUS_APPROVED)
                    ->whereDate('end_date', GREATER_THAN_OR_EQUAL, Carbon::now()->format('Y-m-d'));
            }])
            ->get()
            ->sortByDesc('job_count')
            ->take(PAGINATE_LIST_COMPANY_CLIENT); // Lấy 6 công ty có số lượng jobs nhiều nhất
    }

    public function getCompaniesWithFilters($query, $provinceId, $sortOrder)
    {
        return $this->model->with(['addresses.province', 'addresses.district', 'addresses.ward'])
            ->withCount(['jobs' => function ($query) {
                $query->where('status', STATUS_APPROVED)
                    ->whereDate('end_date', GREATER_THAN_OR_EQUAL, Carbon::now()->format('Y-m-d'));
            }])
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'LIKE', "%$query%");
            })
            ->when($provinceId, function ($q) use ($provinceId) {
                $q->whereHas('addresses.province', function ($q) use ($provinceId) {
                    $q->where('id', $provinceId);
                });
            })
            ->when($sortOrder, function ($q) use ($sortOrder) {
                if (in_array($sortOrder, ['asc', 'desc'])) {
                    $q->orderBy('jobs_count', $sortOrder); // Sắp xếp theo số lượng job
                }
            })
            ->whereHas('user', function ($q) {
                $q->where('active', ACTIVE);
            })
            ->paginate(PAGINATE_LIST_COMPANY_CLIENT)
            ->withQueryString();
    }
}
