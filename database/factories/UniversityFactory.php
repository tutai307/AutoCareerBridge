<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'name' => fake()->unique()->company(),
            'slug' => function(array $attributes) {
                return Str::slug($attributes['name']);
            },
            'abbreviation' => fake()->unique()->lexify('???'), // Random 3-letter abbreviation
            'user_id' => function() {

                return User::whereDoesntHave('universities')->pluck('id')->random();
            },
            'avatar_path' => fake()->imageUrl(),
            'description' => fake()->paragraph(),
            'about' => fake()->text(300),
            'active' => 1,
        ];
    }
}
