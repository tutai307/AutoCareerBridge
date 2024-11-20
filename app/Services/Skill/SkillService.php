<?php

namespace App\Services\Skill;

use App\Repositories\Skill\SkillRepositoryInterface;

class SkillService
{
    protected $skillRepository;

    public function __construct(SkillRepositoryInterface $skillRepository)
    {
        $this->skillRepository = $skillRepository;
    }

    public function getSkills(array $filters)
    {
        return $this->skillRepository->getSkills($filters);
    }
}
