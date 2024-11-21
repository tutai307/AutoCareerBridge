<?php

namespace App\Services\Company;

use App\Repositories\Hiring\HiringRepositoryInterface;

class HiringService
{
    protected $hiringRepository;

    public function __construct(HiringRepositoryInterface $hiringRepository){
        $this->hiringRepository = $hiringRepository;
    }

    public function getAllHirings($companyId){
        return $this->hiringRepository->getAllHirings($companyId);
    }

    public function createHiring($request, $companyId){
        return $this->hiringRepository->createHiring($request, $companyId );
    }


    public function editHiring($id){
        return $this->hiringRepository->editHiring($id);
    }


    public function updateHiring($request, $companyId){
        return $this->hiringRepository->updateHiring($request, $companyId);

    }

    public function deleteHiring($id){
        return $this->hiringRepository->deleteHiring($id);

    }

    public function findHiring($request, $companyId ){
        return $this->hiringRepository->findHiring($request, $companyId);
    }

}
