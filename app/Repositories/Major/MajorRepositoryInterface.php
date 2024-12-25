<?php

namespace App\Repositories\Major;

use App\Models\UniversityMajor;
use App\Repositories\Base\BaseRepositoryInterface;

interface MajorRepositoryInterface extends BaseRepositoryInterface
{
    public function getAvailableMajorsForCompany($fieldId);
    public function getMajorsCompany($request);
    public function storeMajorsCompany($request);
    public function removeMajorsCompany($majorsId);
    public function getMajorsByField($fieldId);
    public function getMajorAdmins();
    public function getAllMajors();
    public function getMajors(array $filters);
    public function getExistedMajorIdsByUniversity(int $universityId): array;
    public function softDelete($universityId, $majorId);
    public function restore($universityMajor);
    public function createOrRestore($universityId, $majorId);
    public function getMajorByUniversity();
}
