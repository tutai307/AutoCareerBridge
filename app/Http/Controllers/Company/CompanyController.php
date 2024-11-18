<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCompanyRequest;
use App\Services\Company\CompanyService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function profile()
    {
        $user = auth()->guard('admin')->user();
        $companyProfile = $this->companyService->findProfile($user->id);
        if (!$companyProfile)
        {
            $companyProfile = [];
        }
        return view('company.profile.index', compact('companyProfile'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function edit($slug)
    {
        $userID = auth()->guard('admin')->user()->id;
        $companyInfo = $this->companyService->editProfile($slug, $userID);
        return view('company.profile.update', compact(['companyInfo','userID']));
    }

    public function getProvinces()
    {
        $provinces = $this->companyService->getProvinces();
        return response()->json($provinces);
    }
    public function getDistricts($provinceId)
    {
        $districts = $this->companyService->getDistricts($provinceId);
        return response()->json($districts);
    }

    public function getWards($districtId)
    {
        $wards = $this->companyService->getWards($districtId);
        return response()->json($wards);
    }

    public function updateProfile(UpdateCompanyRequest $request)
    {
        try {
            $data = $request->all();
            $userId = auth()->guard('admin')->user()->id;

            $company = $this->companyService->findProfile($userId);

            if (!$company) {
                $company = $this->companyService->updateProfileService($userId, $data);
            } else {
                $company = $this->companyService->updateProfileService($company->slug, $data);
            }

            return redirect()->route('company.profile', ['slug' => $company->slug])
                ->with('status_success', 'Cập nhật thông tin thành công');
        } catch (Exception $e) {
            return back()->with('status_fail', 'Lỗi khi cập nhật thông tin: ' . $e->getMessage());
        }
    }


    public function updateImage(Request $request)
    {
        try {
            if ($request->hasFile('avatar_path')) {
                $userId = auth()->guard('admin')->user()->id;
                $avatar = $request->file('avatar_path');

                $company = $this->companyService->findProfile($userId);

                if (!$company) {
                    $avatarPath = $this->companyService->updateAvatar($userId, $avatar);
                } else {
                    $avatarPath = $this->companyService->updateAvatar($company->slug, $avatar);
                }
                return response()->json([
                    'success' => true,
                    'imageUrl' => asset('storage/' . $avatarPath),
                ]);
            }

            return response()->json(['success' => false, 'message' => 'Không có ảnh để tải lên'], 400);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Đã xảy ra lỗi'], 500);
        }
    }
}
