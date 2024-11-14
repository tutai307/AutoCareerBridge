<?php

namespace App\Repositories\Company;

use App\Models\Company;
use App\Models\Provinces;
use App\Models\University;
use App\Repositories\Company\CompanyRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class CompanyRepository implements CompanyRepositoryInterface
{
    protected $model;
    public function __construct(Company  $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $universities = University::all();
        return $universities;
    }
    public function findUniversity($requet)
    {
        try {
            $name = $requet->name;
            $provinceId = $requet->province;
            $query = University::query();
            $query->join('address', 'universities.id', '=', 'address.university_id');
            if (!empty($name)) {
                $query->where('universities.name', 'like', '%' . $name . '%');
            }
            if (!empty($provinceId)) {
                $query->where('address.province_id', $provinceId);
            }
            $universities = $query->get();
            return $universities;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Không thể tìm dữ liệu '], 500);
        }
    }

    public function getProvinces()
    {
        $provinces = Provinces::all();
        return $provinces;
    }
}
