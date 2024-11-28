<?php

namespace App\Repositories\Fields;

use App\Repositories\Base\BaseRepositoryInterface;

interface FieldsRepositoryInterface extends BaseRepositoryInterface
{
    public function getFields();
}
