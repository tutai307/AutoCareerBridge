<?php

namespace App\Services\Company;

use App\Repositories\Company\CompanyRepositoryInterface;
use Exception;

class CompanyService
{
    protected $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function findProfile($userId, $slug)
    {
        return $this->companyRepository->findByUserIdAndSlug($userId, $slug);
    }

    public function editProfile($userId, $slug)
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

    public function updateAvatar($userId, $avatar)
    {
        try {
            return $this->companyRepository->updateAvatar($userId, $avatar);
        } catch (Exception $e) {
            throw new Exception('Lỗi khi cập nhật avatar: ' . $e->getMessage());
        }
    }

//    public function updateProfile($userId, $data)
//    {
//        try {
//            return $this->companyRepository->updateProfile($userId, $data);
//        } catch (Exception $e) {
//            throw new Exception('Lỗi khi cập nhật thông tin: ' . $e->getMessage());
//        }
//    }
    public function updateProfileService($userId, $data)
    {
        try {
            return $this->companyRepository->updateProfile($userId, $data);
        } catch (Exception $e) {
            throw new Exception('Lỗi khi cập nhật thông tin: ' . $e->getMessage());
        }

    }
}
