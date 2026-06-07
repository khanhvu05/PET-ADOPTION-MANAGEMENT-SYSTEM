<?php
use App\Models\User;
use App\Models\Pet;
use App\Models\AdoptionApplication;
use App\Models\InterviewSlot;
use App\Models\InterviewSchedule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

echo "=== BẮT ĐẦU TEST LUỒNG NHẬN NUÔI ===\n";

// 1. Tạo user test
$user = User::firstOrCreate(
    ['Email' => 'test_adoption@example.com'],
    [
        'Ho_ten' => 'Người Nhận Nuôi Test',
        'Mat_khau_hash' => Hash::make('password'),
        'Loai_tai_khoan' => 'ca_nhan',
        'Trang_thai' => 'hoat_dong',
        'Ma_nguoi_dung' => Str::uuid()->toString()
    ]
);
echo "1. Đã chuẩn bị User: {$user->Email}\n";

// 2. Tạo một pet test
$pet = Pet::firstOrCreate(
    ['Ma_hien_thi' => 'TEST-001'],
    [
        'Ten' => 'Chó Test',
        'Loai' => 'cho',
        'Trang_thai' => 'san_sang',
        'Giong' => 'Corgi',
        'Ma_thu_cung' => Str::uuid()->toString(),
        'Ngay_tiep_nhan' => now()->toDateString()
    ]
);
$pet->update(['Trang_thai' => 'san_sang']); // Reset trạng thái
echo "2. Đã chuẩn bị Pet: {$pet->Ten} (Trạng thái: {$pet->Trang_thai})\n";

// 3. User tạo đơn nhận nuôi
$app = AdoptionApplication::where('Ma_nguoi_dung', $user->Ma_nguoi_dung)->where('Ma_thu_cung', $pet->Ma_thu_cung)->first();
if (!$app) {
    $app = AdoptionApplication::create([
        'Ma_don' => Str::uuid()->toString(),
        'Ma_nguoi_dung' => $user->Ma_nguoi_dung,
        'Ma_thu_cung' => $pet->Ma_thu_cung,
        'Ho_ten' => $user->Ho_ten,
        'So_dien_thoai' => '0987654321',
        'Dia_chi' => 'Hà Nội',
        'Ly_do_nhan_nuoi' => 'Tôi rất yêu chó và có đủ điều kiện chăm sóc bé.',
        'Cam_ket' => true,
        'Trang_thai' => 'cho_duyet'
    ]);
} else {
    $app->update(['Trang_thai' => 'cho_duyet', 'interview_slot_id' => null]);
}
echo "3. User gửi đơn: Thành công. Trạng thái đơn: {$app->Trang_thai}\n";

// 4. Admin duyệt đơn -> cho_xac_nhan_don
app(\App\Http\Controllers\Admin\AdoptionController::class)->update(
    request()->merge(['Trang_thai' => 'cho_xac_nhan_don', 'Ghi_chu_admin' => 'Duyệt đơn OK']),
    $app->Ma_don
);
$app->refresh();
echo "4. Admin duyệt đơn sơ bộ: Trạng thái đơn: {$app->Trang_thai}\n";

// 5. Tạo 1 slot phỏng vấn
$slot = InterviewSlot::firstOrCreate(
    ['Ngay' => now()->addDays(1)->toDateString(), 'Gio_bat_dau' => '09:00:00'],
    [
        'Ma_slot' => Str::uuid()->toString(),
        'Gio_ket_thuc' => '10:00:00',
        'So_luong_toi_da' => 5,
        'So_luong_hien_tai' => 0,
        'Trang_thai' => 'mo'
    ]
);
echo "5. Đã tạo ca phỏng vấn: {$slot->Ngay} {$slot->Gio_bat_dau}\n";

// 6. User chọn lịch phỏng vấn
Auth::login($user);
app(\App\Http\Controllers\Frontend\UserAdoptionController::class)->scheduleInterview(
    request()->merge(['interview_slot_id' => $slot->Ma_slot]),
    $app->Ma_don
);
$app->refresh();
$pet->refresh();
echo "6. User chọn lịch: Trạng thái đơn: {$app->Trang_thai}. Trạng thái Pet: {$pet->Trang_thai}\n";
Auth::logout();

// 7. Sinh lịch phỏng vấn
$schedule = InterviewSchedule::where('Ma_don', $app->Ma_don)->first();
echo "7. Đã tự động tạo danh sách phỏng vấn. Schedule ID: {$schedule->Ma_lich}\n";

// 8. Admin đánh giá đạt
app(\App\Http\Controllers\Admin\InterviewScheduleController::class)->updateResult(
    request()->merge(['result' => 'dat']),
    $schedule->Ma_lich
);
$app->refresh();
$pet->refresh();
echo "8. Admin đánh giá ĐẠT phỏng vấn. Trạng thái đơn: {$app->Trang_thai}. Trạng thái Pet: {$pet->Trang_thai}\n";

// 9. Admin bàn giao hoàn tất
app(\App\Http\Controllers\Admin\AdoptionController::class)->update(
    request()->merge(['Trang_thai' => 'hoan_thanh', 'Ghi_chu_admin' => 'Đã bàn giao bé']),
    $app->Ma_don
);
$app->refresh();
$pet->refresh();
echo "9. Admin xác nhận bàn giao. Trạng thái đơn: {$app->Trang_thai}. Trạng thái Pet: {$pet->Trang_thai}\n";

echo "=== KẾT THÚC TEST ===\n";
