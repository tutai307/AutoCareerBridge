<?php

namespace App\Services\Skill;

use App\Models\Skill;
use App\Repositories\Skill\SkillRepositoryInterface;
use Illuminate\Support\Str;

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

    public function getAll()
    {
        return $this->skillRepository->getAll();
    }


    public function createSkill(array $skillNames)
    {
        $skills = [];
        foreach ($skillNames as $skillName) {
            $slug = Str::slug($skillName);
            $originalSlug = $slug;

            // Kiểm tra slug đã tồn tại chưa
            while (Skill::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . uniqid(); // Thêm chuỗi random nếu trùng
            }

            $skills[] = Skill::firstOrCreate(
                ['name' => $skillName],
                ['slug' => $slug]
            );
        }
        return $skills;
    }
}
