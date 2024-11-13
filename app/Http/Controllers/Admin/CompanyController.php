<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCompanyRequest;
use App\Service\Company\CompanyService;
use Exception;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $userId;
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->userId = 1;
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function profile($slug)
    {
        $companyProfile = $this->companyService->findProfile($this->userId, $slug);
        if (!$companyProfile) {
            return redirect()->back()->with('error', 'Không tìm thấy doanh nghiệp');
        }

        return view('management.company.profile.index', compact('companyProfile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function edit($slug)
    {
        $companyInfo = $this->companyService->editProfile($this->userId, $slug);
        if (!$companyInfo) {
            return redirect()->back()->with('error', 'Không tìm thấy doanh nghiệp');
        }
        return view('management.company.profile.update', compact('companyInfo'));
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

            // Gọi service để cập nhật thông tin công ty và địa chỉ
            $this->companyService->updateProfile($this->userId, $data);

            // Trả về thông báo thành công
            return back()->with('status_success', 'Cập nhật thông tin thành công');
        } catch (Exception $e) {
            // Xử lý lỗi và trả về thông báo lỗi
            return back()->with('error', 'Cập nhật thông tin thất bại');
        }
    }

    public function updateImage(Request $request)
    {
        try {
            if ($request->hasFile('avatar_path')) {
                $avatar = $request->file('avatar_path');

                $avatarPath = $this->companyService->updateAvatar($this->userId, $avatar);

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
