<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Services\University\UniversityService;
use Exception;
use Illuminate\Http\Request;

/**
 *
 * Display the university detail page
 *
 * @package App\Http\Controllers
 * @author Dang Duc Chung
 * @access public
 * @see getDetailUniversity($id)
 */
class UniversitiesController extends Controller
{
    protected $universityService;
    public function __construct(UniversityService $universityService)
    {
        $this->universityService = $universityService;
    }

    /**
     * Display a list of the company's hirings.
     * @author Dang Duc Chung
     * @access public
     * @param int $id The ID of the university to be displayed.
     * @return \Illuminate\View\View
     */
    public function showDetailUniversity($slug)
    {
        $data = $this->universityService->getDetail($slug);
        $workshops = $this->universityService->getWorkShops($slug);
        $full_address = $data['address']->specific_address  . ', ' . $data['address']->ward->name . ', ' . $data['address']->district->name . ', ' . $data['address']->province->name;
        $majors = $data['detail']->majors;
        $detail = $data['detail'];
        return view('management.pages.university.detail.detailUniversity', compact('detail', 'full_address', 'majors', 'workshops'));
    }

    public function dashboard()
    {
        $totalStudentWorkshopColabJob = $this->universityService->totalRecord();
        $currentYear = date('Y');
        return view('management.pages.university.home', compact('totalStudentWorkshopColabJob', 'currentYear'));
    }

    public function getChartWorkshop(Request $request)
    {
        $dateFrom = $request->previousDate;
        $dateTo = $request->currentDate;
        $workshops = $this->universityService->getWorkshopDashboard($dateFrom, $dateTo);
        return response()->json($workshops);
    }
}
