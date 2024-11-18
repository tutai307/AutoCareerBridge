<?php

namespace App\Repositories\University;

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
            $detail = $this->model::with('user', 'majors','students','companies')->join('address', 'universities.id', '=', 'address.university_id') 
                ->join('wards', 'address.ward_id', '=', 'wards.id')
                ->join('provinces', 'address.province_id', '=', 'provinces.id')
                ->join('districts', 'address.district_id', '=', 'districts.id')         
                ->where('universities.id', $id)
                ->select(
                    'universities.*',
                    'address.specific_address as specific_address',
                    'wards.name as ward_name',
                    'provinces.name as province_name',
                    'districts.name as district_name',  
                )
                ->firstOrFail();
            return $detail;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Không thể tìm thấy trường học');
        }
    }

    public function getWorkShops($id){
        $workshop =WorkShop::where('university_id',$id)->get();
        return $workshop;

    }
}
