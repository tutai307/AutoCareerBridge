<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Services\CompanyService;
/**
* 
* Search-university.
*
* @package App\Http\Controllers
* @author Dang Duc Chung
* @access public
* @see index()
* @see searchUniversity()
*/
class CompaniesController extends Controller
{
    protected $companyService;
    public function __construct(CompanyService $companyService) {
        $this->companyService = $companyService;
    }
/**
 * Display a listing of universities and provinces.
 * @author Dang Duc Chung
 * @access public
 * @return \Illuminate\View\View  
 */
    public function index(){
        $universities = $this->companyService->index();
        $provinces = $this->companyService->getProvinces();
        return view('management.company.search.searchUniversity', compact('universities', 'provinces'));
    }
/**
 * Search for universities based on the request criteria.
 * @author Dang Duc Chung
 * @access public
 * @param  \Illuminate\Http\Request  $request  The request object containing search parameters.
 * @return \Illuminate\Http\JsonResponse  A JSON response containing the rendered HTML for the universities table.
 */
    public function searchUniversity(Request $request){
        $universities = $this->companyService->findUniversity($request);
        return response()->json([
            'html' => view('management.company.search.tableUniversity', compact('universities'))->render()
        ]);;
    }

}
