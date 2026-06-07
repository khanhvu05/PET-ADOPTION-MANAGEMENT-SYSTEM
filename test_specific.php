<?php
$app = \App\Models\AdoptionApplication::where('Ho_ten', 'nguyễn hoàng phúc')->first();
if($app) {
    echo "App ID: {$app->Ma_don}\n";
    $schedule = \App\Models\InterviewSchedule::where('Ma_don', $app->Ma_don)->first();
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
} else {
    echo "No app found.\n";
}
