<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VaccinationHistorySeeder extends Seeder
{
    public function run(): void
    {
        $adminId = cache()->get('admin_id');
        $petIds  = cache()->get('pet_ids');

        $vaccinations = [
            // Bông (PET-001) - 2 mũi
            [
                'Ma_lan_tiem'         => Str::uuid()->toString(),
                'Ma_thu_cung'         => $petIds['PET-001'],
                'Ten_vac_xin'         => 'Vắc-xin dại',
                'Ngay_tiem'           => '2026-04-15',
                'Ngay_tiem_nhac_tiep' => '2027-04-15',
                'Nguoi_thuc_hien'     => $adminId,
                'Ten_noi_tiem'        => 'Phòng khám thú y PetCare',
                'Chi_phi'             => 150000,
            ],
            [
                'Ma_lan_tiem'         => Str::uuid()->toString(),
                'Ma_thu_cung'         => $petIds['PET-001'],
                'Ten_vac_xin'         => 'Vắc-xin combo 5 bệnh (chó)',
                'Ngay_tiem'           => '2026-04-15',
                'Ngay_tiem_nhac_tiep' => '2027-04-15',
                'Nguoi_thuc_hien'     => $adminId,
                'Ten_noi_tiem'        => 'Phòng khám thú y PetCare',
                'Chi_phi'             => 200000,
            ],
            // Corgi Cam (PET-002) - 2 mũi
            [
                'Ma_lan_tiem'         => Str::uuid()->toString(),
                'Ma_thu_cung'         => $petIds['PET-002'],
                'Ten_vac_xin'         => 'Vắc-xin dại',
                'Ngay_tiem'           => '2026-03-25',
                'Ngay_tiem_nhac_tiep' => '2027-03-25',
                'Nguoi_thuc_hien'     => $adminId,
                'Ten_noi_tiem'        => 'Bệnh viện thú y Hà Nội',
                'Chi_phi'             => 150000,
            ],
            [
                'Ma_lan_tiem'         => Str::uuid()->toString(),
                'Ma_thu_cung'         => $petIds['PET-002'],
                'Ten_vac_xin'         => 'Vắc-xin combo 7 bệnh (chó)',
                'Ngay_tiem'           => '2026-03-25',
                'Ngay_tiem_nhac_tiep' => '2027-03-25',
                'Nguoi_thuc_hien'     => $adminId,
                'Ten_noi_tiem'        => 'Bệnh viện thú y Hà Nội',
                'Chi_phi'             => 250000,
            ],
            // Miu (PET-006) - 2 mũi
            [
                'Ma_lan_tiem'         => Str::uuid()->toString(),
                'Ma_thu_cung'         => $petIds['PET-006'],
                'Ten_vac_xin'         => 'Vắc-xin dại (mèo)',
                'Ngay_tiem'           => '2026-03-10',
                'Ngay_tiem_nhac_tiep' => '2027-03-10',
                'Nguoi_thuc_hien'     => $adminId,
                'Ten_noi_tiem'        => 'Phòng khám thú y PetCare',
                'Chi_phi'             => 120000,
            ],
            [
                'Ma_lan_tiem'         => Str::uuid()->toString(),
                'Ma_thu_cung'         => $petIds['PET-006'],
                'Ten_vac_xin'         => 'Vắc-xin combo 3 bệnh (mèo)',
                'Ngay_tiem'           => '2026-03-10',
                'Ngay_tiem_nhac_tiep' => '2027-03-10',
                'Nguoi_thuc_hien'     => $adminId,
                'Ten_noi_tiem'        => 'Phòng khám thú y PetCare',
                'Chi_phi'             => 180000,
            ],
            // Golden Boy (PET-005) - 1 mũi
            [
                'Ma_lan_tiem'         => Str::uuid()->toString(),
                'Ma_thu_cung'         => $petIds['PET-005'],
                'Ten_vac_xin'         => 'Vắc-xin dại',
                'Ngay_tiem'           => '2026-01-20',
                'Ngay_tiem_nhac_tiep' => '2027-01-20',
                'Nguoi_thuc_hien'     => $adminId,
                'Ten_noi_tiem'        => 'Bệnh viện thú y Hà Nội',
                'Chi_phi'             => 150000,
            ],
            // Maine Khổng Lồ (PET-008) - 1 mũi
            [
                'Ma_lan_tiem'         => Str::uuid()->toString(),
                'Ma_thu_cung'         => $petIds['PET-008'],
                'Ten_vac_xin'         => 'Vắc-xin combo 3 bệnh (mèo)',
                'Ngay_tiem'           => '2026-02-15',
                'Ngay_tiem_nhac_tiep' => '2027-02-15',
                'Nguoi_thuc_hien'     => $adminId,
                'Ten_noi_tiem'        => 'Phòng khám thú y PetCare',
                'Chi_phi'             => 180000,
            ],
        ];

        // Theo dõi pets đã tiêm để cập nhật Da_tiem_phong
        $vaccinatedPets = [];

        foreach ($vaccinations as $vac) {
            DB::table('vaccination_history')->insert($vac);

            // Cộng chi phí vào Phi_nhan_nuoi
            DB::table('pets')
                ->where('Ma_thu_cung', $vac['Ma_thu_cung'])
                ->increment('Phi_nhan_nuoi', $vac['Chi_phi']);

            $vaccinatedPets[$vac['Ma_thu_cung']] = true;
        }

        // Cập nhật Da_tiem_phong = TRUE cho các pet đã tiêm
        foreach (array_keys($vaccinatedPets) as $petId) {
            DB::table('pets')
                ->where('Ma_thu_cung', $petId)
                ->update(['Da_tiem_phong' => true]);
        }

        $this->command->info('✅ VaccinationHistorySeeder hoàn thành: 8 lịch tiêm, 5 thú cưng được cập nhật Da_tiem_phong.');
    }
}
