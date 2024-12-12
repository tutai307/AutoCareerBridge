<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CollaborationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('collaborations')->truncate();
        $universities = DB::table('universities')->get();
        $companies = DB::table('companies')->get();

        $collaborationCount = min($universities->count() * $companies->count(), 20);

        $usedCombinations = [];

        for ($i = 0; $i < $collaborationCount; $i++) {
            do {
                $university = $universities->random();
                $company = $companies->random();
                $combinationKey = $university->id . '-' . $company->id;
            } while (isset($usedCombinations[$combinationKey]));

            $usedCombinations[$combinationKey] = true;

            DB::table('collaborations')->insert([
                'university_id' => $university->id,
                'company_id' => $company->id,
                'title' => 'Collaboration between ' . $university->name . ' and ' . $company->name,
                'status' => $this->getRandomStatus(),
                'response_message' => (rand(0, 1) == 0) ? 'Collaboration accepted.' : null,
                'content' => 'Collaborative project between ' . $university->name . ' and ' . $company->name,
                'created_by' => rand(ROLE_COMPANY, ROLE_UNIVERSITY),
                'start_date' => Carbon::now()->format('Y-m-d'),
                'end_date' => Carbon::now()->addMonths(rand(3, 12))->format('Y-m-d'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }

// Hàm trả về trạng thái ngẫu nhiên từ danh sách các trạng thái
    private function getRandomStatus()
    {
        $statuses = [
            STATUS_PENDING,
            STATUS_APPROVED,
            STATUS_REJECTED,
        ];

        return $statuses[array_rand($statuses)];
    }
}
