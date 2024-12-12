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
        // Clear existing data
        DB::table('companies')->truncate();
        DB::table('addresses')->where('company_id', '!=', null)->delete();

        // Find the user with ROLE_COMPANY
        $companyUser = DB::table('users')
            ->where('role', ROLE_COMPANY)
            ->first();

        if ($companyUser) {
            $companyId = DB::table('companies')->insertGetId([
                'name' => 'Main Company',
                'user_id' => $companyUser->id,
                'slug' => Str::slug('Main Company'),
                'phone' => '',
                'map' => 'https://www.google.com/maps/embed?pb=' . Str::random(30),
                'size' => rand(100, 500),
                'description' => 'Primary company for our platform',
                'about' => 'Detailed information about our main company',
            ]);

            DB::table('addresses')->insert([
                'company_id' => $companyId,
                'province_id' => DB::table('provinces')->inRandomOrder()->value('id'),
                'district_id' => DB::table('districts')->inRandomOrder()->value('id'),
                'ward_id' => DB::table('wards')->inRandomOrder()->value('id'),
                'specific_address' => 'Company Headquarters Address',
            ]);
        }
    }
}
