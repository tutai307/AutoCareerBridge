<?php

namespace App\Repositories\Collaboration;

use App\Models\Collaboration;
use App\Repositories\Base\BaseRepository;
use Carbon\Carbon;

class CollaborationRepository extends BaseRepository implements CollaborationRepositoryInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getModel()
    {
        return Collaboration::class;
    }

    public function getIndexRepository(int $status, $accountId, $isReceived = false)
    {
        return $this->model->with('company', 'university')
            ->where(function ($query) use ($accountId, $isReceived, $status) {
                if (isset($accountId['company'])) {
                    $query->where('company_id', $accountId['company']);
                    $query->when($status == STATUS_PENDING, function ($query) use ($isReceived) {
                        $query->where('created_by', $isReceived ? ROLE_UNIVERSITY : ROLE_COMPANY);
                    });
                } else if (isset($accountId['university'])) {
                    $query->where('university_id', $accountId['university']);
                    $query->when($status == STATUS_PENDING, function ($query) use ($isReceived) {
                        $query->where('created_by', $isReceived ? ROLE_COMPANY : ROLE_UNIVERSITY);
                    });
                }
            })
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->paginate(PAGINATE_COLLAB);
    }

    public function searchAcrossStatuses(?string $search, ?string $dateRange)
    {
        $user = auth('admin')->user();

        // Xác định quan hệ cần load (company hoặc university) dựa trên role
        $relation = $user->role == ROLE_COMPANY ? 'university' : 'company';

        $query = $this->model->with($relation)
            ->where(function ($q) use ($user) {
                $q->where('company_id', $user->id)
                    ->orWhere('university_id', $user->id);
            })
            ->when($search, function ($q) use ($search, $relation) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhereHas($relation, function ($subQuery) use ($search) {
                        $subQuery->where('name', 'like', "%{$search}%");
                    });
            });

        if ($dateRange) {
            $dates = explode(' - ', $dateRange);
            if (count($dates) == 2) {
                $startDate = Carbon::createFromFormat('Y-m-d', trim($dates[0]))->startOfDay();
                $endDate = Carbon::createFromFormat('Y-m-d', trim($dates[1]))->endOfDay();
                $query->whereBetween('created_at', [$startDate, $endDate]);
            } else {
                throw new \Exception('Invalid date range format.');
            }
        }

        return $query->orderBy('status', 'asc')->paginate(PAGINATE_COLLAB);
    }
    public function getUniversityCollaboration($companyId)
    {
        $data = $this->model->with('university')
            ->where('company_id', $companyId)
            ->orderBy('created_at', 'desc')
            ->where('status', STATUS_APPROVED)
            ->get();
        return $data;
    }

    public function create($data = [])
    {
        $collaboration = $this->model->create($data);
        return $this->model->with(['company', 'university'])->find($collaboration->id);
    }
}
