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

    public function getDetailUniversity($id)
    {
        try {
            $detail = $this->model::with('user', 'majors', 'students', 'collaborations')
                ->where('universities.id', $id)
                ->select(
                    'universities.*'
                )->firstOrFail();
            $address = Address::query()
                ->with('province', 'district', 'ward')
                ->where('university_id', $id)
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

    public function getWorkShops($id)
    {
        $workshop = WorkShop::where('university_id', $id)->where('status', 1)->get();
        return $workshop;
    }
}
