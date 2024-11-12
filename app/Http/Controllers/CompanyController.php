<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Address;
use App\Models\Company;
use App\Models\District;
use App\Models\Province;
use App\Models\User;
use App\Models\Ward;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    protected $user_id;

    public function __construct()
    {
        $user = User::query()->where('id', 1)->first();
        $this->user_id = $user ? $user->id : null;
    }

    /**
     * Display a listing of the resource.
     */
    public function profile()
    {
//        $id = auth()->user()->id;
        $companyProfile = Company::query()->where('user_id', $this->user_id)
            ->with('user')->first();
        $address = Address::query()->where('company_id', $companyProfile->id)
            ->with('province', 'district', 'ward')->first();
        return view('management.company.profile.index', compact(['companyProfile', 'address']));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function edit()
    {
        $companyInfo = Company::query()->where('user_id', $this->user_id)->with('user')->first();
        $address = Address::query()->where('company_id', $companyInfo->id)
            ->with('province', 'district', 'ward')->first();
        $provinces = Province::query()->get();
        $districts = District::query()->get();
        $wards = Ward::query()->get();
        return view('management.company.profile.update', compact(['companyInfo', 'address', 'provinces', 'districts', 'wards']));
    }

    public function getDistrictsByProvince($province_id)
    {
        $districts = DB::table('districts')->where('province_id', $province_id)->get();
        return response()->json($districts);
    }

    public function getWardsByDistrict($district_id)
    {
        $wards = DB::table('wards')->where('district_id', $district_id)->get();
        return response()->json($wards);
    }

    public function updateProfile(UpdateCompanyRequest $request)
    {
        try {
            $data = $request->all();
            DB::beginTransaction();

            // Cập nhật công ty
            $company = Company::where('user_id', $this->user_id)->first();
            $company->name = $data['name'];
            $company->slug = $data['slug'];
            $company->phone = $data['phone'];
            $company->size = $data['size'];
            $company->map = $data['map'];
            $company->description = $data['description'];
            $company->about = $data['about'];


            // Cập nhật địa chỉ
            $address = Address::where('company_id', $company->id)->first();
            $address->specific_address = $data['specific_address'];
            $address->province_id = $data['province_id'];
            $address->district_id = $data['district_id'];
            $address->ward_id = $data['ward_id'];

            $company->save();
            $address->save();

            DB::commit();
            return back()->with('status_success', 'Cập nhật thông tin thành công');
        } catch (Exception $e) {
            Log::error('Cập nhật thông tin công ty lỗi: ' . $e->getMessage());
            DB::rollBack();
            return back()->with('error', 'Cập nhật thông tin thất bại');
        }
    }



}
