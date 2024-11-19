<?php

namespace App\Repositories\Company;

use App\Repositories\Base\BaseRepositoryInterface;
use Illuminate\Http\Request;

interface CompanyRepositoryInterface  extends BaseRepositoryInterface
{
    public function findUniversity($request);
    public function index();
    public function getModel();

    //get info company
    public function findByUserIdAndSlug($userId);

    //get info company to edit
    public function findBySlug($slug, $userId);

    //get province
    public function getProvinces();
    //get districts of province
    public function getDistricts($provinceId);
    //get wards of districts
    public function getWards($districtId);

    //update avatar
    public function updateAvatar($identifier, $avatar);

    //update profile
    public function updateProfile($identifier, $data);
}
