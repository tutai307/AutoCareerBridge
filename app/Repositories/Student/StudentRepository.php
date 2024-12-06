<?php

namespace App\Repositories\Student;

use App\Models\Student;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\Auth;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    public function getModel()
    {
        return Student::class;
    }

    public function getStudents(array $filters)
    {
        $user = Auth::guard('admin')->user();
        if ($user->role === ROLE_SUB_UNIVERSITY) {
            $universityId = $user->academicAffair->university_id;
        }
        if ($user->role === ROLE_UNIVERSITY) {
            $universityId = $user->university->id;
        }
        $query = $this->model->with('major')->where('university_id',$universityId);

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
            $startDate = \Carbon\Carbon::createFromFormat('d/m/Y', $dateRange[0])->startOfDay();

            if (isset($dateRange[1])) {
                $endDate = \Carbon\Carbon::createFromFormat('d/m/Y', $dateRange[1])->endOfDay();
                $query->whereDate('entry_year', '>=', $startDate)
                    ->whereDate('graduation_year', '<=', $endDate);
            } else {
                $query->whereDate('entry_year', '>=', $startDate);
            }
        }

        $query->orderBy('created_at', 'desc');

        return $query->paginate(LIMIT_10)->withQueryString();
    }

    public function getBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    public function getStudentById(int $id)
    {
        return $this->model->find($id);
    }
}