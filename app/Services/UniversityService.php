<?php

namespace App\Services;

use App\Models\University;
use App\Repositories\University\UniversityRepositoryInterface;
use Illuminate\Http\Request;

class UniversityService
{
    protected $universityRepository;

    public function __construct(UniversityRepositoryInterface $universityRepository){
        $this->universityRepository = $universityRepository;
    }

    public function getDetail($id){
        return $this->universityRepository->getDetailUniversity($id);
    }

}
