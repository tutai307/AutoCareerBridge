<?php

namespace App\Repositories\Company;

use App\Models\Company;
use App\Models\Province;
use App\Models\University;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Company\CompanyRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class CompanyRepository extends BaseRepository implements CompanyRepositoryInterface
{
    protected $model;
    public function __construct(Company  $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        
    }
    public function index()
    {
        $universities = University::paginate(LIMIT_10);
        return $universities;
    }
    public function findUniversity($requet)
    {
        try {
            $name = $requet->searchName;
            $provinceId = $requet->searchProvince;
            $query = University::query();
            $query->join('address', 'universities.id', '=', 'address.university_id');
            if (!empty($name)) {
                $query->where('universities.name', 'like', '%' . $name . '%');
            }
            if (!empty($provinceId)) {
                $query->where('address.province_id', $provinceId);
            }
            $universities = $query->select('universities.*')
            ->paginate(LIMIT_10);
            return $universities;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Không thể tìm thấy trường học');

        }
    }

    public function getProvinces()
    {
        try{
            $provinces = Province::all();
            return $provinces;
        }catch(Exception $e){
            Log::error($e->getMessage());
            return back()->with('error', 'Không thể lấy địa chỉ');
        }
        
    }
}
