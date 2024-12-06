<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\Base\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function getUsers(array $filters)
    {
        $query = $this->model->select('id', 'user_name', 'email', 'role', 'active', 'created_at')
            ->whereIn('role', [ROLE_SUB_ADMIN, ROLE_COMPANY, ROLE_UNIVERSITY]);

        if (!empty($filters['search'])) {
            $query->where(function($query) use ($filters) {
                $query->where('user_name', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('email', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['role']) && $filters['role'] != 'all') {
            $query->where('role', $filters['role']);
        }

        if (isset($filters['active']) && in_array($filters['active'], [INACTIVE, ACTIVE])) {
            $query->where('active', (int) $filters['active']);
        }        

        if (!empty($filters['date_range'])) {
            $dateRange = explode(" to ", $filters['date_range']);
            $startDate = \Carbon\Carbon::createFromFormat('d/m/Y', $dateRange[0])->startOfDay();

            if (isset($dateRange[1])) {
                $endDate = \Carbon\Carbon::createFromFormat('d/m/Y', $dateRange[1])->endOfDay();
                $query->whereBetween('created_at', [$startDate, $endDate]);
            } else {
                $query->whereDate('created_at', '>=', $startDate);
            }
        }

        $query->orderByDesc('created_at');

        return $query->paginate(LIMIT_10)->withQueryString();
    }

    public function getUserById(int $id)
    {
        return $this->model->find($id);
    }

    public function updateToggleStatus(int $id, array $data){
        $result = $this->model->find($id);
        if ($result->update($data)) {
            return $result;
        }
        return false;
    }
}
