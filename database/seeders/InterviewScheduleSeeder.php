<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InterviewSlot;
use App\Models\InterviewSchedule;
use App\Models\AdoptionApplication;
use App\Models\User;
use App\Models\Pet;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class InterviewScheduleSeeder extends Seeder
{
    public function run(): void
    {
        // Xóa dữ liệu cũ (nếu muốn chạy nhiều lần không lỗi)
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        InterviewSchedule::truncate();
        InterviewSlot::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
        AdoptionApplication::query()->update(['interview_slot_id' => null, 'Trang_thai' => 'pending']);

        $admin = User::first() ?? User::factory()->create();
        $user = User::skip(1)->first() ?? User::factory()->create();
        $pets = Pet::inRandomOrder()->limit(5)->get();

        if ($pets->isEmpty()) {
            // Seed 1 vài pet nếu chưa có
            // Thôi cứ giả sử có pet rồi. Nếu không có thì tạo đại 1 pet.
        }

        // 1. Tạo các Slot phỏng vấn (Một số trong tương lai, một số trong quá khứ)
        $slots = [];
        $today = Carbon::today();

        // 1.1 Tương lai gần
        $slots[] = InterviewSlot::create([
            'Ngay' => $today->copy()->addDays(2),
            'Gio_bat_dau' => '09:00:00',
            'Gio_ket_thuc' => '10:00:00',
            'So_luong_toi_da' => 2,
            'So_luong_hien_tai' => 1,
            'Nhan_vien_xu_ly' => $admin->Ma_nguoi_dung,
            'Trang_thai' => 'mo',
        ]);
        $slots[] = InterviewSlot::create([
            'Ngay' => $today->copy()->addDays(2),
            'Gio_bat_dau' => '14:00:00',
            'Gio_ket_thuc' => '15:00:00',
            'So_luong_toi_da' => 2,
            'So_luong_hien_tai' => 0,
            'Nhan_vien_xu_ly' => $admin->Ma_nguoi_dung,
            'Trang_thai' => 'mo',
        ]);
        $slots[] = InterviewSlot::create([
            'Ngay' => $today->copy()->addDays(5),
            'Gio_bat_dau' => '10:00:00',
            'Gio_ket_thuc' => '11:00:00',
            'So_luong_toi_da' => 1,
            'So_luong_hien_tai' => 1,
            'Nhan_vien_xu_ly' => $admin->Ma_nguoi_dung,
            'Trang_thai' => 'day',
        ]);

        // 1.2 Quá khứ
        $slots[] = InterviewSlot::create([
            'Ngay' => $today->copy()->subDays(2),
            'Gio_bat_dau' => '15:00:00',
            'Gio_ket_thuc' => '16:00:00',
            'So_luong_toi_da' => 2,
            'So_luong_hien_tai' => 2,
            'Nhan_vien_xu_ly' => $admin->Ma_nguoi_dung,
            'Trang_thai' => 'mo',
        ]);

        // 2. Tạo các đơn nhận nuôi
        // Đơn 1: Được lên lịch trong slot 0 (Tương lai)
        $app1 = AdoptionApplication::create([
            'Ma_nguoi_dung' => $user->Ma_nguoi_dung,
            'Ma_thu_cung' => $pets[0]->Ma_thu_cung ?? null,
            'Ho_ten' => 'Nguyễn Văn A',
            'So_dien_thoai' => '0901234567',
            'Dia_chi' => 'Hà Nội',
            'Nghe_nghiep' => 'Kỹ sư',
            'Loai_nha_o' => 'Căn hộ',
            'Kinh_nghiem' => 'Đã từng nuôi chó',
            'Ly_do_nhan_nuoi' => 'Yêu thương động vật',
            'Cam_ket' => true,
            'Trang_thai' => 'cho_phong_van',
            'interview_slot_id' => $slots[0]->Ma_slot,
            'Ngay_tao' => Carbon::now()->subDays(4),
        ]);
        InterviewSchedule::create([
            'Ma_don' => $app1->Ma_don,
            'Ma_slot' => $slots[0]->Ma_slot,
            'Trang_thai' => 'da_xac_nhan',
            'Nhan_vien_xu_ly' => $admin->Ma_nguoi_dung,
        ]);

        // Đơn 2: Được lên lịch trong slot 2 (Tương lai - Đầy)
        $app2 = AdoptionApplication::create([
            'Ma_nguoi_dung' => $user->Ma_nguoi_dung,
            'Ma_thu_cung' => $pets[1]->Ma_thu_cung ?? null,
            'Ho_ten' => 'Trần Thị B',
            'So_dien_thoai' => '0987654321',
            'Dia_chi' => 'Hà Nội',
            'Nghe_nghiep' => 'Giáo viên',
            'Loai_nha_o' => 'Nhà đất',
            'Kinh_nghiem' => 'Chưa có',
            'Ly_do_nhan_nuoi' => 'Muốn có bạn đồng hành',
            'Cam_ket' => true,
            'Trang_thai' => 'cho_phong_van',
            'interview_slot_id' => $slots[2]->Ma_slot,
            'Ngay_tao' => Carbon::now()->subDays(5),
        ]);
        InterviewSchedule::create([
            'Ma_don' => $app2->Ma_don,
            'Ma_slot' => $slots[2]->Ma_slot,
            'Trang_thai' => 'cho_xac_nhan_don',
            'Nhan_vien_xu_ly' => $admin->Ma_nguoi_dung,
        ]);

        // Đơn 3: Trong quá khứ (slot 3), đã phỏng vấn Đạt
        $app3 = AdoptionApplication::create([
            'Ma_nguoi_dung' => $user->Ma_nguoi_dung,
            'Ma_thu_cung' => $pets[2]->Ma_thu_cung ?? null,
            'Ho_ten' => 'Lê Văn C',
            'So_dien_thoai' => '0912345678',
            'Dia_chi' => 'Hà Nội',
            'Nghe_nghiep' => 'Kinh doanh',
            'Loai_nha_o' => 'Nhà đất',
            'Kinh_nghiem' => 'Đã nuôi nhiều thú cưng',
            'Ly_do_nhan_nuoi' => 'Rất yêu thú cưng',
            'Cam_ket' => true,
            'Trang_thai' => 'approved',
            'interview_slot_id' => $slots[3]->Ma_slot,
            'Ngay_tao' => Carbon::now()->subDays(10),
        ]);
        InterviewSchedule::create([
            'Ma_don' => $app3->Ma_don,
            'Ma_slot' => $slots[3]->Ma_slot,
            'Trang_thai' => 'da_xac_nhan',
            'Ket_qua_phong_van' => 'dat',
            'Nhan_vien_xu_ly' => $admin->Ma_nguoi_dung,
        ]);

        // Đơn 4: Trong quá khứ (slot 3), đã phỏng vấn Vắng mặt
        $app4 = AdoptionApplication::create([
            'Ma_nguoi_dung' => $user->Ma_nguoi_dung,
            'Ma_thu_cung' => $pets[3]->Ma_thu_cung ?? null,
            'Ho_ten' => 'Hoàng Thị D',
            'So_dien_thoai' => '0923456789',
            'Dia_chi' => 'Hà Nội',
            'Nghe_nghiep' => 'Sinh viên',
            'Loai_nha_o' => 'Thuê',
            'Kinh_nghiem' => 'Chưa có',
            'Ly_do_nhan_nuoi' => 'Thích động vật',
            'Cam_ket' => true,
            'Trang_thai' => 'cho_phong_van',
            'interview_slot_id' => $slots[3]->Ma_slot,
            'Ngay_tao' => Carbon::now()->subDays(8),
        ]);
        InterviewSchedule::create([
            'Ma_don' => $app4->Ma_don,
            'Ma_slot' => $slots[3]->Ma_slot,
            'Trang_thai' => 'da_xac_nhan',
            'Ket_qua_phong_van' => 'vang_mat',
            'Nhan_vien_xu_ly' => $admin->Ma_nguoi_dung,
        ]);

        // Đơn 5, 6: Đang chờ phỏng vấn (Chưa có lịch, danh sách chờ)
        AdoptionApplication::create([
            'Ma_nguoi_dung' => $user->Ma_nguoi_dung,
            'Ma_thu_cung' => $pets[4]->Ma_thu_cung ?? null,
            'Ho_ten' => 'Phạm Văn E',
            'So_dien_thoai' => '0934567890',
            'Dia_chi' => 'Hà Nội',
            'Nghe_nghiep' => 'Freelancer',
            'Loai_nha_o' => 'Căn hộ',
            'Kinh_nghiem' => 'Từng nuôi mèo',
            'Ly_do_nhan_nuoi' => 'Muốn tìm bé mèo',
            'Cam_ket' => true,
            'Trang_thai' => 'cho_phong_van',
            'interview_slot_id' => null,
            'Ngay_tao' => Carbon::now()->subDays(1),
        ]);

        AdoptionApplication::create([
            'Ma_nguoi_dung' => $user->Ma_nguoi_dung,
            'Ma_thu_cung' => $pets[0]->Ma_thu_cung ?? null,
            'Ho_ten' => 'Vũ Thị F',
            'So_dien_thoai' => '0945678901',
            'Dia_chi' => 'Hà Nội',
            'Nghe_nghiep' => 'Nhân viên văn phòng',
            'Loai_nha_o' => 'Nhà mặt đất',
            'Kinh_nghiem' => 'Đã nuôi chó',
            'Ly_do_nhan_nuoi' => 'Yêu chó',
            'Cam_ket' => true,
            'Trang_thai' => 'cho_phong_van',
            'interview_slot_id' => null,
            'Ngay_tao' => Carbon::now()->subDays(2),
        ]);
    }
}
