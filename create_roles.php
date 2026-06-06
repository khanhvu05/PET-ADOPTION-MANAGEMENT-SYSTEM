<?php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    // Clear all roles and permissions cache
    app()['cache']->forget('spatie.permission.cache');

    // Check if admin role exists
    $adminRole = Role::where('name', 'admin')->first();
    if ($adminRole) {
        echo "Admin role already exists!\n";
    } else {
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        echo "✓ Admin role created\n";
    }

    // Create user role
    $userRole = Role::where('name', 'user')->first();
    if (!$userRole) {
        $userRole = Role::create(['name' => 'user', 'guard_name' => 'web']);
        echo "✓ User role created\n";
    } else {
        echo "User role already exists\n";
    }

    echo "Roles setup complete!\n";
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
    exit(1);
}
