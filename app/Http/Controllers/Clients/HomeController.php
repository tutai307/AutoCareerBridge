<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Services\Company\CompanyService;
use App\Services\Fields\FieldsService;
use App\Services\University\UniversityService;
use Illuminate\Http\Request;
use App\Services\Job\JobService;

class HomeController extends Controller
{
    protected $universityService;
    protected $companyService;
    protected $fieldsService;
    protected $jobService;
    public function __construct(UniversityService $universityService, CompanyService $companyService, FieldsService $fieldsService, JobService $jobService)
    {
        $this->universityService = $universityService;
        $this->companyService = $companyService;
        $this->fieldsService = $fieldsService;
        $this->jobService = $jobService;
    }
    public function index()
    {
        $companies = $this->companyService->getCompaniesWithJobsAndAddresses();
        $universities = $this->universityService->popularUniversities();
        $getFieldsWithJobCount = $this->fieldsService->getFieldsWithJobCount();
        $newJobs = $this->jobService->getAllJobs();
        return view('client.pages.home', compact('companies', 'universities', 'getFieldsWithJobCount','newJobs'));
    }
}
