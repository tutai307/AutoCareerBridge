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

        $query->orderBy('created_at', 'desc');

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
