<?php

namespace App\Http\Controllers\Company;


use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCompanyRequest;
use App\Services\Company\CompanyService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * CompaniesController handles company management,
 * @author Hoang Duy Lap, Dang Duc Chung
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
    public function dashboard( )
    {
        try{
        $count = $this->companyService->dashboard();
        $currentYear = date('Y');
   
        return view('management.pages.company.dashboard.dashBoard',compact('count','currentYear'));
        }catch (Exception $e) {
            return back()->with('status_fail', 'Lỗi khi cập nhật thông tin: ' . $e->getMessage());
        }
    }
    /**
     * Display a listing of universities and provinces.
     * @return \Illuminate\View\View
     * @author Dang Duc Chung
     * @access public
     */
    public function searchUniversity(Request $request)
    {
        if ($request->has('searchName') || $request->has('searchProvince')) {
            $universities = $this->companyService->findUniversity($request);
        } else {
            $universities = $this->companyService->index();
        }
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
     * @param UpdateCompanyRequest $request
     * @access public
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception If an error occurs during the update process.
     * @author Hoang Duy Lap
     */
    public function updateProfile(UpdateCompanyRequest $request)
    {
        try {
            $data = $request->except('token');
            $company = $this->companyService->findProfile($this->userId);
            if (!$company) {
                $company = $this->companyService->updateProfileService($this->userId, $data);
            } else {
                $company = $this->companyService->updateProfileService($company->slug, $data);
            }

            return redirect()->route('company.profile', ['slug' => $company->slug])
                ->with('status_success', __('message.admin.update_success'));
        } catch (Exception $e) {
            return back()->with('status_fail',  __('message.admin.update_fail'). ' ' . $e->getMessage());
        }
    }

    /**
     * Updates the company profile image based on the provided request data.
     * Returns a JSON response indicating the success or failure of the operation.
     * @praram Request $request
     * @access public
     * @return \Illuminate\Http\JsonResponse
     * @author Hoang Duy Lap
     */
    public function updateImage(Request $request)
    {
        try {
            // Kiểm tra file avatar hợp lệ
            if ($request->hasFile('avatar_path') && $request->file('avatar_path')->isValid()) {
                $avatar = $request->file('avatar_path');
                $company = $this->companyService->findProfile($this->userId);

                // Nếu không tìm thấy công ty, tạo công ty mới
                if (!$company) {
                    $company = $this->companyService->createCompanyForUser($this->userId, [
                        'name' => 'Company Name',
                        'slug' => Str::slug('Default Company Name'),
                        'phone' => '0123456789'
                    ]);
                }

                // Cập nhật ảnh avatar
                $avatarPath = $this->companyService->updateAvatar($company->slug, $avatar);

                return response()->json([
                    'success' => true,
                    'imageUrl' => asset($avatarPath),
                ]);
            }

            return response()->json(['success' => false, 'message' => 'Không có ảnh để tải lên'], 400);
        } catch (Exception $e) {
            Log::error('Có lỗi khi cập nhật ảnh: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Không thể thêm ảnh: ' . $e->getMessage()], 400);
        }
    }

}
