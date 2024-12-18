<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Services\Job\JobService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $jobService;

    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }
    public function index(){
        $newJobs = $this->jobService->getAllJobs();
        // dd($newJobs);
        return view('client.pages.home',compact('newJobs'));
    }
}
