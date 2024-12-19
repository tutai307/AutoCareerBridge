<?php

namespace Database\Seeders;

use App\Models\University;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('universities')->truncate();
        DB::table('addresses')->where('university_id', '!=', null)->delete();

        $universityUsers = DB::table('users')
            ->where('role', ROLE_UNIVERSITY)
            ->get();

        foreach ($universityUsers as $universityUser) {
            $slug = Str::slug('Main University') . '-' . Str::random(6);

            $universityId = DB::table('universities')->insertGetId([
                'name' => 'Main University',
                'slug' => $slug,
                'abbreviation' => Str::upper(Str::random(3)),
                'user_id' => $universityUser->id,
                'avatar_path' => fake()->imageUrl(),
                'description' => 'Primary university for our platform',
                'about' => 'Detailed information about our main university',
                'active' => 1,
            ]);

            DB::table('addresses')->insert([
                'university_id' => $universityId,
                'province_id' => DB::table('provinces')->inRandomOrder()->value('id'),
                'district_id' => DB::table('districts')->inRandomOrder()->value('id'),
                'ward_id' => DB::table('wards')->inRandomOrder()->value('id'),
                'specific_address' => 'University Main Campus Address',
            ]);
        }
    }
}
