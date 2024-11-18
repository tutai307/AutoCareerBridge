<?php

namespace App\Repositories\Workshop;

use App\Models\Workshop;
use App\Repositories\Base\BaseRepository;

class WorkshopRepository extends BaseRepository implements WorkshopRepositoryInterface
{
    public function getModel()
    {
        return Workshop::class;
    }

    public function getWorkshops(array $filters)
    {

    }
}
