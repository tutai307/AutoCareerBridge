<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Services\Company\CompanyService;
use App\Services\Fields\FieldsService;
use App\Services\University\UniversityService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $universityService;
    protected $companyService;
    protected $fieldsService;
    public function __construct(UniversityService $universityService, CompanyService $companyService, FieldsService $fieldsService)
    {
        $this->universityService = $universityService;
        $this->companyService = $companyService;
        $this->fieldsService = $fieldsService;
    }
    public function index()
    {
        $companies = $this->companyService->getCompaniesWithJobsAndAddresses();
        $universities = $this->universityService->popularUniversities();
        $getFieldsWithJobCount = $this->fieldsService->getFieldsWithJobCount();

        return view('client.pages.home', compact('companies', 'universities', 'getFieldsWithJobCount'));
    }
}
