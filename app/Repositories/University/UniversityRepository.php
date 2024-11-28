<?php

namespace App\Repositories\University;
use App\Models\Address;
use App\Models\University;
use App\Models\WorkShop;
use App\Repositories\University\UniversityRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;

class UniversityRepository implements UniversityRepositoryInterface
{
    protected $model;
    protected $companyId;
    public function __construct(University $model)
    {
        $this->model = $model;
    }

    public function getAll(){
        $universitiesAll = $this->model::with('students')
        ->get()
        ->sortByDesc(function ($university) {
            return $university->students->count(); 
        });
        return $universitiesAll;
    }

    public function index()
    {
        $companyId = null;
        if (auth()->guard('admin')->check()) {
            $user = auth()->guard('admin')->user();
            if ($user && $user->company) {
                $companyId = $user->company->id;
            }
        }
        $universities = University::with('collaborations')
            ->withCount(['collaborations as is_collaborated' => function ($query) use ($companyId) {
                $query->where('company_id', $companyId)->whereIn('status', [1, 2]);
            }])
            ->orderByRaw('is_collaborated DESC') 
            ->paginate(LIMIT_10);
        
        return $universities;
        return $universities;
    }

    public function findUniversity($requet)
    {
        $name = $requet->searchName;
        $provinceId = $requet->searchProvince;
        $query =  $this->model::query();
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
    }

    public function getDetailUniversity($slug)
    {
        try {
            $detail = $this->model::with('user', 'majors', 'students', 'collaborations')
                ->where('universities.slug', $slug)
                ->select(
                    'universities.*'
                )->firstOrFail();
            $address = Address::query()
                ->with('province', 'district', 'ward')
                ->where('university_id', $detail->id)
                ->first();
            return [
                'detail' => $detail,
                'address' => $address,
            ];
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Không thể tìm thấy trường học');
        }
    }

    public function getWorkShops($slug)
    {
        $workshops = $this->model::where('slug', $slug)  // Tìm kiếm university theo slug
        ->firstOrFail()  // Lấy trường hợp đầu tiên hoặc ném lỗi 404 nếu không có
        ->workshops()  // Truy vấn quan hệ workshops
        ->where('status', 1)  // Lọc workshop có status = 1
        ->get();  // Lấy t
        return $workshops;
    }
}
