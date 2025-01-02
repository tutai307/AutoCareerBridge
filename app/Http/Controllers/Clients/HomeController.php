<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Services\Company\CompanyService;
use App\Services\Fields\FieldsService;
use App\Services\Job\JobService;
use App\Services\Major\MajorService;
use App\Services\Skill\SkillService;
use App\Services\University\UniversityService;
use App\Services\University\WorkshopService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    protected $universityService;
    protected $companyService;
    protected $fieldsService;
    protected $jobService;
    protected $majorService;
    protected $workShopService;
    protected $skillService;

    public function __construct(
        UniversityService $universityService,
        CompanyService    $companyService,
        FieldsService     $fieldsService,
        JobService        $jobService,
        MajorService      $majorService,
        WorkshopService   $workShopService,
        SkillService      $skillService
    ) {
        $this->universityService = $universityService;
        $this->companyService = $companyService;
        $this->fieldsService = $fieldsService;
        $this->jobService = $jobService;
        $this->majorService = $majorService;
        $this->workShopService = $workShopService;
        $this->skillService = $skillService;
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
            $getMajor = $this->majorService->getAllMajors();
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
                'getProvince' => $getProvince,
                'getMajor' => $getMajor,
                'workShopHot' => $workShopHot

            ]);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }


    public function search(Request $request)
    {
        try {
            $getProvince = $this->companyService->getProvinces();
            $getMajor = $this->majorService->getAllMajors();
            $getFiled = $this->fieldsService->getAll();
            $getSkills = $this->skillService->getAll();

            $keySearch = $request->input('key_search');
            $province = $request->input('province_id');
            $major = $request->input('major_id');
            $fields = $request->input('fields');
            $skills = $request->input('skills');

            $getJobs = $this->jobService->searchJobs($keySearch, $province, $major, $fields, $skills);
            if ($request->ajax()) {
                $html = view('client.pages.components.search.jobFilter', compact(
                    'getJobs',
                    'getProvince',
                    'getMajor',
                    'getFiled',
                    'getSkills'
                ))->render();
                return response()->json(['html' => $html], 200);
            }

            return view('client.pages.job.resultJob', compact([
                'getJobs',
                'getProvince',
                'getMajor',
                'getFiled',
                'getSkills'
            ]));
        } catch (\Throwable $e) {
            Log::error("Search Jobs Error: {$e->getMessage()} in {$e->getFile()} on line {$e->getLine()}");

            if ($request->ajax()) {
                return response()->json(['error' =>
                'Chưa tìm thấy việc làm phù hợp với yêu cầu của bạn. Bạn thử xóa bộ lọc và tìm lại nhé.'], 500);
            }

            return redirect()->back()->with(
                'error',
                'Chưa tìm thấy việc làm phù hợp với yêu cầu của bạn. Bạn thử xóa bộ lọc và tìm lại nhé.'
            );
        }
    }

    public function workshop()
    {
        $workShops = $this->workShopService->getWorkShopClient();
        return view('client.pages.workshop.list',[
                'workShops' => $workShops
            ]
        );
    }
}
