<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Services\Company\CompanyService;
use App\Services\Fields\FieldsService;
use App\Services\Job\JobService;
use App\Services\Major\MajorService;
use App\Services\University\UniversityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    protected $universityService;
    protected $companyService;
    protected $fieldsService;
    protected $jobService;
    protected $majorService;

    public function __construct(UniversityService $universityService, CompanyService $companyService, FieldsService $fieldsService, JobService $jobService, MajorService $majorService)
    {
        $this->universityService = $universityService;
        $this->companyService = $companyService;
        $this->fieldsService = $fieldsService;
        $this->jobService = $jobService;
        $this->majorService = $majorService;
    }

    /**
     * Display the home page with companies, universities, and job fields data.
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     * @author Dang Duc Chung
     * @access public
     */
    public function index()
    {
        try {
            $companies = $this->companyService->getCompaniesWithJobsAndAddresses();
            $universities = $this->universityService->popularUniversities();
            $getFieldsWithJobCount = $this->fieldsService->getFieldsWithJobCount();
            $newJobs = $this->jobService->getAllJobs();
            $getProvince = $this->companyService->getProvinces();
            $getMajor = $this->majorService->getAll();
            return view('client.pages.home', compact('companies', 'universities', 'getFieldsWithJobCount', 'newJobs','getProvince', 'getMajor'));
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }

//    public function dataSearch()
//    {
//        $getProvince = $this->companyService->getProvinces();
//        $getMajor = $this->majorService->getAll();
//        return view('client.pages.searchForm', compact('getProvince', 'getMajor'));
//    }

    public function search(Request $request)
    {
        try {
            $keySearch = $request->input('key_search');
            $province = $request->input('province_id');
            $major = $request->input('major_id');

            $getJob = $this->jobService->searchJobs($keySearch, $province, $major);
            return view('client.pages.job.resultJob', compact('getJob'));
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getFile() . ':' . $e->getLine() . ' - ' . $e->getMessage());
            return redirect()->back()->with('error', 'không tìm thấy công việc liên quan.');
        }
    }
}
