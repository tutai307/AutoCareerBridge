<?php

namespace App\Repositories\Universities;

use App\Repositories\Base\BaseRepositoryInterface;

interface UniversityRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel();

    public function findById($id);
    
    public function updateAvatar($university, $imagePath);
}
