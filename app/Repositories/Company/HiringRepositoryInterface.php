<?php

namespace App\Repositories\Company;

use Illuminate\Http\Request;

interface HiringRepositoryInterface
{
    public function getAllHirings();
    public function createHiring($request);
    public function editHiring($id);
    public function updateHiring($request);
    public function deleteHiring($id);
    public function findHiring($request);
}
