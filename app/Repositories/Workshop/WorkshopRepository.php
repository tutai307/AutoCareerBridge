<?php

namespace App\Repositories\Workshop;

use App\Models\WorkShop;
use Illuminate\Support\Carbon;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Workshop\WorkshopRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorkshopRepository extends BaseRepository implements WorkshopRepositoryInterface
{
    public function getModel()
    {
        return WorkShop::class;
    }

    public function getWorkshop($filters)
    {
        $user = Auth::guard('admin')->user();
        if ($user->role === ROLE_SUB_UNIVERSITY) {
            $universityId = $user->academicAffair->university_id; 
        }
        if ($user->role === ROLE_UNIVERSITY) {
            $universityId = $user->university->id; 
        }
        $query = $this->model->where('university_id', $universityId);

        // Tìm kiếm theo từ khóa
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%');
            });
        }

        // Tìm kiếm theo khoảng ngày
        if (!empty($filters['date_range'])) {
            $dateRange = explode(" - ", $filters['date_range']);
            if (!empty($dateRange[0])) {
                $startDate = Carbon::createFromFormat('m/d/Y', $dateRange[0])->format('Y-m-d');
                if (!empty($dateRange[1])) {
                    $endDate = Carbon::createFromFormat('m/d/Y', $dateRange[1])->format('Y-m-d');
                    $query->whereBetween('start_date', [$startDate, $endDate])
                          ->whereBetween('end_date', [$startDate, $endDate]);
                } else {
                    $query->whereDate('start_date', '>=', $startDate);
                }
            }
        }

        $query->orderBy('created_at', 'desc');
        return $query->paginate(PAGINATE_WORKSHOP)->withQueryString();
    }

    public function getWorkshops(array $filters)
    {
        $query = $this->model->select(
            'work_shops.*',
            'universities.name as university_name',
        )->join('universities', 'work_shops.university_id', '=', 'universities.id');

        if (isset($filters['status'])) {
            $now = now();

            if ($filters['status'] == STATUS_PENDING) {
                $query->where('start_date', '>', $now);
            } elseif ($filters['status'] == STATUS_APPROVED) {
                $query->where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now);
            } elseif ($filters['status'] == STATUS_REJECTED) {
                $query->where('end_date', '<', $now);
            }
        }

        if (isset($filters['search'])) {
            $query->where('work_shops.name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('universities.name', 'like', '%' . $filters['search'] . '%');
        }

        $query->orderBy('work_shops.start_date', 'desc');

        return $query->paginate(LIMIT_10)->withQueryString();
    }

    public function findWorkshop($find)
    {
        $query = $this->model->select(
            'work_shops.*',
            'universities.name as university_name',
            'universities.avatar_path as university_avatar_path',
            DB::raw('COUNT(company_workshops.company_id) as company_count')
        )
            ->leftJoin('universities', 'work_shops.university_id', '=', 'universities.id')
            ->leftJoin('company_workshops', 'work_shops.id', '=', 'company_workshops.workshop_id')
            ->groupBy('work_shops.id', 'universities.name', 'universities.avatar_path')
            ->where('work_shops.slug', '=', $find)
            ->get();
        return $query;
    }

    public function detailWorkShop($slug){
        $workshop= $this->model::where('slug',$slug)->first();

        return $workshop;
    }
}
