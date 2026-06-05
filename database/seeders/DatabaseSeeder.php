<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Thứ tự gọi theo phụ thuộc dữ liệu:
     *   1. Roles & Permissions   (không phụ thuộc)
     *   2. Users                 (phụ thuộc roles)
     *   3. Pets                  (phụ thuộc users)
     *   4. Rescue Cases          (phụ thuộc pets, users)
     *   5. Vaccination History   (phụ thuộc pets, users)
     *   6. Donation Campaigns    (không phụ thuộc)
     *   7. Donations             (phụ thuộc users, campaigns)
     *   8. Interview Slots       (phụ thuộc users)
     *   9. Adoption Applications (phụ thuộc users, pets, slots)
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            UsersSeeder::class,
            PetsSeeder::class,
            RescueCasesSeeder::class,
            VaccinationHistorySeeder::class,
            DonationCampaignsSeeder::class,
            DonationsSeeder::class,
            InterviewSlotsSeeder::class,
            AdoptionApplicationsSeeder::class,
        ]);
    }
}
