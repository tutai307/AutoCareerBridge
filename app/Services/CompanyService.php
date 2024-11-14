<?php
namespace App\Services;
use App\Repositories\Company\CompanyRepositoryInterface;

class CompanyService
{
    protected $companyRepository;
    public function __construct(CompanyRepositoryInterface $companyRepository){
        $this->companyRepository = $companyRepository;
    }

    public function index(){
        return $this->companyRepository->index();
    }

    public function findUniversity($request){
        return $this->companyRepository->findUniversity($request);
    }

    public function getProvinces(){
        return $this->companyRepository->getProvinces();
    }
  
}
