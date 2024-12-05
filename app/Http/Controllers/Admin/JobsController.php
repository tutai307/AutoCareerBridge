<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Job\JobService;
use Exception;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

/**
 * The JobsController is responsible for managing job-related operations within the admin panel.
 * It includes functionality for viewing the list of jobs, filtering jobs based on specific criteria,
 * searching for jobs, viewing detailed information about a job, and approving or rejecting job postings.
 *
 * @package App\Http\Controllers\Admin
 * @author Nguyen Manh Hung
 * @access public
 * @see dashboard()
 * @see index()
 * @see showBySlug()
 * @see updateStatus()
 */

class JobsController extends Controller
{

    protected $jobService;

    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }

    public function dashboard()
    {
        try {
            $totalUserComJobUni = $this->jobService->totalRecord();
            $dataJobs = $this->jobService->filterJobByMonth();
            $currentYear = date('Y');
            return view('management.pages.admin.home', compact('totalUserComJobUni', 'dataJobs', 'currentYear'));
        } catch (Exception $e) {
            return redirect()->back()->with('status_fail', $e->getMessage());
        }
    }

    public function index(Request $request)
    {
        $data = $request->only(['search', 'status', 'major']);
        try {
            $jobs = $this->jobService->getJobs($data);
            $majors = $this->jobService->getMajors();
            return view('management.pages.admin.jobs.index', compact('jobs', 'majors'));
        } catch (Exception $e) {
            return redirect()->back()->with('status_fail', $e->getMessage());
        }
    }

    public function showBySlug($slug)
    {
        $data = $this->jobService->findJob($slug);
        if (isset($data['error'])) {
            return response()->json(['message' => $data['error']], 401);
        }
        return response()->json(['data' => $data]);
    }

    public function updateStatus(Request $request)
    {
        $dataRequest = $request->only(['status', 'id']);
        try {
            $job = $this->jobService->checkStatus($dataRequest);
            $check = $this->jobService->updateStatus($job);


        } catch (Exception $e) {
            return redirect()->back()->with('status_fail', $e->getMessage());
        }
    }
}
