<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

use Illuminate\Support\Facades\Schedule;

Schedule::command('adoptions:remind-unconfirmed')->everyFifteenMinutes();
Schedule::command('adoptions:cancel-expired')->everyFifteenMinutes();
Schedule::command('campaigns:close-expired')->daily();

// Tự động kiểm tra nhắc nhở/hủy lịch phỏng vấn (Chạy mỗi 15 phút)
Schedule::command('app:check-interview-deadlines')->everyFifteenMinutes();
