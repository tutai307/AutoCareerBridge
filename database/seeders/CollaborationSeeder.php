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
        // Sử dụng vòng lặp for để thêm nhiều bản ghi
        for ($i = 1; $i <= 10; $i++) {
            DB::table('collaborations')->insert([
                'university_id' => rand(1, 5), // Giả sử có 5 trường
                'company_id' => rand(1, 5),    // Giả sử có 5 công ty
                'title' => 'Collaboration ' . $i,
                'status' => rand(1, 6), // Giả sử trạng thái có 6 giá trị: 1, 2, 3, 4, 5, 6
                'response_message' => ($i % 2 == 0) ? 'Collaboration accepted.' : null,
                'content' => 'This is a description for collaboration ' . $i,
                'start_date' => Carbon::now()->format('Y-m-d'), // Gán ngày hiện tại
                'end_date' => Carbon::now()->addMonths(rand(3, 12))->format('Y-m-d'),
                'deleted_at' => null, // Không xóa mềm
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
            STATUS_ACTIVE,
            STATUS_COMPLETED,
            STATUS_TERMINATED
        ];

        return $statuses[array_rand($statuses)];
    }
}
