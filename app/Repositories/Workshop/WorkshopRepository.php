<?php

namespace App\Repositories\Workshop;

use App\Models\CompanyWorkshop;
use App\Models\WorkShop;
use Illuminate\Support\Carbon;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Workshop\WorkshopRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorkshopRepository extends BaseRepository implements WorkshopRepositoryInterface
{
    protected $companyWorkshop;
    public function __construct(CompanyWorkshop $companyWorkshop)
    {
        $this->companyWorkshop = $companyWorkshop;
        parent::__construct();
    }
    public function getModel()
    {
        return WorkShop::class;
    }

    public function getWorkShopClient()
    {
        $query = $this->model
            ->with('university')
            ->where('end_date', '>', now());

        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role === ROLE_COMPANY) {
            $companyId = Auth::guard('admin')->user()->id;

            // Tạo thêm trường hợp ưu tiên sắp xếp
            $query = $query->addSelect([
                'is_collaborated' => function ($subQuery) use ($companyId) {
                    $subQuery->selectRaw('COUNT(*)')
                        ->from('collaborations')
                        ->where([
                            ['collaborations.company_id', $companyId],
                            ['collaborations.status', STATUS_APPROVED],
                        ]);
                }
            ])->orderByDesc('is_collaborated');
            return $query->paginate(PAGINATE_WORKSHOP_CLIENT);
        }

        $query = $query->orderBy('created_at', 'desc');
        return $query->paginate(PAGINATE_WORKSHOP_CLIENT);
    }

    public function getWorkShopsHot()
    {
        return $this->model
            ->with('university')
            ->where('end_date', '>', now())
            ->orderBy('created_at', 'desc')
            ->limit(LIMIT_10)
            ->get();
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

    public function detailWorkShop($slug)
    {
        $workshop = $this->model::where('slug', $slug)->first();
        $countCompany = $workshop->companyWorkshops()->where('status', STATUS_APPROVED)->count();
        return [$workshop, $countCompany];
    }

    public function applyWorkShop($companyId, $workshopId)
    {
        return $this->companyWorkshop->create(['company_id' => $companyId, 'workshop_id' => $workshopId, 'status' => STATUS_PENDING]);
    }

    public function manageCompanyWorkshop($universityId)
    {
        $companyWorkshop = $this->companyWorkshop->whereHas('workshops', function ($query) use ($universityId) {
            $query->where('university_id', $universityId);  // Lọc workshops theo university_id
        })->orderBy('updated_at', 'desc')->get();

        $pending = $companyWorkshop->filter(function ($item) {
            return $item->status === STATUS_PENDING;
        });

        $approrved = $companyWorkshop->filter(function ($item) {
            return $item->status === STATUS_APPROVED;
        });

        $rejected = $companyWorkshop->filter(function ($item) {
            return $item->status === STATUS_REJECTED;
        });

        return ['pending' => $pending, 'approved' => $approrved, 'rejected' => $rejected];
    }

    public function updateStatusWorkShop($companyId, $workshopId, $status)
    {
        return $this->companyWorkshop->where('company_id', $companyId)->where('workshop_id', $workshopId)->update(['status' => $status]);
    }

    public function findCompanyWorkshop($companyId, $workshopId)
    {
        return $this->companyWorkshop::where('company_id', $companyId)->where('workshop_id', $workshopId)->first();
    }

    public function workshopApplied($companyId)
    {
        return $this->companyWorkshop::where('company_id', $companyId)
            ->orderBy('created_at', 'desc')
            ->paginate(LIMIT_10);
    }

    public function getWorkshopDashboard($dateFrom, $dateTo)
    {
        $user = Auth::guard('admin')->user();

        if ($dateFrom && $dateTo) {
            $query = DB::table('work_shops as w')
                ->leftJoin('company_workshops as cw', 'w.id', '=', 'cw.workshop_id')
                ->selectRaw(
                    '
                    DATE(cw.created_at) AS created_date,
                    COUNT(CASE WHEN cw.status = ? THEN 1 END) AS total_pending,
                    COUNT(CASE WHEN cw.status = ? THEN 1 END) AS total_approved,
                    COUNT(CASE WHEN cw.status = ? THEN 1 END) AS total_rejected',
                    [STATUS_PENDING, STATUS_APPROVED, STATUS_REJECTED]
                )
                ->where('w.university_id', $user->university->id)
                ->whereBetween(DB::raw('DATE(cw.created_at)'), [$dateFrom, $dateTo])
                ->groupBy(DB::raw('DATE(cw.created_at)'))
                ->orderBy('created_date', 'asc');

            return $query->get();
        } else {
            return null;
        }

    }
}
