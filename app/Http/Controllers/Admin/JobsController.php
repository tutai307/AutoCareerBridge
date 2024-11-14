<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Job\JobService;
use Exception;
use Illuminate\Http\Request;

class JobsController extends Controller
{

    protected $jobService;

    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->only(['search', 'status', 'major']);
        try {
            $jobs = $this->jobService->getJobs($data);
            $majors = $this->jobService->getMajors();
            return view('admin.jobs.index', compact('jobs', 'majors'));
        }catch (Exception $e){
            return redirect()->route('admin.jobs.index')->with('error', $e->getMessage());
        }

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
        $data = $request->only(['status', 'id']);
        try {
            $check = $this->jobService->update($data['id'], $data);
            if(!$check) return redirect()->back()->withErrors(['error' => 'Cập nhật thất bại!']);
            return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
        }catch (Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
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
