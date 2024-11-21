<?php

namespace App\Repositories\AcademicAffairs;

use App\Repositories\Base\BaseRepositoryInterface;

interface AcademicAffairsRepositoryInterface extends BaseRepositoryInterface
{
    public function index($universityId);
    public function edit($userId);
    public function updateAcademicAffairs($request,$userId);
    public function deleteAcademicAffairs($id);
    public function search($request,$universityId);
}