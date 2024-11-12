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
            ->whereIn('role', [ROLE_ADMIN, ROLE_COMPANY, ROLE_UNIVERSITY]);

        if (!empty($filters['search'])) {
            $query->where('user_name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('email', 'like', '%' . $filters['search'] . '%');
        }

        if (!empty($filters['role']) && $filters['role'] != 'all') {
            $query->where('role', $filters['role']);
        }

        if (isset($filters['active']) && in_array($filters['active'], ['0', '1'], true)) {
            $query->where('active', (int) $filters['active']);
        }

        if (!empty($filters['date'])) {
            $query->whereDate('created_at', $filters['date']);
        }

        return $query->paginate(5);
    }
}