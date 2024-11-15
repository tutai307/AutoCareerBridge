<?php

namespace App\Repositories\Company;

use App\Models\Address;
use App\Models\Company;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use App\Repositories\Base\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CompanyRepository extends BaseRepository implements CompanyRepositoryInterface
{
//    protected $address;
//    protected $province;
//    protected $district;
//    protected $ward;
//
//    public function __construct(Address $address, Province $province, District $district, Ward $ward)
//    {
//        $this->address = $address;
//        $this->province = $province;
//        $this->district = $district;
//        $this->ward = $ward;
//    }

    public function getModel()
    {
        return Company::class;
    }

    public function findByUserIdAndSlug($userId, $slug)
    {
        $company = $this->model->where('user_id', $userId)
            ->where('slug', $slug)
            ->first();

        if ($company) {
            $address = Address::query()
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
        $companyInfo = $this->model->where('user_id', $userId)
            ->with('user')
            ->first();

        if ($companyInfo) {
            // Load địa chỉ với các quan hệ
            $address = Address::query()
                ->where('company_id', $companyInfo->id)
                ->with(['province', 'district', 'ward'])
                ->first();

            $companyInfo->address = $address;

            // Load tất cả tỉnh
            $provinces = Province::all();
            $companyInfo->provinces = $provinces;

            // Nếu có địa chỉ, load districts của province được chọn
            if ($address) {
                $districts = District::where('province_id', $address->province_id)
                    ->get();
                $companyInfo->districts = $districts;

                // Load wards của district được chọn
                $wards = Ward::where('district_id', $address->district_id)
                    ->get();
                $companyInfo->wards = $wards;
            }
        }

        return $companyInfo;
    }

    public function getProvinces()
    {
        $provinces = District::all();
        return $provinces;
    } public function getDistricts($provinceId)
    {
        $districts = District::where('province_id', $provinceId)->get();
        return $districts;
    }

    public function getWards($districtId)
    {
        $wards = Ward::where('district_id', $districtId)->get();
        return $wards;
    }

    public function updateProfile($userId, $data)
    {
        $company = $this->model->where('user_id', $userId)->first();

        if (!$company) {
            $company = $this->create([
                'user_id' => $userId,
                'name' => $data['name'],
                'slug' => $data['slug'],
                'phone' => $data['phone'],
                'size' => $data['size'],
                'description' => $data['description'],
                'about' => $data['about'],
            ]);
        } else {
            $this->update($company->id, [
                'name' => $data['name'],
                'slug' => $data['slug'],
                'phone' => $data['phone'],
                'size' => $data['size'],
                'description' => $data['description'],
                'about' => $data['about'],
            ]);
        }

        $address = Address::where('company_id', $company->id)->first();

        if (!$address) {
            Address::create([
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


    public function updateAvatar($userId, $avatar)
    {
        try {
            $company = Company::where('user_id', $userId)->first();

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
