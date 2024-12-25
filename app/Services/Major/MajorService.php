<?php

namespace App\Services\Major;

use App\Models\Major;
use App\Models\UniversityMajor;
use App\Repositories\Fields\FieldsRepositoryInterface;
use App\Repositories\Major\MajorRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class MajorService
{
    protected $majorRepository;
    protected $fieldsRepository;

    public function __construct(MajorRepositoryInterface $majorRepository, FieldsRepositoryInterface $fieldsRepository)
    {
        $this->majorRepository = $majorRepository;
        $this->fieldsRepository = $fieldsRepository;
    }

    public function getAvailableMajorsForCompany($fieldId){
        return $this->majorRepository->getAvailableMajorsForCompany($fieldId);

    }

    public function getMajorsCompany($request)
    {
        return $this->majorRepository->getMajorsCompany($request);
    }

    public function storeMajorsCompany($request)
    {
        return $this->majorRepository->storeMajorsCompany($request);
    }

     public function removeMajorsCompany($majorsId){
        return $this->majorRepository->removeMajorsCompany($majorsId);
     }

    public function getMajorAdmins()
    {
        return $this->majorRepository->getMajorAdmins();
    }

    public function getMajors(array $filters)
    {
        return $this->majorRepository->getMajors($filters);
    }

    public function getMajorsForUniversity(int $universityId): array
    {
        $majors = Major::all();
        $majorsExisted = $this->majorRepository->getExistedMajorIdsByUniversity($universityId);

        return [
            'majors' => $majors,
            'majors_existed' => $majorsExisted,
        ];
    }
    public function createMajorAdmin($request)
    {
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'field_id' => $request->field_id,
            'description' => $request->description,
            'status' => $request->status ?? STATUS_APPROVED
        ];
        return $this->majorRepository->create($data);
    }
    public function updateMajorAdmin($request, $id)
    {
        $major = $this->majorFind($id);
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'field_id' => $request->field_id,
            'description' => $request->description,
            'status' => $request->status ?? STATUS_APPROVED
        ];
        return  $major->update($data);;
    }

    public function changeStatus($id, $confirm)
    {
        $major = $this->majorRepository->find($id);
        if (empty($major)) {
            return null;
        }

        if ($confirm === 'accept') {
            $major->update(['status' => STATUS_APPROVED]);
        } elseif ($confirm === 'reject') {
            $major->update(['status' => STATUS_REJECTED]);
        }

        return $major->only(['status']);
    }

    public function majorFind($id)
    {
        return $this->majorRepository->find($id);
    }

    public function deleteMajor($majorId)
    {
        $user = Auth::guard('admin')->user();
        if ($user->role === ROLE_SUB_UNIVERSITY) {
            $universityId = $user->academicAffair->university_id;

        }
        if ($user->role === ROLE_UNIVERSITY) {
            $universityId = $user->university->id;

        }

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
    public function getAll()
    {
        return $this->majorRepository->getAll();
    }  public function getAllMajors()
    {
        return $this->majorRepository->getAllMajors();
    }

    public function getFields()
    {
        return $this->fieldsRepository->getAll();
    }

    public function getMajorsByField($fieldId){
        return $this->majorRepository->getMajorsByField($fieldId);
    }

    public function getMajorByUniversity(){
        return $this->majorRepository->getMajorByUniversity();
    }
}
