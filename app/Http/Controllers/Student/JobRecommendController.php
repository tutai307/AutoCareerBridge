<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use App\Services\Company\CompanyService;
use App\Services\Job\JobService;
use Illuminate\Support\Facades\Auth;

class JobRecommendController extends Controller
{
    protected $jobService;
    protected $companyService;

    public function __construct(JobService $jobService, CompanyService $companyService)
    {
        $this->jobService = $jobService;
        $this->companyService = $companyService;
    }

    public function index()
    {
        // $jobs = $this->jobService->getAllJobs();
        // $jobs = $this->jobService->getAllJobs()->filter(function($job) {
        //     return now()->format('Y-m-d') <= $job->end_date;
        // });
        // Kiểm tra sinh viên đã đăng nhập chưa
        if (Auth::guard('student')->check()) {
            // Lấy danh sách việc làm có hợp tác với trường
            $student = Auth::guard('student')->user();
            $university_id = Auth::guard('student')->user()->university_id;
            $recommendedJobs = $this->jobService->getRecommendedJobs($student);
            $suitableJobs = $this->jobService->getSuitableJobs($student);
        } else {
            $recommendedJobs = [];
            $suitableJobs = [];
        }

        return view('home.index', compact('suitableJobs', 'recommendedJobs'));
    }

    public function detailJob($slug)
    {
        $job = $this->jobService->findJob($slug);
        $resumes = [];
        if (Auth::guard('student')->check()) {
            $resumes = Resume::where('student_id', Auth::guard('student')->user()->id)->get();
        }
        return view('home.pages.detailJob', compact('job', 'resumes'));
    }
}
