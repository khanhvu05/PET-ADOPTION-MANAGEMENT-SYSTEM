<?php
$schedule = \App\Models\InterviewSchedule::first();
if($schedule) {
    echo "Schedule ID: {$schedule->Ma_lich}\n";
    try {
        $controller = app(\App\Http\Controllers\Admin\InterviewScheduleController::class);
        $request = request()->merge(['result' => 'dat']);
        $response = $controller->updateResult($request, $schedule->Ma_lich);
        echo "Response: " . $response->getContent() . "\n";
    } catch (\Throwable $e) {
        echo "ERROR: " . $e->getMessage() . "\n";
        echo $e->getTraceAsString();
    }
} else {
    echo "No schedule found.\n";
}
