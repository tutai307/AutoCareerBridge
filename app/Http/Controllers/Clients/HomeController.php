<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\WorkShop;
use App\Services\Company\CompanyService;
use App\Services\Fields\FieldsService;
use App\Services\University\UniversityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Job\JobService;
use App\Services\University\WorkshopService;

class HomeController extends Controller
{
    protected $universityService;
    protected $companyService;
    protected $fieldsService;
    protected $jobService;
    protected $workShopService;
    public function __construct(UniversityService $universityService, CompanyService $companyService, FieldsService $fieldsService, JobService $jobService, WorkshopService $workShopService)
    {
        $this->universityService = $universityService;
        $this->companyService = $companyService;
        $this->fieldsService = $fieldsService;
        $this->jobService = $jobService;
        $this->workShopService = $workShopService;
    }
    /**
     * Display the home page with companies, universities, and job fields data.
     * @author Dang Duc Chung
     * @access public
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            $companies = $this->companyService->getCompaniesWithJobsAndAddresses();
            $universities = $this->universityService->popularUniversities();
            $getFieldsWithJobCount = $this->fieldsService->getFieldsWithJobCount();
            $newJobs = $this->jobService->getAllJobs();
            $countCompany = $this->companyService->getAll()->count() ?? 0;
            $countUniversity = $this->universityService->getAll()->count() ?? 0;
            $countJob = $this->jobService->getAll()->count() ?? 0;
            $countWorkshop = $this->workShopService->getAll()->count() ?? 0;
            $workShopHot = $this->workShopService->getWorkShopsHot();
            
            return view('client.pages.home', [
                'countCompany' => $countCompany,
                'countUniversity' => $countUniversity,
                'countJob' => $countJob,
                'countWorkshop' => $countWorkshop,
                'companies' => $companies,
                'universities' => $universities,
                'fields' => $getFieldsWithJobCount,
                'newJobs' => $newJobs,
                'workShopHot' => $workShopHot

            ]);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }
}
