<?php

namespace App\Services\Province;

use App\Repositories\Province\ProvinceRepositoryInterface;

class ProvinceService
{
    protected $provinceRepository;

    public function __construct(ProvinceRepositoryInterface $provinceRepository)
    {
        $this->provinceRepository = $provinceRepository;
    }

    public function getAllProvinces(){
        return $this->provinceRepository->getAllProvinces();
    }
}