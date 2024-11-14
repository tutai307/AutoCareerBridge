<?php

namespace App\Repositories\Company;

use App\Repositories\Base\BaseRepositoryInterface;

interface CompanyRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel();

    //get info company
    public function findByUserIdAndSlug($userId, $slug);

    //get info company to edit
    public function findBySlug($userId, $slug);

    //get districts of province
    public function getDistricts($provinceId);

    public function getWards($districtId);

    //update avatar
    public function updateAvatar($userId, $avatar);

    //update profile
    public function updateProfile($userId, $data);
}

