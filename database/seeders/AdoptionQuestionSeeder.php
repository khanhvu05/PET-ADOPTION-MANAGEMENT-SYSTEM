<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdoptionQuestion;
use Illuminate\Support\Str;

class AdoptionQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'Ma_hien_thi' => 1,
                'Noi_dung' => 'Bạn hiện đang sống ở loại nhà nào?',
                'Loai_cau_tra_loi' => 'single_choice',
                'Cac_lua_chon' => ['Nhà riêng có sân', 'Chung cư / căn hộ', 'Nhà thuê / phòng trọ', 'Khác'],
                'Bat_buoc' => true,
            ],
            [
                'Ma_hien_thi' => 2,
                'Noi_dung' => 'Trong nhà bạn có trẻ em dưới 5 tuổi không?',
                'Loai_cau_tra_loi' => 'single_choice',
                'Cac_lua_chon' => ['Có', 'Không'],
                'Bat_buoc' => true,
            ],
            [
                'Ma_hien_thi' => 3,
                'Noi_dung' => 'Trong nhà có thú cưng nào khác không?',
                'Loai_cau_tra_loi' => 'single_choice',
                'Cac_lua_chon' => ['Không có', 'Có chó', 'Có mèo', 'Có cả chó và mèo'],
                'Bat_buoc' => true,
            ],
            [
                'Ma_hien_thi' => 4,
                'Noi_dung' => 'Bạn đã từng nuôi thú cưng trước đây chưa?',
                'Loai_cau_tra_loi' => 'single_choice',
                'Cac_lua_chon' => ['Chưa bao giờ', 'Đã nuôi nhưng không còn', 'Đang nuôi'],
                'Bat_buoc' => true,
            ],
            [
                'Ma_hien_thi' => 5,
                'Noi_dung' => 'Mỗi ngày bạn có thể dành bao nhiêu thời gian chăm sóc thú cưng?',
                'Loai_cau_tra_loi' => 'single_choice',
                'Cac_lua_chon' => ['Dưới 1 tiếng', '1-2 tiếng', '2-4 tiếng', 'Trên 4 tiếng'],
                'Bat_buoc' => true,
            ],
            [
                'Ma_hien_thi' => 6,
                'Noi_dung' => 'Bạn có sẵn sàng đưa thú cưng đi khám định kỳ và tiêm phòng không?',
                'Loai_cau_tra_loi' => 'single_choice',
                'Cac_lua_chon' => ['Có, hoàn toàn sẵn sàng', 'Có nhưng phụ thuộc chi phí', 'Chưa chắc'],
                'Bat_buoc' => true,
            ],
            [
                'Ma_hien_thi' => 7,
                'Noi_dung' => 'Nếu bạn phải đi công tác hoặc du lịch dài ngày, bạn sẽ sắp xếp như thế nào?',
                'Loai_cau_tra_loi' => 'text',
                'Cac_lua_chon' => null,
                'Bat_buoc' => true,
            ],
            [
                'Ma_hien_thi' => 8,
                'Noi_dung' => 'Lý do bạn muốn nhận nuôi bé này là gì?',
                'Loai_cau_tra_loi' => 'text',
                'Cac_lua_chon' => null,
                'Bat_buoc' => true,
            ],
            [
                'Ma_hien_thi' => 9,
                'Noi_dung' => 'Bạn có đồng ý để tổ chức liên hệ theo dõi tình trạng thú cưng sau khi nhận nuôi không?',
                'Loai_cau_tra_loi' => 'single_choice',
                'Cac_lua_chon' => ['Đồng ý', 'Không đồng ý'],
                'Bat_buoc' => true,
            ]
        ];

        // Clear table before seed to avoid duplicates if run multiple times
        AdoptionQuestion::query()->delete();

        foreach ($questions as $index => $q) {
            AdoptionQuestion::create([
                'Ma_cau_hoi' => Str::uuid()->toString(),
                'Ma_hien_thi' => $q['Ma_hien_thi'],
                'Noi_dung' => $q['Noi_dung'],
                'Loai_cau_tra_loi' => $q['Loai_cau_tra_loi'],
                'Cac_lua_chon' => $q['Cac_lua_chon'],
                'Bat_buoc' => $q['Bat_buoc'],
                'Thu_tu' => $index + 1,
                'Hoat_dong' => true,
            ]);
        }
    }
}
