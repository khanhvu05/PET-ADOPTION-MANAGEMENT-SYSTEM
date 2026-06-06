<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InterviewSlotsSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = cache()->get('admin_id');

        // Tạo 5 slot trong 2 tuần tới
        $baseDate = now()->addDays(3)->startOfDay();

        $slots = [
            [
                'Ma_slot'          => Str::uuid()->toString(),
                'Ngay'             => $baseDate->copy()->format('Y-m-d'),
                'Gio_bat_dau'      => '09:00:00',
                'Gio_ket_thuc'     => '10:00:00',
                'So_luong_toi_da'  => 2,
                'So_luong_hien_tai' => 0,
                'Nhan_vien_xu_ly'  => $adminId,
                'Trang_thai'       => 'mo',
            ],
            [
                'Ma_slot'          => Str::uuid()->toString(),
                'Ngay'             => $baseDate->copy()->addDays(2)->format('Y-m-d'),
                'Gio_bat_dau'      => '14:00:00',
                'Gio_ket_thuc'     => '15:00:00',
                'So_luong_toi_da'  => 2,
                'So_luong_hien_tai' => 0,
                'Nhan_vien_xu_ly'  => $adminId,
                'Trang_thai'       => 'mo',
            ],
            [
                'Ma_slot'          => Str::uuid()->toString(),
                'Ngay'             => $baseDate->copy()->addDays(5)->format('Y-m-d'),
                'Gio_bat_dau'      => '10:00:00',
                'Gio_ket_thuc'     => '11:00:00',
                'So_luong_toi_da'  => 2,
                'So_luong_hien_tai' => 0,
                'Nhan_vien_xu_ly'  => $adminId,
                'Trang_thai'       => 'mo',
            ],
            [
                'Ma_slot'          => Str::uuid()->toString(),
                'Ngay'             => $baseDate->copy()->addDays(7)->format('Y-m-d'),
                'Gio_bat_dau'      => '15:00:00',
                'Gio_ket_thuc'     => '16:00:00',
                'So_luong_toi_da'  => 2,
                'So_luong_hien_tai' => 0,
                'Nhan_vien_xu_ly'  => $adminId,
                'Trang_thai'       => 'mo',
            ],
            [
                'Ma_slot'          => Str::uuid()->toString(),
                'Ngay'             => $baseDate->copy()->addDays(10)->format('Y-m-d'),
                'Gio_bat_dau'      => '09:00:00',
                'Gio_ket_thuc'     => '10:00:00',
                'So_luong_toi_da'  => 2,
                'So_luong_hien_tai' => 0,
                'Nhan_vien_xu_ly'  => $adminId,
                'Trang_thai'       => 'mo',
            ],
        ];

        $slotIds = [];
        foreach ($slots as $slot) {
            $slot['Ngay_tao'] = now();
            DB::table('interview_slots')->insert($slot);
            $slotIds[] = $slot['Ma_slot'];
        }

        cache()->put('slot_ids', $slotIds, 600);

        $this->command->info('✅ InterviewSlotsSeeder hoàn thành: 5 slot lịch phỏng vấn.');
    }
}
