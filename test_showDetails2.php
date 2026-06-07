<?php
$slot = \App\Models\InterviewSlot::where('Ngay', '2026-06-08')->first();
if($slot) {
    echo "Slot ID: {$slot->Ma_slot}\n";
    try {
        $controller = app(\App\Http\Controllers\Admin\InterviewScheduleController::class);
        $response = $controller->showDetails($slot->Ma_slot);
        echo "Response length: " . strlen($response->getContent()) . "\n";
    } catch (\Throwable $e) {
        echo "ERROR: " . $e->getMessage() . "\n";
        echo $e->getTraceAsString();
    }
} else {
    echo "No slot found for 2026-06-08.\n";
}
