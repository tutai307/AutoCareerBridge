<?php

namespace App\Repositories\Company;

use App\Repositories\Base\BaseRepositoryInterface;
use Illuminate\Http\Request;

interface CompanyRepositoryInterface  extends BaseRepositoryInterface
{
    public function findUniversity($request);
    public function index();
    public function getProvinces();
}
