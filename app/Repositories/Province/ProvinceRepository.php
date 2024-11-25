<?php

namespace App\Repositories\Province;

use App\Models\Province;
use App\Repositories\Base\BaseRepository;

class ProvinceRepository extends BaseRepository implements ProvinceRepositoryInterface
{
    public function getModel()
    {
        return Province::class;
    }

    public function getAllProvinces()
    {
        return $this->model->all();
    }
}
