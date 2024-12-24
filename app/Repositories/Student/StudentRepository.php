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
            if (strpos($filters['date_range'], 'to') !== false) {
                list($entryYear, $graduationYear) = explode(' to ', $filters['date_range']);

                $entryYear = \Carbon\Carbon::createFromFormat('Y-m-d', $entryYear);

                $graduationYear = \Carbon\Carbon::createFromFormat('Y-m-d', $graduationYear);

                $query->whereDate('entry_year', GREATER_THAN_OR_EQUAL , $entryYear)
                    ->whereDate('graduation_year', LESS_THAN_OR_EQUAL , $graduationYear);
            } elseif (strpos($filters['date_range'], 'đến') !== false) {
                list($entryYear, $graduationYear) = explode(' đến ', $filters['date_range']);

                $entryYear = \Carbon\Carbon::createFromFormat('Y-m-d', $entryYear);

                $graduationYear = \Carbon\Carbon::createFromFormat('Y-m-d', $graduationYear);

                $query->whereDate('entry_year', GREATER_THAN_OR_EQUAL , $entryYear)
                    ->whereDate('graduation_year', LESS_THAN_OR_EQUAL , $graduationYear);
            } else {
                $entryYear = \Carbon\Carbon::createFromFormat('Y-m-d', $filters['date_range']);
                $query->whereDate('entry_year', GREATER_THAN_OR_EQUAL , $entryYear);
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