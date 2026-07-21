<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$perms = Spatie\Permission\Models\Permission::all();
foreach($perms as $p) {
    echo $p->name . " (guard: " . $p->guard_name . ")\n";
}
