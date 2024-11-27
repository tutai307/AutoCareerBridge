<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\JobRequest;
use App\Models\Job;
use App\Models\Skill;
use App\Services\Job\JobService;
use App\Services\Major\MajorService;
use App\Services\Skill\SkillService;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * JobsController handles job management operations for companies, including listing
 * and filtering jobs by search, status, and major.
 *
 * @package App\Http\Controllers\Company
 * @author Khuat Van Duy
 * @access public
 * @see index()
 * @see create()
 * @see store()
 * @see edit()
 * @see update()
 * @see destroy()
 */

class JobsController extends Controller
{
    protected $jobService;
    protected $skillService;
    protected $majorService;

    public function __construct(JobService $jobService, SkillService $skillService, MajorService $majorService)
    {
        $this->jobService = $jobService;
        $this->skillService = $skillService;
        $this->majorService = $majorService;
    }

    /**
     * Display a listing of jobs with optional filters for search, status, and major.
     *
     * @param Request $request The HTTP request instance, containing filter parameters.
     * @return \Illuminate\View\View The view displaying the job list and available majors.
     *
     * @access public
     * @see JobService::getJobs()
     * @see JobService::getMajors()
     */
    public function index(Request $request)
    {
        $data = $request->only(['search', 'status', 'major']);
        $jobs = $this->jobService->getJobs($data);
        $majors = $this->majorService->getAll();
        return view('management.pages.company.jobs.index', compact('jobs', 'majors'));
    }

    /**
     * Show the form for creating a new job post.
     *
     * This method retrieves the list of all skills and majors, then returns the view
     * for creating a new job post, passing the skills and majors data to the view.
     *
     * @return \Illuminate\View\View The view displaying the form for creating a new job post.
     *
     * @access public
     */
    public function create()
    {
        $skills = $this->skillService->getAll();
        $majors = $this->majorService->getAll();
        return view('management.pages.company.jobs.create', compact('majors', 'skills'));
    }

    /**
     * Store a newly created job post in the storage.
     *
     * This method processes the data from the request, creates the job post,
     * associates skills with the job, and commits the transaction. If successful,
     * it redirects to the job management page with a success message. If an error occurs,
     * it rolls back the transaction, logs the error, and redirects back with an error message.
     *
     * @param JobRequest $request The HTTP request instance containing validated job data.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the job management page.
     *
     * @access public
     * @throws \Exception If job creation fails or an error occurs during transaction.
     * @see JobService::createJob()
     */
    public function store(JobRequest $request)
    {
        try {
            DB::beginTransaction();
            $skills = [];

            $skills = $this->skillService->createSkill($request->skill_name);

            $this->jobService->createJob($request->all(), $skills);

            DB::commit();
            return redirect()->route('company.manageJob')->with('status_success', 'Tạo bài đăng thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Lỗi tạo bài đăng: '.$exception->getMessage());
            return redirect()->back()->with('status_fail', 'Lỗi tạo bài đăng');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
