<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Services\Universities\UniversityService;

use Illuminate\Http\Request;
use App\Http\Requests\University\UniversityUpdateImageRequest;
use App\Http\Requests\University\UniversityUpdateProfileRequest;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    protected $universityService;
    public function __construct(UniversityService $universityService)
    {
        $this->universityService = $universityService;
    }
    public function show()
    {
        $user = auth()->guard('admin')->user();
        $university_id = $user->id;
        $university = $this->universityService->getUniversityById($university_id);

        return view('management.university.profile.index', compact('university'));
    }

    public function uploadImage(UniversityUpdateImageRequest  $request)
    {

        $image = $request->file('university_image');
        $user = auth()->guard('admin')->user();
        $universityId = $user->id;

        $image = $request->file('university_image');
        $imageUrl = $this->universityService->uploadImage($universityId, $image);

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật ảnh thành công!',
            'image_url' => $imageUrl
        ]);
    }

    public function update(UniversityUpdateProfileRequest $request)
    {
        try {
            $validated = $request->validated();
            $user = auth()->guard('admin')->user()->university;
            $university_id = $user->id;

            $specific = $validated['specific_address'];
            $ward = $request['ward'];
            $district = $request['district'];
            $province = $request['province'];

            $mapIframe = $this->getMap($specific, $ward, $district, $province);

            // Xử lý cập nhật
            $user = $this->universityService->update($university_id, [
                'name' => $validated['name'],
                'slug' => $validated['slug'],
                'website_link' => $validated['website'],
                'about' => $validated['intro'],
                'description' => $validated['description'],
                'map' => $mapIframe,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thông tin trường thành công!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function getMap($specific_address, $wardId, $districtId, $provinceId)
    {
        // Giả sử bạn có các mô hình cho các bảng này
        $wardText = Ward::find($wardId)->name ?? 'Unknown Ward';
        $districtText = District::find($districtId)->name ?? 'Unknown District';
        $provinceText = Province::find($provinceId)->name ?? 'Unknown Province';

        $address = $specific_address . ', ' . $wardText . ', ' . $districtText . ', ' . $provinceText;
        $mapUrl = 'https://www.google.com/maps?q=' . urlencode($address).'&output=embed';
        $mapIframe = '<iframe src="' . $mapUrl . '" width="600" height="450" frameborder="0" allowfullscreen></iframe>';

        return $mapIframe;
    }
}
