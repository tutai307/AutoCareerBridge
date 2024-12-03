<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $companyId = DB::table('companies')->insertGetId([
                'name' => 'Company ' . $i,
                'user_id' => $i,
                'slug' => Str::slug('Company ' . $i, '-'),
                'phone' => '0123' . rand(100000, 999999),
                'map' => 'https://www.google.com/maps/embed?pb=' . Str::random(30),
                'size' => rand(100, 500),
                'description' => 'This is a description for company ' . $i,
                'about' => 'About company ' . $i,
            ]);

            DB::table('addresses')->insert([
                'company_id' => $companyId,
                'province_id' => DB::table('provinces')->inRandomOrder()->value('id'),
                'district_id' => DB::table('districts')->inRandomOrder()->value('id'),
                'ward_id' => DB::table('wards')->inRandomOrder()->value('id'),
                'specific_address' => 'Address ' . $i,
            ]);
        }
    }
}
