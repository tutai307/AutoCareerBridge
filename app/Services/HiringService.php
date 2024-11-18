<?php

namespace App\Services;

use App\Models\Hiring;
use App\Repositories\Company\HiringRepositoryInterface;
use Illuminate\Http\Request;

class HiringService
{
    protected $hiringRepository;

    public function __construct(HiringRepositoryInterface $hiringRepository){
        $this->hiringRepository = $hiringRepository;
    }

    public function getAllHirings(){
        return $this->hiringRepository->getAllHirings();
    }

    public function createHiring($request){
        return $this->hiringRepository->createHiring($request);
    }

    
    public function editHiring($id){
        return $this->hiringRepository->editHiring($id);
    }

    
    public function updateHiring($request){
        return $this->hiringRepository->updateHiring($request);
        
    }

    public function deleteHiring($id){
        return $this->hiringRepository->deleteHiring($id);
        
    }

    public function findHiring($request){
        return $this->hiringRepository->findHiring($request);
    }
  
}
