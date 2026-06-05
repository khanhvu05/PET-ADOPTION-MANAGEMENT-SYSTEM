<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AssignAdminRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:assign-admin-role';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assigns Spatie admin role to existing admin users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $admin = \App\Models\User::where('Email', 'admin@petjam.vn')->first();
        if ($admin) {
            $admin->assignRole('admin');
            $this->info('Assigned admin role to: ' . $admin->Email);
        }
        $this->info('Done!');
    }
}
