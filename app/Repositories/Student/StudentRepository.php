<?php

namespace App\Repositories\Student;

use App\Models\Student;
use App\Repositories\Base\BaseRepository;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    public function getModel()
    {
        return Student::class;
    }

    public function getStudents(array $filters)
    {
        $query = $this->model->with('major')->where('university_id', 1);

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('email', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('phone', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['major_id']) && $filters['major_id'] != 'all') {
            $query->where('major_id', $filters['major_id']);
        }

        if (!empty($filters['date_range'])) {
            $dateRange = explode(" to ", $filters['date_range']);
            $startDate = \Carbon\Carbon::createFromFormat('d/m/Y', $dateRange[0]);

            if (isset($dateRange[1])) {
                $endDate = \Carbon\Carbon::createFromFormat('d/m/Y', $dateRange[1]);
                $query->whereDate('entry_year', '>=', $startDate)
                    ->whereDate('graduation_year', '<=', $endDate);
            } else {
                $query->whereDate('entry_year', '>=', $startDate);
            }
        }

        return $query->paginate(LIMIT_10)->withQueryString();
    }
}