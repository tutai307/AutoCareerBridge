<?php

namespace App\Repositories\Major;

use App\Models\Fields;
use App\Models\UniversityMajor;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\Auth;

class MajorRepository extends BaseRepository implements MajorRepositoryInterface
{
    public function getModel()
    {
        return UniversityMajor::class;
    }

    public function getMajors(array $filters)
    {
        $universityId = Auth::guard('admin')->user()->university->id;

        $query = UniversityMajor::where('university_id', $universityId);
        if (!empty($filters['field_id']) && $filters['field_id'] != 'all') {
            $query->whereHas('major', function ($q) use ($filters) {
                $q->where('field_id', $filters['field_id']);
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
        return UniversityMajor::where('university_id', $universityId)
            ->pluck('major_id')
            ->toArray();
    }

    public function softDelete($universityId, $majorId)
    {
        $universityMajor = UniversityMajor::where('university_id', $universityId)
            ->where('major_id', $majorId);

        if ($universityMajor) {
            $universityMajor->delete();
            return true;
        }
        return false;
    }

    public function findByUniversityAndMajor($universityId, $majorId)
    {
        return UniversityMajor::where('university_id', $universityId)
            ->where('major_id', $majorId);
    }

    public function restore($universityMajor)
    {
        return $universityMajor->restore();
    }

    public function createOrRestore($universityId, $majorId){
        $university_major = UniversityMajor::withTrashed()
        ->where('university_id', $universityId)
        ->where('major_id', $majorId);

        if($university_major->first()){
            $university_major->restore();
        } else {
            UniversityMajor::create([
                'university_id' => $universityId,
                'major_id' => $majorId,
            ]);
        }
    }

    public function getFields()
    {
        return Fields::all();
    }
}
