<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Services\Province\ProvinceService;
use App\Services\University\UniversityService;
use App\Services\Workshop\WorkshopService;
use Illuminate\Http\Request;

/**
 * Universities Controller Processes returned data,
 * @author Dang Duc Chung
 * @access public
 * @package Clients
 * @see listUniversities(), showDetailUniversity()
 */
class UniversitiesController extends Controller
{
    protected $universityService;
    protected $provinceService;
    protected $workshopService;

    public function __construct(UniversityService $universityService, ProvinceService $provinceService,WorkshopService $workshopService)
    {
        $this->universityService = $universityService;
        $this->provinceService = $provinceService;
        $this->workshopService = $workshopService;
    }

    /**
     * Return data to client.
     * @access public
     * @return \Illuminate\View\View
     * @author Dang Duc Chung
     */
    public function listUniversities(Request $request)
    {
        $universities = $this->universityService->findUniversity($request);
        $universities = $universities->appends($request->except('page'));
        $popularUniversities = $this->universityService->popularUniversities();
        $provinces = $this->provinceService->getAllProvinces();
        return view('client.pages.university.listUniversity', compact('universities', 'provinces','popularUniversities'));
    }

     /**
     *Show school details page.
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
        return view('client.pages.university.detaiUniversity', compact('detail', 'full_address', 'majors', 'workshops'));
    }

    public function detailWorkShop($slug){
        $workshop= $this->workshopService->detailWorkShop($slug);
        return  $workshop;
    }
}
