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

        Company::query()->create([
            'name' => 'Company Duy Lập',
            'user_id' => 1,
            'slug' => Str::slug('Company Duy Lập', '-'),
            'phone' => '0123456789',
            'map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.5237056087!2d105.80614127457191!3d21.051735486990367!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab1ed1b1171d%3A0x2c2058540b19594!2zMTcyIMSQLiBM4bqhYyBMb25nIFF1w6JuLCBCxrDhu59pLCBUw6J5IEjhu5MsIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1731035055731!5m2!1svi!2s',
            'size' => '150',
            'description' => Str::random(100),
            'about' => Str::random(100),
        ]);
        DB::table('addresses')->insert([
            'company_id' => 1,
            'province_id' => DB::table('provinces')->where('id', 24)->value('id'), // Sử dụng `value()` để lấy giá trị
            'district_id' => DB::table('districts')->where('id', 219)->value('id'),
            'ward_id' => DB::table('wards')->where('id', 7606)->value('id'),
            'specific_address' => 'Thôn Tân Mộc'
        ]);


        Company::query()->create([
            'name' => 'Company Duy Lập 2',
            'user_id' => 2,
            'slug' => Str::slug('Company Duy Lập 2', '-'),
            'phone' => '0123456789',
            'map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.5237056087!2d105.80614127457191!3d21.051735486990367!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab1ed1b1171d%3A0x2c2058540b19594!2zMTcyIMSQLiBM4bqhYyBMb25nIFF1w6JuLCBCxrDhu59pLCBUw6J5IEjhu5MsIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1731035055731!5m2!1svi!2s',
            'size' => '200',
            'description' => Str::random(200),
            'about' => Str::random(300),
        ]);
        DB::table('addresses')->insert([
            'company_id' => 2,
            'province_id' => DB::table('provinces')->where('id', 1)->value('id'), // Sử dụng `value()` để lấy giá trị
            'district_id' => DB::table('districts')->where('id', 3)->value('id'),
            'ward_id' => DB::table('wards')->where('id', 109)->value('id'),
            'specific_address' => '172 Lạc Long Quân'
        ]);

    }
}
