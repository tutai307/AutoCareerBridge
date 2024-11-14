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
            $address = Address::where('company_id', $company->id)
                ->with('province', 'district', 'ward')
                ->first();

            $company->address = $address;
        }

        return $company;
    }

    public function findBySlug($userId, $slug)
    {
        $companyInfo = Company::query()->where('user_id', $userId)
            ->where('slug', $slug)
            ->with('user')
            ->first();

        if ($companyInfo) {
            $address = Address::query()->where('company_id', $companyInfo->id)
                ->with('province', 'district', 'ward')
                ->first();

            $companyInfo->address = $address;

            if ($address) {

                $provinces = Province::all();
                $districtsData = District::all()->map(function ($district) {
                    return [
                        'id' => $district->id,
                        'name' => $district->name,
                    ];
                });

                $wardsData = Ward::all()->map(function ($ward) {
                    return [
                        'id' => $ward->id,
                        'name' => $ward->name,
                    ];
                });

                $companyInfo->provinces = $provinces;
                $companyInfo->districts = $districtsData;
                $companyInfo->wards = $wardsData;
            }
        }

        return $companyInfo;
    }

    public function getDistricts($provinceId)
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
        try {

            DB::beginTransaction();

            $company = Company::where('user_id', $userId)->first();
            $company->name = $data['name'];
            $company->slug = $data['slug'];
            $company->phone = $data['phone'];
            $company->size = $data['size'];
            $company->map = $data['map'];
            $company->description = $data['description'];
            $company->about = $data['about'];

            $address = Address::where('company_id', $company->id)->first();
            $address->specific_address = $data['specific_address'];
            $address->province_id = $data['province_id'];
            $address->district_id = $data['district_id'];
            $address->ward_id = $data['ward_id'];

            $company->save();
            $address->save();

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Cập nhật thông tin công ty lỗi: ' . $e->getMessage());
            throw $e;
        }
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
