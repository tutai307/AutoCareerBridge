<?php

namespace App\Services\Company;

use App\Repositories\Company\CompanyRepositoryInterface;
use Exception;

/**
 * CompanyController handles company management,
 * @author Hoang Duy Lap
 * @access public
 * @package Company
 * @see findProfile()
 * @see editProfile()
 * @see getProvinces()
 * @see getDistricts()
 * @see getWards()
 * @see updateProfileService()
 * @see updateAvatar()
 * @see index()
 * @see findUniversity()
 */
class CompanyService
{
    protected $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function findProfile($userId)
    {
        return $this->companyRepository->findByUserIdAndSlug($userId);
    }

    public function editProfile($slug, $userId)
    {
        return $this->companyRepository->findBySlug($userId, $slug);
    }

    public function getProvinces()
    {
        return $this->companyRepository->getProvinces();
    }public function getDistricts($provinceId)
{
    return $this->companyRepository->getDistricts($provinceId);
}

    public function getWards($districtId)
    {
        return $this->companyRepository->getWards($districtId);
    }

    public function updateProfileService($identifier, $data)
    {
        try {
            return $this->companyRepository->updateProfile($identifier, $data);
        } catch (Exception $e) {
            throw new Exception('Lỗi khi cập nhật thông tin: ' . $e->getMessage());
        }
    }
    public function createCompanyForUser($userId, $data)
    {
        $data['user_id'] = $userId;
        return $this->companyRepository->create($data);
    }

    public function updateAvatar($identifier, $avatar)
    {
        return $this->companyRepository->updateAvatar($identifier, $avatar);
    }

    public function index(){
        return $this->companyRepository->index();
    }

    public function findUniversity($request){
        return $this->companyRepository->findUniversity($request);
    }

    public function getAll() {
        return $this->companyRepository->getAll();
    }

}
