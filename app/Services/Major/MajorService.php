<?php

namespace App\Services\Major;

use App\Repositories\Major\MajorRepositoryInterface;

class MajorService
{
    protected $majorRepository;

    public function __construct(MajorRepositoryInterface $majorRepository)
    {
        $this->majorRepository = $majorRepository;
    }

    public function getMajors(array $filters)
    {
        return $this->majorRepository->getMajors($filters);
    }

    public function getAll()
    {
        return $this->majorRepository->getAll();
    }
}
