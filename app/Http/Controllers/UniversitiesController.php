<?php

namespace App\Http\Controllers;
use App\Services\UniversityService;
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
    public function __construct(UniversityService $universityService) {
        $this->universityService = $universityService;
    }

/**
 * Display a list of the company's hirings.
 * @author Dang Duc Chung
 * @access public
 * @param int $id The ID of the university to be displayed.
 * @return \Illuminate\View\View
 */
    public function showDetailUniversity($id){
            $detail = $this->universityService->getDetail($id);
            $workshops = $this->universityService->getWorkShops($id);
            $address = $detail->specific_address  . ', ' .$detail->ward_name . ', ' . $detail->district_name . ', ' . $detail->province_name;
            $majors = $detail->majors;
            return view('management.university.detailUniversity', compact('detail','address','majors','workshops'));   
    }

}
