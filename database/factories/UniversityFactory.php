<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\University>
 */
class UniversityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'slug' => fake()->slug(),
            'abbreviation' => fake()->word(),
            'user_id' => User::pluck('id')->random(),
            'avatar_path' => fake()->imageUrl(),
            'description' => fake()->text(),
            'about' => fake()->text(),
            'active' => 1,
        ];
    }
}
