<?php

namespace App\Http\Controllers\Company;


use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCompanyRequest;
use App\Services\Company\CompanyService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompaniesController extends Controller
{
    protected $userId;
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
        $this->middleware(function ($request, $next) {
            $this->userId = auth()->guard('admin')->user()->id;
            return $next($request);
        });
    }
/**
     * Display a listing of universities and provinces.
     * @author Dang Duc Chung
     * @access public
     * @return \Illuminate\View\View  
     */
    public function index(Request $request)
    {
        if ($request->has('searchName') || $request->has('searchProvince')) {
            $universities = $this->companyService->findUniversity($request);
        } else {
            $universities = $this->companyService->index();
        }
        $provinces = $this->companyService->getProvinces();
        return view('company.search.searchUniversity', compact('universities', 'provinces'));
    }

    /**
     * Display a listing of the resource.
     */
    public function profile()
    {
        $companyProfile = $this->companyService->findProfile($this->userId);
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
        $userId = auth()->guard('admin')->user()->id;
        $companyInfo = $this->companyService->editProfile($slug, $this->userId);
        return view('company.profile.update', compact(['companyInfo','userId']));
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
            $company = $this->companyService->findProfile($this->userId);

            if (!$company) {
                $company = $this->companyService->updateProfileService($this->userId, $data);
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
                $avatar = $request->file('avatar_path');

                $company = $this->companyService->findProfile($this->userId);

                if (!$company) {
                    $avatarPath = $this->companyService->updateAvatar($this->userId, $avatar);
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
