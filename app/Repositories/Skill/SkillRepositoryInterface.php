<?php

namespace App\Repositories\Skill;

use App\Repositories\Base\BaseRepositoryInterface;

interface SkillRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel();
    public function getSkills(array $filters);
}
