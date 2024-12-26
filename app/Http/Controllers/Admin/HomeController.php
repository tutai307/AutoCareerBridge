<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Job\JobService;
use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
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
            $applyJobs = $this->jobService->getApplyJobs();

            $total = 0;
            $totalYear = 0;
            $total = 0;
            $totalYear = 0;
            $data = [];
            foreach ($dataJobs as $y => $m) {
                $total += array_sum($m);
                if ($y == $currentYear) {
                    $totalYear += array_sum($m);
                    $data = $m;
                }
            }
            $data = json_encode($data);

            return view('management.pages.admin.home', [
                'totalUserComJobUni' => $totalUserComJobUni,
                'dataJobs' => $dataJobs,
                'currentYear' => $currentYear,
                'applyJobs' => $applyJobs,
                'data' => $data,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('status_fail', $e->getMessage());
        }
    }

    public function getJobChart(Request $request)
    {
        $getJobChart = $this->jobService->getJobChart($request->previousDate, $request->currentDate);
        return response()->json($getJobChart);
    }
}
