<?php

namespace App\Http\Controllers\University;

use App\Services\Job\JobService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 *
 *
 * @package App\Http\Controllers\Admin
 * @author Nguyen Manh Hung
 * @access public
 * @see show()
 */

class JobsController extends Controller
{

    protected $jobService;

    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }

    public function show($slug){
        try{
            $data = $this->jobService->getJobForUniversity($slug);
//            dd($data);
            if(is_null($data)) return redirect()->back()->with('status_fail', 'bài đăng không tồn tại!');
            return view('management.pages.university.jobs.jobDetail', compact('data'));
        }catch (\Exception $e){
            return redirect()->back()->with('status_fail', $e->getMessage());
        }
    }
}
