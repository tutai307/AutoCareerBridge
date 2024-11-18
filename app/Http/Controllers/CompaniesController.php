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
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }
    /**
     * Display a listing of universities and provinces.
     * @author Dang Duc Chung
     * @access public
     * @return \Illuminate\View\View  
     */
    public function index(Request $request)
    {
        if ($request->has('searchName') || $request->has('searchProvince')) {
            $universities = $this->companyService->findUniversity($request);
        } else {
            $universities = $this->companyService->index();
        }
        $provinces = $this->companyService->getProvinces();
        return view('management.company.search.searchUniversity', compact('universities', 'provinces'));
    }
  
}
