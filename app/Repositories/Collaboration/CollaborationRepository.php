<?php

namespace App\Repositories\Collaboration;

use App\Models\Collaboration;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\Mail;

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

    public function getIndexRepository(int $status, int $page, $accountId, $isReceived = false)
    {
        return $this->model
            ->where(function ($query) use ($accountId, $isReceived, $status) {
                if (isset($accountId['company'])) {
                    $query->where('company_id', $accountId['company']);
                    if ($status == STATUS_PENDING) {
                        if ($isReceived) {
                            $query->where('created_by', ROLE_UNIVERSITY);
                        } else {
                            $query->where('created_by', ROLE_COMPANY);
                        }
                    }
                } else if (isset($accountId['university'])) {
                    $query->where('university_id', $accountId['university']);

                    if ($status == STATUS_PENDING) {
                        if ($isReceived) {
                            $query->where('created_by', ROLE_COMPANY);
                        } else {
                            $query->where('created_by', ROLE_UNIVERSITY);
                        }
                    }
                }
            })
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->paginate(PAGINATE_COLLAB);
    }

    public function searchAcrossStatuses(?string $search, int $page)
    {
        $user = auth('admin')->user();
        if ($user->role == ROLE_COMPANY) {
            $query = $this->model->with('university')
                ->where(function ($q) use ($search) {
                    if ($search) {
                        $q->where('title', 'like', "%{$search}%")
                            ->orWhereHas('university', function ($subQuery) use ($search) {
                                $subQuery->where('name', 'like', "%{$search}%");
                            });
                        //                        ->orWhere('response_message', 'like', "%{$search}%");
                    }
                });
        } else if ($user->role == ROLE_UNIVERSITY) {
            $query = $this->model->with('company')
                ->where(function ($q) use ($search) {
                    if ($search) {
                        $q->where('title', 'like', "%{$search}%")
                            ->orWhereHas('company', function ($subQuery) use ($search) {
                                $subQuery->where('name', 'like', "%{$search}%");
                            });
                        //                        ->orWhere('response_message', 'like', "%{$search}%");
                    }
                });
        }

        // Xử lý date range tương tự như trước
        //        if ($dateRange) {
        //            $dates = explode(' - ', $dateRange);
        //            if (count($dates) == 2) {
        //                $startDate = \Carbon\Carbon::createFromFormat('m/d/Y', trim($dates[0]))->startOfDay();
        //                $endDate = \Carbon\Carbon::createFromFormat('m/d/Y', trim($dates[1]))->endOfDay();
        //
        //                $query->whereBetween('created_at', [$startDate, $endDate]);
        //            }
        //        }

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
