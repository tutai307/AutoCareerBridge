<?php

namespace App\Repositories\Workshop;

use App\Repositories\Base\BaseRepositoryInterface;

interface WorkshopRepositoryInterface extends BaseRepositoryInterface
{
    public function getWorkshop($filters);
    public function getModel();
    public function getWorkshops(array $filters);
    public function findWorkshop($find);
    public function detailWorkShop($slug);
}
