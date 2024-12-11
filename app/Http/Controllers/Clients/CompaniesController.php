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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author Khuat Van Duy
     */
    public function listCompanies(Request $request)
    {
        $query = $request->query('search');
        $sortOrder = $request->query('sort_order');
        $provinceId = $request->query('province_id');

        $companies = $this->companyService->getCompaniesWithFilters($query, $provinceId, $sortOrder);
        if ($request->ajax()) {
            return response()->json([
                'view1' => view('client.pages.components.client_company.view1', compact('companies'))->render(),
                'view2' => view('client.pages.components.client_company.view2', compact('companies'))->render(),
                'pagination1' => view('client.pages.components.client_company.pagination1', compact('companies'))->render(),
                'pagination2' => view('client.pages.components.client_company.pagination2', compact('companies'))->render(),
            ]);
        }

        $provincies = $this->provinceService->getAllProvinces();

        $listCompanies = $this->companyService->getCompaniesWithJobsAndAddresses();

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
