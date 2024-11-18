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

    public function updateAvatar($identifier, $avatar)
    {
        try {
            return $this->companyRepository->updateAvatar($identifier, $avatar);
        } catch (Exception $e) {
            throw new Exception('Lỗi khi cập nhật avatar: ' . $e->getMessage());
        }
    }
}
