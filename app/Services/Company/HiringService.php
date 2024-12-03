<?php

namespace App\Services\Company;

use App\Models\User;
use App\Repositories\Hiring\HiringRepositoryInterface;

class HiringService
{
    protected $hiringRepository;

    public function __construct(HiringRepositoryInterface $hiringRepository){
        $this->hiringRepository = $hiringRepository;
    }

    public function getHirings($request, $companyId){
        return $this->hiringRepository->getHirings($request, $companyId);
    }

    public function createHiring($request, $companyId){
        $email = $request->email;
        $userestore = User::withTrashed()->where('email', $email)->first();

        if ($userestore) {
            return $this->hiringRepository->restoreUserHiring($userestore, $request);
        }

        return $this->hiringRepository->createHiring($request, $companyId);
    }


    public function editHiring($userId){
        return $this->hiringRepository->editHiring($userId);
    }


    public function updateHiring($request, $userId){
        return $this->hiringRepository->updateHiring($request, $userId);

    }

    public function deleteHiring($id){
        return $this->hiringRepository->deleteHiring($id);

    }
}
