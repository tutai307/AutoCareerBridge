<?php

namespace App\Repositories\Workshop;

use App\Repositories\Base\BaseRepositoryInterface;

interface WorkshopRepositoryInterface extends BaseRepositoryInterface
{
    public function getWorkshop($filters);

    public function getWorkShopsHot();

    public function getWorkShopClient();

    public function getWorkshops(array $filters);

    public function findWorkshop($find);

    public function detailWorkShop($slug);

    public function applyWorkShop($companyId, $workshopId);

    public function manageCompanyWorkshop($universityId);

    public function updateStatusWorkShop($companyId, $workshopId, $status);

    public function findCompanyWorkshop($companyId, $workshopId);

    public function workshopApplied($companyId);

    public function getWorkshopDashboard($dateFrom, $dateTo);
}
