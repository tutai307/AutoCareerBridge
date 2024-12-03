<?php

namespace App\Services\University;

use App\Models\University;
use App\Repositories\University\UniversityRepositoryInterface;
use Illuminate\Http\Request;

class UniversityService
{
    protected $universityRepository;

    public function __construct(UniversityRepositoryInterface $universityRepository){
        $this->universityRepository = $universityRepository;
    }

    public function popularUniversities(){
        return $this->universityRepository->popularUniversities();
    }

    public function getDetail($slug){
        return $this->universityRepository->getDetailUniversity($slug);
    }

    public function getWorkShops($slug){
        return $this->universityRepository->getWorkShops($slug);
    }

    public function findUniversity($request){
        return $this->universityRepository->findUniversity($request);
    }
}
