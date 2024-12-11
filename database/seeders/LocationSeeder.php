<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Đường dẫn đến file JSON trong thư mục public
        $jsonPath = public_path('db_country.json');

        // Kiểm tra file JSON có tồn tại hay không
        if (file_exists($jsonPath)) {
            // Đọc nội dung file và chuyển đổi sang mảng
            $data = json_decode(file_get_contents($jsonPath), true);

            if ($data) {
                foreach ($data as $provinceData) {
                    // Kiểm tra các khóa cần thiết
                    if (!isset($provinceData['Id'], $provinceData['Name'], $provinceData['Districts'])) {
                        continue; // Bỏ qua nếu thiếu dữ liệu cần thiết
                    }

                    // Thêm tỉnh/thành phố vào bảng provinces
                    $province = Province::create([
                        'id' => $provinceData['Id'],
                        'name' => $provinceData['Name'],
                    ]);

                    foreach ($provinceData['Districts'] as $districtData) {
                        // Kiểm tra các khóa cần thiết
                        if (!isset($districtData['Id'], $districtData['Name'], $districtData['Wards'])) {
                            continue; // Bỏ qua nếu thiếu dữ liệu cần thiết
                        }

                        // Thêm quận/huyện vào bảng districts
                        $district = District::create([
                            'id' => $districtData['Id'],
                            'name' => $districtData['Name'],
                            'province_id' => $province->id,
                        ]);

                        foreach ($districtData['Wards'] as $wardData) {
                            // Kiểm tra các khóa cần thiết
                            if (!isset($wardData['Id'], $wardData['Name'])) {
                                continue; // Bỏ qua nếu thiếu dữ liệu cần thiết
                            }

                            // Thêm phường/xã vào bảng wards
                            Ward::create([
                                'id' => $wardData['Id'],
                                'name' => $wardData['Name'],
                                'district_id' => $district->id,
                            ]);
                        }
                    }
                }
                $bar = $this->command->getOutput()->createProgressBar(100);

                for ($i = 0; $i < 100; $i++) {
                    $bar->advance();
                    $this->command->info("Hack thành công máy anh Toàn nhé! $i%");

                }

                $bar->finish();
            } else {
                $this->command->error('Không thể phân tích file JSON.');
            }
        } else {
            $this->command->error('File db_country.json không tồn tại.');
        }
    }


}
