<?php

namespace App\Repositories\Skill;

use App\Models\Skill;
use App\Repositories\Base\BaseRepository;

class SkillRepository extends BaseRepository implements SkillRepositoryInterface
{
    public function getModel()
    {
        return Skill::class;
    }

    public function getSkills(array $filters)
    {

    }
}
