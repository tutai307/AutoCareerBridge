<?php

namespace App\Services\Workshop;

use App\Repositories\Workshop\WorkshopRepositoryInterface;

class WorkshopService
{
    protected $workshopRepository;

    public function __construct(WorkshopRepositoryInterface $workshopRepository)
    {
        $this->workshopRepository = $workshopRepository;
    }

    public function getWorkshops(array $filters)
    {
        return $this->workshopRepository->getWorkshops($filters);
    }

    public function findWorkshop($find)
    {
        return $this->workshopRepository->findWorkshop($find);
    }

    public function detailWorkShop($slug)
    {
        return $this->workshopRepository->detailWorkShop($slug);
    }
}
