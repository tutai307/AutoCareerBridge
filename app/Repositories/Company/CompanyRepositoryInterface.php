<?php

namespace App\Repositories\Company;

use Illuminate\Http\Request;

interface CompanyRepositoryInterface
{
    public function findUniversity($request);
    public function index();
    public function getProvinces();
}
