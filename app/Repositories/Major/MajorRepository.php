<?php

namespace App\Repositories\Major;

use App\Models\Major;
use App\Repositories\Base\BaseRepository;

class MajorRepository extends BaseRepository implements MajorRepositoryInterface
{
    public function getModel()
    {
        return Major::class;
    }

    public function getMajors(array $filters)
    {

    }
}
