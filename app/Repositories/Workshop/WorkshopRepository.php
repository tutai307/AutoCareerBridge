<?php

namespace App\Repositories\Workshop;

use App\Models\WorkShop;
use Illuminate\Support\Carbon;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Workshop\WorkshopRepositoryInterface;

class WorkshopRepository extends BaseRepository implements WorkshopRepositoryInterface
{
    public function getModel()
    {
        return WorkShop::class;
    }

    public function getWorkshop($filters)
    {
        $query = $this->model->where('university_id', auth('admin')->user()->university->id);

        // Tìm kiếm theo từ khóa
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%');
            });
        }

        // Tìm kiếm theo khoảng ngày
        if (!empty($filters['date_range'])) {
            $dateRange = explode(" to ", $filters['date_range']);
            $startDate = Carbon::createFromFormat('d/m/Y', $dateRange[0] ?? null);

            if (isset($dateRange[1])) {
                $endDate = Carbon::createFromFormat('d/m/Y', $dateRange[1]);
                $query->whereDate('start_date', '>=', $startDate)
                    ->whereDate('end_date', '<=', $endDate);
            } else {
                $query->whereDate('start_date', '>=', $startDate);
            }
        }

        $query->orderBy('created_at', 'desc');
        return $query->paginate(PAGINATE_WORKSHOP)->withQueryString();
    }
}
