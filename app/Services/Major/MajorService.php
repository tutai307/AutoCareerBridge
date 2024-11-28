<?php

namespace App\Services\Major;

use App\Models\Major;
use App\Models\UniversityMajor;
use App\Repositories\Major\MajorRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class MajorService
{
    protected $majorRepository;

    public function __construct(MajorRepositoryInterface $majorRepository)
    {
        $this->majorRepository = $majorRepository;
    }

    public function getMajors(array $filters)
    {
        return $this->majorRepository->getMajors($filters);
    }

    public function getMajorsForUniversity(int $universityId): array
    {
        // Lấy tất cả chuyên ngành
        $majors = Major::all();

        // Lấy danh sách major_id đã tồn tại trong university_majors
        $majorsExisted = $this->majorRepository->getExistedMajorIdsByUniversity($universityId);

        return [
            'majors' => $majors,
            'majors_existed' => $majorsExisted,
        ];
    }

    public function deleteMajor($majorId)
    {
        $universityId = Auth::guard('admin')->user()->university->id;

        $deleted = $this->majorRepository->softDelete($universityId, $majorId);

        if ($deleted) {
            return ['status' => true, 'message' => 'Chuyên ngành đã được xóa.'];
        }

        return ['status' => false, 'message' => 'Không tìm thấy chuyên ngành cần xóa.'];
    }

    public function addOrRestoreMajor($universityId, $majorId)
    {
        return $this->majorRepository->createOrRestore($universityId, $majorId);
    }
}
