<?php

namespace App\Repositories\Company;


use App\Models\Company;
use App\Models\Province;
use App\Models\University;
use App\Repositories\Base\BaseRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Address;
use App\Models\District;
use App\Models\Ward;
use Exception;
use Illuminate\Support\Facades\Storage;

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
        $universities = University::paginate(LIMIT_10);
        return $universities;
    }
    public function findUniversity($requet)
    {
        try {
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
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Không thể tìm thấy trường học');
        }
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

        Log::info('companyInfo', [$companyInfo]);

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

                $wards =  $this->ward->where('district_id', $address->district_id)
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
        $wards =  $this->ward->where('district_id', $districtId)->get();
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


    public function updateAvatar($identifier, $avatar)
    {
        try {
            $company = is_numeric($identifier)
                ? $this->model->where('user_id', $identifier)->first()
                : $this->model->where('slug', $identifier)->first();

            if (!$company) {
                throw new Exception('Không tìm thấy công ty');
            }

            if ($company->avatar_path) {
                Storage::disk('public')->delete($company->avatar_path);
            }
            $avatarPath = $avatar->store('avatars', 'public');

            $company->avatar_path = $avatarPath;
            $company->save();

            return $avatarPath;
        } catch (Exception $e) {
            Log::error('Lỗi khi tải ảnh lên: ' . $e->getMessage());
            throw $e;
        }
    }
}
