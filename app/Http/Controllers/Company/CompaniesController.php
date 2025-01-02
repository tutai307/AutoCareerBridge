<?php

namespace App\Http\Controllers\Company;


use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CompanyRequest;
use App\Services\Company\CompanyService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * CompaniesController handles company management,
 * @author Hoang Duy Lap, Dang Duc Chung, Tran Van Nhat
 * @access public
 * @package Company
 * @see profile()
 * @see edit()
 * @see updateProfile()
 * @see getProvinces()
 * @see getDistricts()
 * @see getWards()
 * @see updateImage()
 */
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
     * Show data of company.
     * @return \Illuminate\View\View
     * @author Dang Duc Chung
     * @access public
     */
    public function dashboard()
    {
        try {
            $count = $this->companyService->dashboard();
            $currentYear = date('Y');
            $getJobStats = $this->companyService->getJobStats();
            return view('management.pages.company.dashboard.dashBoard', [
                'count' => $count,
                'currentYear' => $currentYear,
                'getJobStats' => $getJobStats
            ]);
        } catch (Exception $e) {
            Log::error('Lỗi: ' . $e->getMessage());
            return back()->with('status_fail', 'Lỗi khi cập nhật thông tin: ' . $e->getMessage());
        }
    }

    /**
     * Get chart data for company.
     * @return \Illuminate\Http\JsonResponse
     * @access public
     */
    public function getJobChart(Request $request){
        $user = auth()->guard('admin')->user();
        $companyId = $user->company->id ?? $user->hiring->company_id;
        $getJobStats = $this->companyService->getChart($companyId, $request->previousDate, $request->currentDate);
        return response()->json($getJobStats);
    }

    /**
     * Display a listing of universities and provinces.
     * @return \Illuminate\View\View
     * @author Dang Duc Chung
     * @access public
     */
    public function searchUniversity(Request $request)
    {
        $universities = $this->companyService->getUniversity($request);
        $provinces = $this->companyService->getProvinces();
        return view('management.pages.company.search.searchUniversity', compact('universities', 'provinces'));
    }

    /**
     * Retrieves the company profile for the given user ID and returns the profile view.
     * If no profile is found, an empty array is returned.
     *
     * @access public
     * @return \Illuminate\View\View
     * @author Hoang Duy Lap
     */
    public function profile()
    {
        $companyProfile = $this->companyService->findProfile($this->userId);
        if (!$companyProfile) {
            $companyProfile = [];
        }

        return view('management.pages.company.profile.index', compact('companyProfile'));
    }

    /**
     * Retrieves the company profile for editing based on the given slug and user ID.
     * * Returns the edit profile view with the necessary data.
     * @param string $slug The unique identifier for the company profile.
     * @access public
     * @return \Illuminate\View\View
     * @author Hoang Duy Lap
     */
    public function edit($slug)
    {
        $user = auth()->guard('admin')->user();
        $companyInfo = $this->companyService->editProfile($slug, $this->userId);

        return view('management.pages.company.profile.update', compact(['companyInfo', 'user']));
    }

    /**
     * Fetches a list of provinces from the company service and returns it as a JSON response.
     *
     * @access public
     * @return \Illuminate\Http\JsonResponse
     * @author Hoang Duy Lap
     */
    public function getProvinces()
    {
        $provinces = $this->companyService->getProvinces();
        return response()->json($provinces);
    }

    /**
     * Fetches a list of districts from the company service and returns it as a JSON response.
     * @praram int $provinceId
     * @access public
     * @return \Illuminate\Http\JsonResponse
     * @author Hoang Duy Lap
     */
    public function getDistricts($provinceId)
    {
        $districts = $this->companyService->getDistricts($provinceId);
        return response()->json($districts);
    }

    /**
     * Fetches a list of wards from the company service and returns it as a JSON response.
     * @praram int $districtId
     * @access public
     * @return \Illuminate\Http\JsonResponse
     * @author Hoang Duy Lap
     */
    public function getWards($districtId)
    {
        $wards = $this->companyService->getWards($districtId);
        return response()->json($wards);
    }

    /**
     * Updates the company profile based on the provided user ID and request data.
     * Redirects to the company profile view on success or back to the form on failure.
     *
     * @param CompanyRequest $request
     * @access public
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception If an error occurs during the update process.
     * @author Hoang Duy Lap
     */
    public function updateProfile(CompanyRequest $request)
    {
        try {
            $data = $request->only([
                'name',
                'slug',
                'size',
                'avatar_path',
                'phone',
                'fields',
                'description',
                'about',
                'website_link',
                'province_id',
                'district_id',
                'ward_id',
                'specific_address',
            ]);
            $company = $this->companyService->findProfile($this->userId);

            if ($request->hasFile('avatar_path') && $request->file('avatar_path')->isValid()) {
                // Kiểm tra nếu có ảnh cũ và xóa nó
                if ($company && $company->avatar_path && Storage::disk('public')->exists($company->avatar_path)) {
                    Storage::disk('public')->delete($company->avatar_path);
                }

                // Lưu ảnh mới và lấy đường dẫn công khai
                $data['avatar_path'] = 'storage/' . $request->file('avatar_path')->store('company', 'public');
            } elseif ($company && $company->avatar_path) {
                $data['avatar_path'] = $company->avatar_path;
            }


            // Xác định mã định danh để cập nhật/tạo
            $identifier = $company ? $company->slug : $this->userId;
            Log::info('identifier controller', [$identifier]);

            // Cập nhật hoặc tạo
            $company = $this->companyService->updateProfileService($identifier, $data);
            Log::info('company controller', [$company]);

            return redirect()->route('company.profile', ['slug' => $company->slug])
                ->with('status_success', __('message.admin.update_success'));
        } catch (Exception $e) {
            Log::error('Profile Update Error: ' . $e->getLine() . ' ' . $e->getMessage());
            return back()->with('status_fail', __('message.admin.update_fail') . ' ' . $e->getMessage());
        }
    }
}
