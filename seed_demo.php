<?php
use App\Models\Pet;
use App\Models\RescueCase;
use App\Models\VaccinationHistory;
use Illuminate\Support\Str;

$pet = Pet::first();
if ($pet) {
    // 1. Update pet with full detailed data if empty
    $pet->update([
        'Mau_long' => 'Trắng đốm đen',
        'Tinh_cach' => 'Năng động, thân thiện, quấn người',
        'Thoi_quen' => 'Thích cắn đồ chơi nhựa, đi dạo buổi sáng',
        'Yeu_thich' => 'Thịt bò, xích đu',
        'Thu_vien_anh' => [
            'https://images.unsplash.com/photo-1543466835-00a7907e9de1?w=300&h=300&fit=crop',
            'https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?w=300&h=300&fit=crop'
        ]
    ]);

    // 2. Create Rescue Case
    RescueCase::where('Ma_thu_cung', $pet->Ma_thu_cung)->delete();
    RescueCase::create([
        'Ma_thu_cung' => $pet->Ma_thu_cung,
        'Ngay_cuu_ho' => now()->subMonths(2),
        'Dia_diem_cuu_ho' => 'Khu vực công viên Thống Nhất, phát hiện bị bỏ rơi trong hộp giấy',
        'Loai_cuu_ho' => 'bi_bo_roi',
        'Nguoi_bao_cao' => 'Nguyễn Văn Dân',
        'Chi_phi_cuu_ho' => 1500000,
        'Trang_thai_ca' => 'da_dong',
        'Ghi_chu' => 'Suy dinh dưỡng nặng, viêm da, có ve rận. Rụt rè và sợ hãi con người khi mới tiếp cận.'
    ]);

    // 3. Create Vaccination History
    VaccinationHistory::where('Ma_thu_cung', $pet->Ma_thu_cung)->delete();
    VaccinationHistory::create([
        'Ma_thu_cung' => $pet->Ma_thu_cung,
        'Ten_vac_xin' => 'Vaccine 5 bệnh (Care, Parvo,...)',
        'Ngay_tiem' => now()->subDays(15),
        'Ngay_tiem_nhac_tiep' => now()->addDays(350),
        'Ten_noi_tiem' => 'PetCare Clinic Hà Nội',
        'Chi_phi' => 300000,
    ]);
    VaccinationHistory::create([
        'Ma_thu_cung' => $pet->Ma_thu_cung,
        'Ten_vac_xin' => 'Tẩy giun định kỳ',
        'Ngay_tiem' => now()->subDays(10),
        'Ngay_tiem_nhac_tiep' => now()->addDays(80),
        'Ten_noi_tiem' => 'Phòng khám thú y HappyPet',
        'Chi_phi' => 150000,
    ]);

    echo "Đã thêm dữ liệu mẫu đầy đủ cho thú cưng: " . $pet->Ten . " (Mã: " . $pet->Ma_thu_cung . ")\n";
} else {
    echo "Không tìm thấy thú cưng nào trong DB.\n";
}
