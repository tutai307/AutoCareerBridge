<?php

namespace App\Repositories\Major;

use App\Models\Major;
use App\Models\UniversityMajor;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\Auth;

class MajorRepository extends BaseRepository implements MajorRepositoryInterface
{
    protected $universityMajor;
    public function __construct(UniversityMajor $universityMajor)
    {
        parent::__construct();
        $this->universityMajor = $universityMajor;
    }

    public function getModel()
    {
        return Major::class;
    }

    public function getMajorAdmins()
    {
        $query = $this->model->query();

        if ($search = request()->get('search')) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        if ($status = request()->get('status')) {
            $query->where('status', $status);
        }

        return $query
            ->orderByRaw('status = ' . STATUS_PENDING . ' DESC')
            ->orderBy('id', 'desc')
            ->paginate(PAGINATE_MAJOR);
    }

    public function getMajors(array $filters)
    {
        $universityId = Auth::guard('admin')->user()->university->id;

        $query = $this->universityMajor->where('university_id', $universityId);
        if (!empty($filters['search'])) {
            $query->whereHas('major', function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['major_id']) && $filters['major_id'] != 'all') {
            $query->where('major_id', $filters['major_id']);
        }
        $query->orderBy('created_at', 'desc');
        return $query->paginate(LIMIT_10)->withQueryString();
    }

    public function getExistedMajorIdsByUniversity(int $universityId): array
    {
        return $this->universityMajor->where('university_id', $universityId)
            ->pluck('major_id')
            ->toArray();
    }

    public function softDelete($universityId, $majorId)
    {
        $universityMajor = $this->universityMajor->where('university_id', $universityId)
            ->where('major_id', $majorId);

        if ($universityMajor) {
            $universityMajor->delete();
            return true;
        }
        return false;
    }

    public function findByUniversityAndMajor($universityId, $majorId)
    {
        return $this->universityMajor->where('university_id', $universityId)
            ->where('major_id', $majorId);
    }

    public function restore($universityMajor)
    {
        return $universityMajor->restore();
    }

    public function createOrRestore($universityId, $majorId)
    {
        $university_major = $this->universityMajor->withTrashed()
            ->where('university_id', $universityId)
            ->where('major_id', $majorId);

        if ($university_major->first()) {
            $university_major->restore();
        } else {
            $this->universityMajor->create([
                'university_id' => $universityId,
                'major_id' => $majorId,
            ]);
        }
    }
}
