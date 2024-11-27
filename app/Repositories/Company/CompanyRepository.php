<?php

namespace App\Repositories\Company;

use App\Models\Address;
use App\Models\Company;
use App\Models\District;
use App\Models\Province;
use App\Models\University;
use App\Models\Ward;
use App\Repositories\Base\BaseRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompanyRepository extends BaseRepository implements CompanyRepositoryInterface
{
    public $address;
    public $province;
    public $district;
    public $ward;

    public function __construct(Address $address, Province $province, District $district, Ward $ward)
    {
        parent::__construct();
        $this->address = $address;
        $this->province = $province;
        $this->district = $district;
        $this->ward = $ward;
    }

    public function getModel()
    {
        return Company::class;
    }

    public function index()
    {
        $companyId = null;
        if (auth()->guard('admin')->check()) {
            $user = auth()->guard('admin')->user();
            if ($user && $user->company) {
                $companyId = $user->company->id;
            }
        }
        $universities = University::with('collaborations')
            ->withCount(['collaborations as is_collaborated' => function ($query) use ($companyId) {
                $query->where('company_id', $companyId)->whereIn('status', [1, 2]);
            }])
            ->orderByRaw('is_collaborated DESC')
            ->paginate(LIMIT_10);

        return $universities;
    }

    public function dashboard($companyId)
    {
        $company = Company::find($companyId);
        $countHiring = $company->hirings()->where('company_id', $companyId)->count();
        $countCollaboration = $company->collaborations()->where('company_id', $companyId)->count();
        $jobCount = $company->hirings()->withCount('jobs')->get()->sum('jobs_count');
        $countWorkShop = $company->companyWorkshops()->where('company_id', $companyId)->count();
        $currentYear = now()->year;
        $currentMonth = now()->month;
        $query = $company->hirings()
            ->join('jobs', 'hirings.user_id', '=', 'jobs.hiring_id')
            ->select(
                DB::raw('YEAR(jobs.created_at) as year'),
                DB::raw('MONTH(jobs.created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->whereBetween('jobs.created_at', [now()->subYears(2)->startOfYear(), now()->endOfMonth()])
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc');
        $data = $query->get();
        $jobsPerMonthArray = [];
        for ($year = $currentYear - 2; $year <= $currentYear; $year++) {
            $months = ($year == $currentYear) ? $currentMonth : 12;
            $jobsPerMonthArray[$year] = array_fill(1, $months, 0);
        }

        foreach ($data as $row) {
            $jobsPerMonthArray[$row->year][$row->month] = $row->total;
        }

        return [
            'countHiring' => $countHiring,
            'countCollaboration' => $countCollaboration,
            'countWorkShop' => $countWorkShop,
            'countJob' => $jobCount,
            'jobsPerYear' => $jobsPerMonthArray,

        ];
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


    public function findByUserIdAndSlug($userId)
    {
        $company = $this->model->where('user_id', $userId)
            ->first();

        if ($company) {
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
        }

        return $company;
    }

    public function findBySlug($userId, $slug)
    {
        $companyInfo = $this->model->where('user_id', $userId)->first();

        if (!$companyInfo) {
            $companyInfo = $this->model
                ->where('slug', $slug)
                ->first();
        }

        if ($companyInfo) {
            $address = $this->address->query()
                ->where('company_id', $companyInfo->id)
                ->with(['province', 'district', 'ward'])
                ->first();

            $companyInfo->address = $address;
            Log::info('address', [$companyInfo->address]);

            $provinces = $this->province->all();
            $companyInfo->provinces = $provinces;

            if ($address) {
                $districts = $this->district->where('province_id', $address->province_id)
                    ->get();
                $companyInfo->districts = $districts;
                Log::info('districts', [$companyInfo->districts]);

                $wards = $this->ward->where('district_id', $address->district_id)
                    ->get();
                $companyInfo->wards = $wards;
            }
        }
        return $companyInfo;
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

    public function updateProfile($identifier, $data)
    {
        // Kiểm tra xem identifier là user_id hay slug
        $company = is_numeric($identifier)
            ? $this->model->where('user_id', $identifier)->first()
            : $this->model->where('slug', $identifier)->first();

        if (!$company) {
            // Nếu không tìm thấy company và identifier là user_id thì tạo mới
            if (is_numeric($identifier)) {
                $company = $this->create([
                    'user_id' => $identifier,
                    'name' => $data['name'],
                    'slug' => $data['slug'],
                    'phone' => $data['phone'],
                    'size' => $data['size'],
                    'description' => $data['description'],
                    'about' => $data['about'],
                ]);
            } else {
                throw new Exception('Không tìm thấy thông tin công ty');
            }
        } else {
            $this->update($company->id, [
                'name' => $data['name'],
                'slug' => $data['slug'],
                'phone' => $data['phone'] ?? '',
                'size' => $data['size'],
                'description' => $data['description'],
                'about' => $data['about'],
            ]);
        }

        $address = $this->address->where('company_id', $company->id)->first();
        if (!$address) {
            $this->address->create([
                'company_id' => $company->id,
                'specific_address' => $data['specific_address'],
                'province_id' => $data['province_id'],
                'district_id' => $data['district_id'],
                'ward_id' => $data['ward_id'],
            ]);
        } else {
            $address->update([
                'specific_address' => $data['specific_address'],
                'province_id' => $data['province_id'],
                'district_id' => $data['district_id'],
                'ward_id' => $data['ward_id'],
            ]);
        }
        return $company;
    }

    public function create($data = [])
    {
        return $this->model->create($data);
    }


    public function updateAvatar($identifier, $avatar)
    {
        try {
            // Lấy thông tin công ty dựa trên user_id hoặc slug
            $company = is_numeric($identifier)
                ? $this->model->where('user_id', $identifier)->first()
                : $this->model->where('slug', $identifier)->first();

            if (!$company) {
                throw new \Exception('Không tìm thấy công ty');
            }

            // Xóa ảnh cũ nếu đã có
            if ($company->avatar_path) {
                \Storage::disk('public')->delete($company->avatar_path);
            }

            // Lưu ảnh mới
            $avatarPath = $avatar->store('avatars', 'public');
            $company->avatar_path = $avatarPath;
            $company->save();

            return $avatarPath;
        } catch (\Exception $e) {
            \Log::error('Lỗi khi tải ảnh lên: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getAll()
    {
        return parent::getAll();
    }

    public function getCompanyBySlug($slug)
    {
        return $this->model->query()->where('slug', $slug)->with('addresses')->first();
    }

    public function getCompaniesWithJobsAndAddresses()
    {
        return Company::with(['hirings.jobs', 'addresses.province'])
            ->get()
            ->map(function ($company) {
                $jobCount = $company->hirings->sum(function ($hiring) {
                    return $hiring->jobs->count();
                });

                $company->job_count = $jobCount;

                return $company;
            })
            ->sortByDesc('job_count')
            ->take(PAGINATE_LIST_COMPANY_CLIENT); // Lấy 6 công ty có số lượng jobs nhiều nhất
    }

    public function getCompaniesWithFilters($query, $provinceId, $sortOrder)
    {
        return Company::with(['addresses.province', 'addresses.district', 'addresses.ward', 'hirings.jobs'])
            ->withCount(['hirings as job_count' => function ($query) {
                $query->select(\DB::raw('count(jobs.id)'))
                    ->join('jobs', 'jobs.hiring_id', '=', 'hirings.user_id');
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
                    $q->orderBy('job_count', $sortOrder); // Sắp xếp theo số lượng job
                }
            })
            ->paginate(PAGINATE_LIST_COMPANY_CLIENT)
            ->withQueryString();
    }
}
