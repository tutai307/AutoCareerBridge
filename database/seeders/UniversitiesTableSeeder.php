<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UniversitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('universities')->insert([
            [
                'name' => 'Đại học Bách Khoa Hà Nội',
                'slug' => 'dhbk-hn',
                'user_id' => 1,
                'avatar_image' => 'https://i.pinimg.com/originals/3f/1c/b4/3f1cb4bc81fa8004a67103eb19181739.png',
                'map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8565210383437!2d105.78132011476357!3d21.03929738599288!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab23024e2c75%3A0x9df961e03349c123!2zQuG6v3QgaOG7kWMgQsOhY2ggS2hvYSBI4bqjaSBObw!5e0!3m2!1svi!2s!4v1688745623456!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                'website_link' => "https:/hust.edu.vn/",
                'description' => 'Tổng số sinh viên đang theo học: 32.000 - 34.000 người                                                                     
Số sinh viên đại học chính quy đang theo học: 25.447 người
Số sinh viên sau đại học (cao học, NCS hoặc tương đương) đang theo học: 558 người
Số sinh viên cao đẳng chính quy đang theo học: 601 người
Tỷ lệ sinh viên chính quy ra trường có việc làm sau 12 tháng kể từ ngày tốt nghiệp: 92,14%
Tỷ lệ sinh viên ĐH chính quy ra trường có việc làm sau 12 tháng kể từ ngày tốt nghiệp: 92,78%
Tỷ lệ sinh viên CĐ chính quy ra trường có việc làm sau 12 tháng kể từ ngày tốt nghiệp: 90,61%',
                'about' => 'Trường Đại học Bách Khoa Hà Nội được thành lập năm 1956, là một trong những trường đại học kỹ thuật đầu tiên và hàng đầu của Việt Nam. Trường có bề dày lịch sử phát triển với mục tiêu đào tạo nguồn nhân lực chất lượng cao trong các lĩnh vực khoa học, kỹ thuật, công nghệ và quản lý. Trường cũng là trung tâm nghiên cứu khoa học và chuyển giao công nghệ lớn của cả nước. Với mạng lưới cựu sinh viên rộng khắp, nhiều người trong số họ đã và đang giữ các vị trí quan trọng trong các cơ quan nhà nước, doanh nghiệp, và tổ chức quốc tế.',
                'active' => 1,
                'scale' => 6000,
                'training_program' => 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Đại học Công Nghiệp Hà Nội',
                'slug' => 'dhcn-hn',
                'user_id' => 2,
                'avatar_image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyxUPzKI3yNIPNn2ePoncuxFLMjNhJ20NKBQ&s',
                'map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.9675634564567!2d105.77700311503414!3d21.02979873456218!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab4e7f4c1c3b%3A0xa63d9b0c6e65432f!2zTmjhuq10IGjhu5NuZyBExINuIE5naOG7hywgTmfFqSB0aMOtbg!5e0!3m2!1svi!2s!4v1688745635567!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                'website_link' => "https:/haui.edu.vn/",
                'description' => 'Tổng số sinh viên đang theo học: 32.000 - 34.000 người                                                                     
Số sinh viên đại học chính quy đang theo học: 25.447 người
Số sinh viên sau đại học (cao học, NCS hoặc tương đương) đang theo học: 558 người
Số sinh viên cao đẳng chính quy đang theo học: 601 người
Tỷ lệ sinh viên chính quy ra trường có việc làm sau 12 tháng kể từ ngày tốt nghiệp: 92,14%
Tỷ lệ sinh viên ĐH chính quy ra trường có việc làm sau 12 tháng kể từ ngày tốt nghiệp: 92,78%
Tỷ lệ sinh viên CĐ chính quy ra trường có việc làm sau 12 tháng kể từ ngày tốt nghiệp: 90,61%',
                'about' => 'Trường Đại học Công nghiệp Hà Nội có bề dày lịch sử 125 năm xây dựng và phát triển, tiền thân là hai trường: Trường Chuyên nghiệp Hà Nội (thành lập năm 1898) và Trường Chuyên nghiệp Hải Phòng (thành lập năm 1913). Qua nhiều lần sáp nhập, đổi tên, nâng cấp từ trường Trung học Công nghiệp I lên Trường Cao đẳng Công nghiệp Hà Nội và Trường Đại học Công nghiệp Hà Nội. Trải qua hơn 120 năm, ở giai đoạn nào, Trường cũng luôn được đánh giá là cái nôi đào tạo cán bộ kỹ thuật, cán bộ kinh tế hàng đầu của cả nước, nhiều cựu học sinh của Trường đã trở thành lãnh đạo cấp cao của Đảng, Nhà nước đã đi vào lịch sử như: Hoàng Quốc Việt, Nguyễn Thanh Bình, Phạm Hồng Thái, Lương Khánh Thiện...; nhiều cựu học sinh, sinh viên trở thành các cán bộ nòng cốt, nắm giữ các cương vị trọng trách của Đảng, Nhà nước, các Bộ, Ban, Ngành Trung Ương và địa phương.',
                'active' => 1,
                'scale' => 8800,
                'training_program' => 20,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
