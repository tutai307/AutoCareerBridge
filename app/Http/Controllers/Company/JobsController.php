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
        $jobs = $this->jobService->getPostsByCompany($data);
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
            $skills = $this->skillService->createSkill($request->skill_name);
            $this->jobService->createJob($request->all(), $skills);

            DB::commit();
            return redirect()->route('company.manageJob')->with('status_success', 'Tạo bài tuyển dụng thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Lỗi tạo bài tuyển dụng: ' . $exception->getMessage());
            return redirect()->back()->with('status_fail', 'Lỗi tạo bài tuyển dụng');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $job = $this->jobService->getJob($slug);

        $jobUniversities = $job->universities()
        ->with(['universityJobs' => function ($query) use ($job) {
            $query->where('job_id', $job->id);
        }])
        ->paginate(PAGINATE_DETAIL_JOB_UNIVERSITY);
        
        return view('management.pages.company.jobs.show', compact('job', 'jobUniversities'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $job = $this->jobService->getJob($slug);
        
        if (empty($job)) {
            return redirect()->route('company.manageJob')->with('status_fail', 'Không tìm thấy bài tuyển dụng');
        }

        if ($job->status == STATUS_REJECTED || $job->status == STATUS_APPROVED) {
            return redirect()->route('company.manageJob')->with('status_fail', 'Không thể sửa bài tuyển dụng này, chỉ bài tuyển dụng trong trạng thái chờ phê duyệt mới được sửa!');
        }

        $majors = $this->jobService->getMajors();
        $skills = $this->skillService->getAll();

        return view('management.pages.company.jobs.edit', compact('job', 'majors', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, string $id)
    {
        try {
            DB::beginTransaction();

            $skills = [];
            $skills = $this->skillService->createSkill($request->skill_name);
            $this->jobService->updateJob($id, $request->all(), $skills);

            DB::commit();
            return redirect()->route('company.manageJob')->with('status_success', 'Cập nhật bài tuyển dụng thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Lỗi cập nhật bài tuyển dụng: ' . $exception->getMessage());
            return redirect()->back()->with('status_fail', 'Lỗi cập nhật bài tuyển dụng');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $jobExists = $this->jobService->find($id);
            if (!$jobExists) {
                return redirect()->back()->with('status_fail', 'Không tìm thấy bài tuyển dụng, không thể xóa!');
            }
            $this->jobService->deleteJob($id);
            return redirect()->route('company.manageJob')->with('status_success', 'Xóa bài tuyển dụng thành công');
        } catch (\Exception $exception) {
            Log::error('Lỗi xóa bài tuyển dụng: ' . $exception->getMessage());
            return redirect()->back()->with('status_fail', 'Lỗi xóa bài tuyển dụng');
        }
    }
}
