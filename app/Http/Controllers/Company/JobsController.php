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
        DB::beginTransaction();
        try {
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

        if (empty($job) || !in_array(Auth::guard('admin')->user()->role, [ROLE_COMPANY, ROLE_HIRING]) ||
            (Auth::guard('admin')->user()->role === ROLE_COMPANY && $job->company_id !== Auth::guard('admin')->user()->company->id) ||
            (Auth::guard('admin')->user()->role === ROLE_HIRING && $job->company_id !== Auth::guard('admin')->user()->hiring->company_id)) {
            return empty($job) ? 
                redirect()->route('company.manageJob')->with('status_fail', 'Không tìm thấy bài tuyển dụng') : 
                abort(403, 'Bạn không có quyền xem bài tuyển dụng này');
        }

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
        
        if (empty($job) || $job->status !== STATUS_PENDING || !in_array(Auth::guard('admin')->user()->role, [ROLE_COMPANY, ROLE_HIRING])
            || (Auth::guard('admin')->user()->role === ROLE_COMPANY && $job->company_id !== Auth::guard('admin')->user()->company->id)
            || (Auth::guard('admin')->user()->role === ROLE_HIRING && $job->company_id !== Auth::guard('admin')->user()->hiring->company_id)) {
            return empty($job) ? 
                redirect()->route('company.manageJob')->with('status_fail', 'Không tìm thấy bài tuyển dụng') : 
                abort(403, 'Bạn không có quyền sửa bài tuyển dụng này');
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
        DB::beginTransaction();
        try {
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

            if (!$jobExists || !in_array(Auth::guard('admin')->user()->role, [ROLE_COMPANY, ROLE_HIRING]) ||
                (Auth::guard('admin')->user()->role === ROLE_COMPANY && $jobExists->company_id !== Auth::guard('admin')->user()->company->id) ||
                (Auth::guard('admin')->user()->role === ROLE_HIRING && $jobExists->company_id !== Auth::guard('admin')->user()->hiring->company_id)) {
                return empty($jobExists) ? 
                    redirect()->back()->with('status_fail', 'Không tìm thấy bài tuyển dụng, không thể xóa!') : 
                    abort(403, 'Bạn không có quyền xóa bài tuyển dụng này');
            }
            
            $this->jobService->deleteJob($id);
            return redirect()->route('company.manageJob')->with('status_success', 'Xóa bài tuyển dụng thành công');
        } catch (\Exception $exception) {
            Log::error('Lỗi xóa bài tuyển dụng: ' . $exception->getMessage());
            return redirect()->back()->with('status_fail', 'Lỗi xóa bài tuyển dụng');
        }
    }

    /**
     * Manage university job applications.
     * This method retrieves and categorizes university job applications based on their status
     * (pending, approved, rejected). It then returns a view with the categorized data for display.
     *
     * @return \Illuminate\View\View The view for managing university job applications, including pending, approved, and rejected jobs.
     * @author Dang Duc Chung
     * @throws \Exception If retrieving or processing the job applications fails.
     * @see JobService::manageUniversityJob() for the logic behind fetching the university job data.
     */
    public function manageUniversityJob()
    {
        try {
            $universityJobs = $this->jobService->manageUniversityJob();
            $pending = $universityJobs['pending'];
            $approved = $universityJobs['approved'];
            $rejected = $universityJobs['rejected'];
            return view('management.pages.company.university_job.index', compact('pending', 'approved', 'rejected'));
        } catch (\Exception $exception) {
            Log::error('Lỗi : ' . $exception->getMessage());
            return redirect()->back()->with('status_fail', 'Lỗi');
        }
    }

    /**
     * Update the status of a university job application.
     * Manage university job applications by retrieving and displaying them categorized by status.
     *
     * @param int $id The ID of the university job application.
     * @param int $status The status to be updated. 2: Approved, 3: Rejected.
     *
     * @return \Illuminate\Http\RedirectResponse A redirect response to the previous page.
     *
     * @author Dang Duc Chung
     * @throws \Exception If updating the status fails.
     * @see JobService::updateStatusUniversityJob()
     */
    public function updateStatus($id, $status)
    {
        try {
            $this->jobService->updateStatusUniversityJob($id, $status);
            return redirect()->back()->with('status_success', 'Cập nhật trạng thái thành công');;
        } catch (\Exception $exception) {
            Log::error('Lỗi : ' . $exception->getMessage());
            return redirect()->back()->with('status_fail', 'Lỗi');
        }
    }
}
