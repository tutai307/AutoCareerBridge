<?php

namespace App\Repositories\Collaboration;

use App\Models\Address;
use App\Models\Collaboration;
use App\Models\Company;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use App\Repositories\Base\BaseRepository;

class CollaborationRepository extends BaseRepository implements CollaborationRepositoryInterface
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getModel()
    {
        return Collaboration::class;
    }
    public function getByStatus(int $status)
    {
        return $this->model->where('status', $status)->paginate(PAGINATE_COLLAB);
    }
}
