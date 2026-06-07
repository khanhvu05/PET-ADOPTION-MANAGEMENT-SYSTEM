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

        // Generate random vaccinations for 70% of the random pets
        $randomPetIds = cache()->get('random_pet_ids', []);
        $faker = \Faker\Factory::create('vi_VN');
        $vacOptions = ['Vắc-xin dại', 'Vắc-xin combo 5 bệnh (chó)', 'Vắc-xin combo 7 bệnh (chó)', 'Vắc-xin dại (mèo)', 'Vắc-xin combo 3 bệnh (mèo)'];
        $noiTiemOptions = ['Phòng khám thú y PetCare', 'Bệnh viện thú y Hà Nội', 'Trạm thú y phường'];

        $randomVaccinatedPets = [];

        foreach ($randomPetIds as $petId) {
            if ($faker->boolean(70)) {
                $numVacs = $faker->numberBetween(1, 3);
                $petTotalChiPhi = 0;

                for ($i = 0; $i < $numVacs; $i++) {
                    $chiPhi = $faker->numberBetween(1, 4) * 50000;
                    $petTotalChiPhi += $chiPhi;
                    $ngayTiem = $faker->dateTimeBetween('-6 months', 'now');
                    $ngayTiemNhacTiep = (clone $ngayTiem)->modify('+1 year');

                    $vac = [
                        'Ma_lan_tiem'         => Str::uuid()->toString(),
                        'Ma_thu_cung'         => $petId,
                        'Ten_vac_xin'         => $faker->randomElement($vacOptions),
                        'Ngay_tiem'           => $ngayTiem->format('Y-m-d'),
                        'Ngay_tiem_nhac_tiep' => $ngayTiemNhacTiep->format('Y-m-d'),
                        'Nguoi_thuc_hien'     => $adminId,
                        'Ten_noi_tiem'        => $faker->randomElement($noiTiemOptions),
                        'Chi_phi'             => $chiPhi,
                    ];

                    DB::table('vaccination_history')->insert($vac);
                }

                DB::table('pets')
                    ->where('Ma_thu_cung', $petId)
                    ->increment('Phi_nhan_nuoi', $petTotalChiPhi);
                    
                $randomVaccinatedPets[$petId] = true;
            }
        }

        foreach (array_keys($randomVaccinatedPets) as $petId) {
            DB::table('pets')
                ->where('Ma_thu_cung', $petId)
                ->update(['Da_tiem_phong' => true]);
        }

        $this->command->info('✅ VaccinationHistorySeeder hoàn thành: Lịch tiêm cố định + ngẫu nhiên.');
    }
}
