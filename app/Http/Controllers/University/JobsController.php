<?php

namespace App\Http\Controllers\University;

use App\Services\Job\JobService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

/**
 *
 *
 * @package App\Http\Controllers\Admin
 * @author Nguyen Manh Hung & Khuat Van Duy & Tran Van Nhat
 * @access public
 * @see index()
 * @see show()
 * @see apply()
 */

class JobsController extends Controller
{

    protected $jobService;

    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }

    public function index(){
        try{
            $university_id = auth()->guard('admin')->user()->university->id;
            $appliedJobs = $this->jobService->getAppliedJobs($university_id);

            $appliedJobs->getCollection()->transform(function ($job) {
                $job->university_job_status = $job->universityJobs()
                    ->where('job_id', $job->id)
                    ->value('status');
                return $job;
            });
            return view('management.pages.university.jobs.index', compact('appliedJobs'));
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()->with('status_fail', "Đã có lỗi lấy dữ liệu");
        }
    }

    public function show($slug)
    {
        try {
            $data = $this->jobService->getJobForUniversity($slug);
            if (is_null($data)) return redirect()->back()->with('status_fail', __('message.job.not_found'));
            $user = auth()->guard('admin')->user();
            $id = '';
            if ($user->role == ROLE_UNIVERSITY) {
                $id = $user->university->id;
            }
            $checkApply = $this->jobService->checkApplyJob($id, $slug);
            return view('management.pages.university.jobs.detailJob', compact('data', 'checkApply'));
        } catch (\Exception $e) {
            Log::error($e->getFile() . ':' . $e->getLine() . ' - ' . $e->getMessage());
            return redirect()->back()->with('status_fail', $e->getLine() . $e->getMessage());
        }
    }

    public function apply(Request $request)
    {
        $job_id = $request->job_id;
        $university_id = $request->university_id;
        try {
            $data = $this->jobService->applyJob($job_id, $university_id);
            if (!empty($data)) {
                return redirect()->back()->with('status_success', __('message.job.apply_success'));
            } else {
                return redirect()->back()->with('status_fail', __('message.job.apply_fail'));
            }
        } catch (\Exception $e) {
            Log::error($e->getFile() . ':' . $e->getLine() . ' - ' . $e->getMessage());
            return redirect()->back()->with('status_fail', $e->getLine() . $e->getMessage());
        }
    }
}
