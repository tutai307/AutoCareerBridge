<?php

namespace App\Repositories\Notification;

use App\Models\Notification;
use App\Repositories\Base\BaseRepository;

class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface
{
    public function getModel()
    {
        return Notification::class;
    }

    public function getNotifications()
    {
        $user = auth()->guard('admin')->user();
        $filters = [];
        if ($user->role == ROLE_UNIVERSITY || $user->role == ROLE_SUB_UNIVERSITY) {
            if (isset($user->university->id)) {
                $filters['university'] = $user->university->id;
            } else if (isset($user->academicAffair->university_id)) {
                $filters['university'] = $user->academicAffair->university_id;
            } else {
                return [];
            }
        } elseif ($user->role == ROLE_COMPANY || $user->role == ROLE_SUB_ADMIN) {
            if (isset($user->company->id)) {
                $filters['company'] = $user->company->id;
            } else if (isset($user->hiring->company_id)) {
                $filters['company'] = $user->hiring->company_id;
            } else {
                return [];
            }
        } else {
            return [];
        }

        $query = $this->model->select('*');
        if (isset($filters['company'])) {
            $query->where('company_id', $filters['company']);
        }

        if (isset($filters['university'])) {
            $query->where('university_id', $filters['university']);
        }

        return $query->orderBy('created_at', 'desc')->paginate(LIMIT_10);
    }

    public function getNotificationCount()
    {
        $user = auth()->guard('admin')->user();
        $filters = [];
        if ($user->role == ROLE_UNIVERSITY || $user->role == ROLE_SUB_UNIVERSITY) {
            if (isset($user->university->id)) {
                $filters['university'] = $user->university->id;
            } else if (isset($user->academicAffair->university_id)) {
                $filters['university'] = $user->academicAffair->university_id;
            } else {
                return [];
            }
        } elseif ($user->role == ROLE_COMPANY || $user->role == ROLE_HIRING) {
            if (isset($user->company->id)) {
                $filters['company'] = $user->company->id;
            } else if (isset($user->hiring->company_id)) {
                $filters['company'] = $user->hiring->company_id;
            } else {
                return [];
            }
        } else {
            return [];
        }

        $query = $this->model->select('*');
        if (isset($filters['company'])) {
            $query->where('company_id', $filters['company']);
        }

        if (isset($filters['university'])) {
            $query->where('university_id', $filters['university']);
        }

        $query->where('is_seen', UNSEEN);

        return $query->count();
    }

    public function getCountNotificationRealtime($companyId = null, $universityId = null)
    {
        $query = $this->model->select('*');
        if ($companyId) {
            $query->where('company_id', $companyId);
        }
        if ($universityId) {
            $query->where('university_id', $universityId);
        }

        $query->where('is_seen', UNSEEN);

        return $query->count();
    }

    public function seen($args)
    {
        $query = $this->model;

        if (isset($args['company'])) {
            $query = $query->where('company_id', $args['company']);
        }

        if (isset($args['university'])) {
            $query = $query->where('university_id', $args['university']);
        }

        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }

        return $query->update(['is_seen' => 1]);
    }
}
