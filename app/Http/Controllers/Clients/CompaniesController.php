<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Services\Company\CompanyService;

/**
 * Companies Controller Processes returned data,
 * @author Hoang Duy Lap
 * @access public
 * @package Clients
 * @see listCompanies()
 */
class CompaniesController extends Controller
{
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Return data to client.
     * @access public
     * @return \Illuminate\View\View
     * @author Hoang Duy Lap
     */
    public function listCompanies()
    {
        $listCompanies = $this->companyService->getAllPaginated();
        return view('client.pages.company.listCompany', compact(['listCompanies']));
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
