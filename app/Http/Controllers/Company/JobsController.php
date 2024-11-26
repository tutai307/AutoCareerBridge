<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\Job\JobService;
use Illuminate\Http\Request;

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

    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
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
        $majors = $this->jobService->getMajors();
        return view('management.pages.company.jobs.index', compact('jobs', 'majors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
