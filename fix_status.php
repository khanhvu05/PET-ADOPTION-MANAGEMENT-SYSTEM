<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$pets = \App\Models\Pet::all();
$fixed = 0;
foreach ($pets as $pet) {
    // Check if this pet has ANY approved applications
    $approvedApps = \App\Models\AdoptionApplication::where('Ma_thu_cung', $pet->Ma_thu_cung)
        ->whereIn('Trang_thai', ['da_duyet', 'hoan_thanh', 'approved', 'completed'])
        ->count();
        
    if ($approvedApps == 0 && $pet->Trang_thai == 'da_nhan_nuoi') {
        $pet->Trang_thai = 'san_sang';
        $pet->save();
        $fixed++;
        echo "Fixed pet {$pet->Ten_thu_cung}\n";
    }
}
echo "Total fixed: {$fixed}\n";
