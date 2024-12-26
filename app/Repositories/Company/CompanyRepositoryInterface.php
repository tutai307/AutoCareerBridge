<?php

namespace App\Repositories\Company;

use App\Repositories\Base\BaseRepositoryInterface;

interface CompanyRepositoryInterface extends BaseRepositoryInterface
{
    public function getUniversity($request);

    public function dashboard($companyId);

    public function getJobStats($companyId);

    public function getChart($companyId, $dateFrom, $dateTo);

    //get info company
    public function findByUserIdAndSlug($userId);

    //get info company to edit
    public function findBySlug($slug);

    public function findById($userId);

    //get province
    public function getProvinces();

    //get districts of province
    public function getDistricts($provinceId);

    //get wards of districts
    public function getWards($districtId);

    //update profile
    public function updateProfile($identifier, $data);

    //getAll
    public function getAll();

    //get company detail
    public function getCompanyBySlug($slug);

    //get companies with jobs and addresses
    public function getCompaniesWithJobsAndAddresses();

    //get companies with filters
    public function getCompaniesWithFilters($query, $provinceId, $sortOrder);
}
