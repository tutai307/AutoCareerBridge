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
        $universities = University::with('collaborations')->paginate(LIMIT_10);
        return $universities;
    }

    public function dashboard($companyId)
    {
        $company = Company::find($companyId);
        $countHiring = $company->hirings()->where('company_id', $companyId)->count();
        $countCollaboration = $company->collaborations()->where('company_id', $companyId)->count();
        $jobCount = $company->hirings()->withCount('job')->get()->sum('job_count');
        $countWorkShop = $company->companyWorkshops()->where('company_id', $companyId)->count();

        $jobsPerMonth = $company->hirings()
            ->join('jobs', 'hirings.user_id', '=', 'jobs.hiring_id')
            ->select(
                DB::raw('MONTH(jobs.created_at) as month'),
                DB::raw('COUNT(jobs.id) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');
        $jobsPerMonth = collect(range(1, 12))->mapWithKeys(function ($month) use ($jobsPerMonth) {
            return [$month => $jobsPerMonth[$month] ?? 0];
        });
        $jobsPerMonthArray = $jobsPerMonth->values()->toArray();
        $currentMonth = Carbon::now()->month;
        $jobsThisMonth = $jobsPerMonthArray[$currentMonth - 1];
        return [
            'countHiring' => $countHiring,
            'countCollaboration' => $countCollaboration,
            'countWorkShop' => $countWorkShop,
            'countJob' => $jobCount,
            'jobsPerMonth' => $jobsPerMonthArray,
            'jobsThisMonth' => $jobsThisMonth,
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
}
