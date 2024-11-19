<?php

namespace App\Repositories\Workshop;

use App\Models\Workshop;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\DB;

class WorkshopRepository extends BaseRepository implements WorkshopRepositoryInterface
{
    public function getModel()
    {
        return Workshop::class;
    }

    public function getWorkshops(array $filters)
    {
        $query = $this->model->select(
            'workshops.*',
            'universities.name as university_name',
        )->join('universities', 'workshops.university_id', '=', 'universities.id');

        if (isset($filters['status'])) {
            $now = now();

            if ($filters['status'] == 0) {
                $query->where('start_date', '>', $now);
            } elseif ($filters['status'] == 1) {
                $query->where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now);
            } elseif ($filters['status'] == 2) {
                $query->where('end_date', '<', $now);
            }
        }

        if (isset($filters['search'])) {
            $query->where('workshops.name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('universities.name', 'like', '%' . $filters['search'] . '%');
        }

        $query->orderBy('workshops.start_date', 'desc');

        return $query->paginate(LIMIT_10)->withQueryString();
    }

    public function findWorkshop($find)
    {
        $query = $this->model->select(
            'workshops.*',
            'universities.name as university_name',
            'universities.avatar_path as university_avatar_path',
            DB::raw('COUNT(company_workshops.company_id) as company_count')
        )
            ->leftJoin('universities', 'workshops.university_id', '=', 'universities.id')
            ->leftJoin('company_workshops', 'workshops.id', '=', 'company_workshops.workshop_id')
            ->groupBy('workshops.id', 'universities.name', 'universities.avatar_path')
            ->where('workshops.slug', '=', $find) // Lọc theo slug của workshop
            ->get();
        return $query;
    }
}
