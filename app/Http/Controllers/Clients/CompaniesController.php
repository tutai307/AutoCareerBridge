<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Services\Province\ProvinceService;
use App\Services\Company\CompanyService;
use Illuminate\Http\Request;

/**
 * Companies Controller Processes returned data,
 * @author Hoang Duy Lap, Khuat Van Duy
 * @access public
 * @package Clients
 * @see listCompanies()
 */
class CompaniesController extends Controller
{
    protected $companyService;
    protected $provinceService;

    public function __construct(CompanyService $companyService, ProvinceService $provinceService)
    {
        $this->companyService = $companyService;
        $this->provinceService = $provinceService;
    }

    /**
     * Return data to client.
     * @access public
     * @return \Illuminate\View\View
     * @author Khuat Van Duy
     */
    public function listCompanies(Request $request)
    {
        $query = $request->query('search');
        $sortOrder = $request->query('sort_order');
        $provinceId = $request->query('province_id');

        $listCompanies = $this->companyService->getCompaniesWithJobsAndAddresses();

        $companies = $this->companyService->getCompaniesWithFilters($query, $provinceId, $sortOrder);

        $provincies = $this->provinceService->getAllProvinces();

        return view('client.pages.company.listCompany', compact(['companies', 'provincies', 'listCompanies']));
    }

    /**
     * Return company detail to client.
     * @access public
     * @return \Illuminate\View\View
     * @author Hoang Duy Lap
     * @param $slug
     */
    public function detailCompany($slug)
    {
        $company = $this->companyService->getCompanyBySlug($slug);
        if (!$company) {
           return 'Không tìm thấy công ty';
        }
        return view('client.pages.company.detailCompany', compact(['company']));
    }
}
