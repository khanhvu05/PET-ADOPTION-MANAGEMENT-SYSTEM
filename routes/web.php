<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\PetController as FrontendPetController;
use App\Http\Controllers\Frontend\AdoptionApplicationController;
use App\Http\Controllers\Frontend\DonationController as FrontendDonationController;
use Illuminate\Support\Facades\Route;

// ── Trang chủ ───────────────────────────────────────────────────────────────
Route::get('/', function () {
    $featuredPets = \App\Models\Pet::where('Noi_bat', 1)
        ->where('Trang_thai', 'san_sang')
        ->latest('Ngay_tao')
        ->take(12)
        ->get();
    return view('welcome', compact('featuredPets'));
})->name('home');

// ── Giao diện người dùng (Frontend) ─────────────────────────────────────────

// Giới thiệu
Route::view('/gioi-thieu', 'frontend.about.index')->name('frontend.about.index');

// Nhận nuôi (không cần auth để xem)
Route::get('/nhan-nuoi', [FrontendPetController::class, 'index'])->name('frontend.adoptions.index');
Route::get('/nhan-nuoi/{id}', [FrontendPetController::class, 'show'])->name('frontend.adoptions.show');

// Ủng hộ
Route::get('/ung-ho', [FrontendDonationController::class, 'index'])->name('frontend.donations.index');
Route::get('/ung-ho/thuc-hien', [FrontendDonationController::class, 'process'])->name('frontend.donations.process');
Route::get('/ung-ho/thuc-hien/{campaignId}', [FrontendDonationController::class, 'process'])->name('frontend.donations.process.campaign');
Route::post('/ung-ho/thuc-hien', [FrontendDonationController::class, 'store'])->name('frontend.donations.store');
Route::get('/ung-ho/thanh-toan/ket-qua', [FrontendDonationController::class, 'vnpayReturn'])->name('frontend.donations.vnpay.return');
Route::any('/ung-ho/vnpay-ipn', [FrontendDonationController::class, 'vnpayIpn'])->name('frontend.donations.vnpay.ipn');

// Gửi đơn nhận nuôi + lịch sử (cần đăng nhập)
Route::middleware(['auth', 'verified'])->group(function () {
    // Gửi đơn nhận nuôi
    Route::get('/nhan-nuoi/{id}/dang-ky', [AdoptionApplicationController::class, 'create'])
        ->name('frontend.adoptions.create');
    Route::post('/nhan-nuoi/{id}/dang-ky', [AdoptionApplicationController::class, 'store'])
        ->name('frontend.adoptions.store');
    Route::patch('/tai-khoan/don-nhan-nuoi/{id}/huy', [AdoptionApplicationController::class, 'cancel'])
        ->name('frontend.adoptions.cancel');

    // Ủng hộ (Đã di chuyển ra ngoài để cho phép khách vãng lai ủng hộ)

    // Profile
    Route::get('/tai-khoan', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/tai-khoan', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/tai-khoan', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Lịch sử nhận nuôi & ủng hộ của user
    Route::get('/tai-khoan/lich-su-nhan-nuoi', [\App\Http\Controllers\Frontend\UserAdoptionController::class, 'index'])
        ->name('frontend.user.adoptions.index');
    Route::post('/tai-khoan/don-nhan-nuoi/{id}/xep-lich', [\App\Http\Controllers\Frontend\UserAdoptionController::class, 'scheduleInterview'])
        ->name('frontend.user.adoptions.schedule-interview');
    Route::get('/tai-khoan/lich-su-ung-ho', [FrontendDonationController::class, 'history'])->name('frontend.user.donations.index');
});

// ── Khu vực Admin ───────────────────────────────────────────────────────────
Route::middleware(['auth', 'verified', 'admin'])->group(function () {

    // Global Search
    Route::get('/quan-tri/tim-kiem', [\App\Http\Controllers\Admin\GlobalSearchController::class, 'search'])->name('admin.search');

    // Notifications
    Route::get('/quan-tri/thong-bao', [\App\Http\Controllers\Admin\NotificationController::class, 'index'])->name('admin.notifications.index');
    Route::post('/quan-tri/thong-bao/{id}/doc', [\App\Http\Controllers\Admin\NotificationController::class, 'markAsRead'])->name('admin.notifications.read');
    Route::post('/quan-tri/thong-bao/doc-tat-ca', [\App\Http\Controllers\Admin\NotificationController::class, 'markAllAsRead'])->name('admin.notifications.readAll');

    // Quản lý gán Role cho User (chỉ dành cho staff management, không dùng cho client)
    // Route này đã được chuyển sang StaffController

    // ── Dashboard ──────────────────────────────────────────────────────────────
    Route::middleware('permission:dashboard.view')->group(function () {
        Route::get('/bang-dieu-khien', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    });

    Route::delete('/quan-tri/vai-tro/{role}', [\App\Http\Controllers\Admin\RolePermissionController::class, 'destroyRole'])->name('admin.roles.destroy');
    Route::post('/quan-tri/vai-tro/{role}/quyen', [\App\Http\Controllers\Admin\RolePermissionController::class, 'updatePermissions'])->name('admin.roles.permissions.update');
    Route::post('/quan-tri/quyen', [\App\Http\Controllers\Admin\RolePermissionController::class, 'storePermission'])->name('admin.permissions.store');
    Route::delete('/quan-tri/quyen/{permission}', [\App\Http\Controllers\Admin\RolePermissionController::class, 'destroyPermission'])->name('admin.permissions.destroy');

    Route::patch('/quan-tri/nguoi-dung/{user}/vai-tro', [\App\Http\Controllers\Admin\UserController::class, 'updateRole'])->name('admin.users.role.update');

    // ── Thú cưng ───────────────────────────────────────────────────────────────
    Route::middleware('permission:pets.view')->group(function () {
        Route::get('quan-tri/thu-cung', [\App\Http\Controllers\Admin\PetController::class, 'index'])->name('admin.pets.index');
    });
    Route::middleware('permission:pets.export')->group(function () {
        Route::get('quan-tri/thu-cung/xuat-excel', [\App\Http\Controllers\Admin\PetController::class, 'export'])->name('admin.pets.export');
    });
    Route::middleware('permission:pets.create')->group(function () {
        Route::get('quan-tri/thu-cung/create', [\App\Http\Controllers\Admin\PetController::class, 'create'])->name('admin.pets.create');
        Route::post('quan-tri/thu-cung', [\App\Http\Controllers\Admin\PetController::class, 'store'])->name('admin.pets.store');
    });
    Route::middleware('permission:pets.view')->group(function () {
        Route::get('quan-tri/thu-cung/{pet}', [\App\Http\Controllers\Admin\PetController::class, 'show'])->name('admin.pets.show');
    });
    Route::middleware('permission:pets.edit')->group(function () {
        Route::get('quan-tri/thu-cung/{pet}/edit', [\App\Http\Controllers\Admin\PetController::class, 'edit'])->name('admin.pets.edit');
        Route::put('quan-tri/thu-cung/{pet}', [\App\Http\Controllers\Admin\PetController::class, 'update'])->name('admin.pets.update');
        Route::patch('quan-tri/thu-cung/{pet}', [\App\Http\Controllers\Admin\PetController::class, 'update']);
    });
    Route::middleware('permission:pets.delete')->group(function () {
        Route::delete('quan-tri/thu-cung/{pet}', [\App\Http\Controllers\Admin\PetController::class, 'destroy'])->name('admin.pets.destroy');
    });
    Route::middleware('permission:pets.notes')->group(function () {
        Route::post('quan-tri/thu-cung/{pet}/ghi-chu', [\App\Http\Controllers\Admin\PetController::class, 'storeNote'])->name('admin.pets.notes.store');
        Route::delete('quan-tri/thu-cung/{pet}/ghi-chu/{note}', [\App\Http\Controllers\Admin\PetController::class, 'destroyNote'])->name('admin.pets.notes.destroy');
    });
    Route::middleware('permission:pets.rescue')->group(function () {
        Route::post('quan-tri/thu-cung/{pet}/ca-cuu-ho', [\App\Http\Controllers\Admin\PetController::class, 'storeRescue'])->name('admin.pets.rescue.store');
        Route::put('quan-tri/thu-cung/{pet}/ca-cuu-ho/{rescue}', [\App\Http\Controllers\Admin\PetController::class, 'updateRescue'])->name('admin.pets.rescue.update');
    });
    Route::middleware('permission:pets.health')->group(function () {
        Route::post('quan-tri/thu-cung/{pet}/suc-khoe', [\App\Http\Controllers\Admin\PetController::class, 'storeHealth'])->name('admin.pets.health.store');
        Route::put('quan-tri/thu-cung/{pet}/suc-khoe/{health}', [\App\Http\Controllers\Admin\PetController::class, 'updateHealth'])->name('admin.pets.health.update');
    });


    // ── Đơn nhận nuôi ──────────────────────────────────────────────────────────
    Route::middleware('permission:adoptions.view')->group(function () {
        Route::get('quan-tri/don-nhan-nuoi', [\App\Http\Controllers\Admin\AdoptionController::class, 'index'])->name('admin.adoptions.index');
    });
    Route::middleware('permission:adoptions.export')->group(function () {
        Route::get('quan-tri/don-nhan-nuoi/xuat-excel', [\App\Http\Controllers\Admin\AdoptionController::class, 'export'])->name('admin.adoptions.export');
    });
    Route::middleware('permission:adoptions.create')->group(function () {
        Route::get('quan-tri/don-nhan-nuoi/create', [\App\Http\Controllers\Admin\AdoptionController::class, 'create'])->name('admin.adoptions.create');
        Route::post('quan-tri/don-nhan-nuoi', [\App\Http\Controllers\Admin\AdoptionController::class, 'store'])->name('admin.adoptions.store');
    });
    Route::middleware('permission:adoptions.view')->group(function () {
        Route::get('quan-tri/don-nhan-nuoi/{adoption}', [\App\Http\Controllers\Admin\AdoptionController::class, 'show'])->name('admin.adoptions.show');
    });
    Route::middleware('permission:adoptions.review|adoptions.complete|adoptions.edit_info|adoptions.add_note')->group(function () {
        Route::get('quan-tri/don-nhan-nuoi/{adoption}/edit', [\App\Http\Controllers\Admin\AdoptionController::class, 'edit'])->name('admin.adoptions.edit');
        Route::put('quan-tri/don-nhan-nuoi/{adoption}', [\App\Http\Controllers\Admin\AdoptionController::class, 'update'])->name('admin.adoptions.update');
        Route::patch('quan-tri/don-nhan-nuoi/{adoption}', [\App\Http\Controllers\Admin\AdoptionController::class, 'update']);
    });
    Route::middleware('permission:adoptions.delete')->group(function () {
        Route::delete('quan-tri/don-nhan-nuoi/{adoption}', [\App\Http\Controllers\Admin\AdoptionController::class, 'destroy'])->name('admin.adoptions.destroy');
    });

    // ── Lịch phỏng vấn ─────────────────────────────────────────────────────────
    Route::middleware('permission:interviews.view')->group(function () {
        Route::get('quan-tri/lich-phong-van/{id}/details', [\App\Http\Controllers\Admin\InterviewScheduleController::class, 'showDetails'])->name('admin.interview_schedules.details');
        Route::get('quan-tri/lich-phong-van', [\App\Http\Controllers\Admin\InterviewScheduleController::class, 'index'])->name('admin.interview_schedules.index');
    });
    Route::middleware('permission:interviews.create')->group(function () {
        Route::post('quan-tri/lich-phong-van', [\App\Http\Controllers\Admin\InterviewScheduleController::class, 'store'])->name('admin.interview_schedules.store');
    });
    Route::middleware('permission:interviews.delete')->group(function () {
        Route::delete('quan-tri/lich-phong-van/{interview_schedule}', [\App\Http\Controllers\Admin\InterviewScheduleController::class, 'destroy'])->name('admin.interview_schedules.destroy');
        Route::put('quan-tri/lich-phong-van/{id}/an', [\App\Http\Controllers\Admin\InterviewScheduleController::class, 'hide'])->name('admin.interview_schedules.hide');
    });
    Route::middleware('permission:interviews.update_result')->group(function () {
        Route::put('quan-tri/lich-phong-van/update-result/{schedule_id}', [\App\Http\Controllers\Admin\InterviewScheduleController::class, 'updateResult'])->name('admin.interview_schedules.update_result');
    });
    Route::middleware('permission:interviews.assign')->group(function () {
        Route::post('quan-tri/lich-phong-van/{id}/add-application', [\App\Http\Controllers\Admin\InterviewScheduleController::class, 'addApplication'])->name('admin.interview_schedules.add_application');
    });

    // ── Chiến dịch ủng hộ ──────────────────────────────────────────────────────
    Route::middleware('permission:campaigns.view')->group(function () {
        Route::get('quan-tri/chien-dich-ung-ho', [\App\Http\Controllers\Admin\DonationCampaignController::class, 'index'])->name('admin.donation_campaigns.index');
    });
    Route::middleware('permission:campaigns.create')->group(function () {
        Route::get('quan-tri/chien-dich-ung-ho/create', [\App\Http\Controllers\Admin\DonationCampaignController::class, 'create'])->name('admin.donation_campaigns.create');
        Route::post('quan-tri/chien-dich-ung-ho', [\App\Http\Controllers\Admin\DonationCampaignController::class, 'store'])->name('admin.donation_campaigns.store');
    });
    Route::middleware('permission:campaigns.view')->group(function () {
        Route::get('quan-tri/chien-dich-ung-ho/{donation_campaign}', [\App\Http\Controllers\Admin\DonationCampaignController::class, 'show'])->name('admin.donation_campaigns.show');
    });
    Route::middleware('permission:campaigns.edit')->group(function () {
        Route::get('quan-tri/chien-dich-ung-ho/{donation_campaign}/edit', [\App\Http\Controllers\Admin\DonationCampaignController::class, 'edit'])->name('admin.donation_campaigns.edit');
        Route::put('quan-tri/chien-dich-ung-ho/{donation_campaign}', [\App\Http\Controllers\Admin\DonationCampaignController::class, 'update'])->name('admin.donation_campaigns.update');
        Route::patch('quan-tri/chien-dich-ung-ho/{donation_campaign}', [\App\Http\Controllers\Admin\DonationCampaignController::class, 'update']);
    });
    Route::middleware('permission:campaigns.close')->group(function () {
        Route::put('quan-tri/chien-dich-ung-ho/{id}/dong', [\App\Http\Controllers\Admin\DonationCampaignController::class, 'close'])->name('admin.donation_campaigns.close');
    });
    Route::middleware('permission:campaigns.export')->group(function () {
        Route::delete('quan-tri/chien-dich-ung-ho/{donation_campaign}', [\App\Http\Controllers\Admin\DonationCampaignController::class, 'destroy'])->name('admin.donation_campaigns.destroy');
    });

    // ── Donations ──────────────────────────────────────────────────────────────
    Route::middleware('permission:donations.view')->group(function () {
        Route::get('quan-tri/ung-ho', [\App\Http\Controllers\Admin\DonationController::class, 'index'])->name('admin.donations.index');
    });
    Route::middleware('permission:donations.statistics')->group(function () {
        Route::get('quan-tri/ung-ho/thong-ke', [\App\Http\Controllers\Admin\DonationController::class, 'statistics'])->name('admin.donations.statistics');
    });
    Route::middleware('permission:donations.view')->group(function () {
        Route::get('quan-tri/ung-ho/{donation}', [\App\Http\Controllers\Admin\DonationController::class, 'show'])->name('admin.donations.show');
    });

    // ── Khách hàng ─────────────────────────────────────────────────────────────
    Route::middleware('permission:clients.view')->group(function () {
        Route::get('quan-tri/khach-hang', [\App\Http\Controllers\Admin\ClientController::class, 'index'])->name('admin.clients.index');
    });
    Route::middleware('permission:clients.toggle_status')->group(function () {
        Route::patch('quan-tri/khach-hang/{user}/trang-thai', [\App\Http\Controllers\Admin\ClientController::class, 'toggleStatus'])->name('admin.clients.toggle_status');
    });
    Route::middleware('permission:clients.export')->group(function () {
        Route::get('quan-tri/khach-hang/xuat-excel', [\App\Http\Controllers\Admin\ClientController::class, 'export'])->name('admin.clients.export');
    });

    // ── Nhân viên ──────────────────────────────────────────────────────────────
    Route::middleware('permission:staff.view')->group(function () {
        Route::get('quan-tri/nhan-vien', [\App\Http\Controllers\Admin\StaffController::class, 'index'])->name('admin.staff.index');
    });
    Route::middleware('permission:staff.create')->group(function () {
        Route::get('quan-tri/nhan-vien/create', [\App\Http\Controllers\Admin\StaffController::class, 'create'])->name('admin.staff.create');
        Route::post('quan-tri/nhan-vien', [\App\Http\Controllers\Admin\StaffController::class, 'store'])->name('admin.staff.store');
    });
    // Custom roles (chỉ admin)
    Route::post('quan-tri/nhan-vien/vai-tro-tuy-chinh', [\App\Http\Controllers\Admin\StaffController::class, 'storeCustomRole'])->name('admin.staff.custom_role.store');
    Route::put('quan-tri/nhan-vien/vai-tro-tuy-chinh/{role}', [\App\Http\Controllers\Admin\StaffController::class, 'updateCustomRole'])->name('admin.staff.custom_role.update');
    Route::delete('quan-tri/nhan-vien/vai-tro-tuy-chinh/{role}', [\App\Http\Controllers\Admin\StaffController::class, 'destroyCustomRole'])->name('admin.staff.custom_role.destroy');

    Route::middleware('permission:staff.view')->group(function () {
        Route::get('quan-tri/nhan-vien/{staff}', [\App\Http\Controllers\Admin\StaffController::class, 'show'])->name('admin.staff.show');
    });
    Route::middleware('permission:staff.edit')->group(function () {
        Route::get('quan-tri/nhan-vien/{staff}/edit', [\App\Http\Controllers\Admin\StaffController::class, 'edit'])->name('admin.staff.edit');
        Route::put('quan-tri/nhan-vien/{staff}', [\App\Http\Controllers\Admin\StaffController::class, 'update'])->name('admin.staff.update');
        Route::patch('quan-tri/nhan-vien/{staff}', [\App\Http\Controllers\Admin\StaffController::class, 'update']);
    });
    Route::middleware('permission:staff.toggle_status')->group(function () {
        Route::patch('quan-tri/nhan-vien/{staff}/trang-thai', [\App\Http\Controllers\Admin\StaffController::class, 'toggleStatus'])->name('admin.staff.toggle_status');
    });

    // Bài đăng / Tin tức
    Route::resource('quan-tri/bai-dang', \App\Http\Controllers\Admin\PostController::class)->names('admin.posts')->parameters(['bai-dang' => 'post']);

    // ── Người dùng (legacy - giữ lại để backward compat) ───────────────────────

    // Tài khoản Admin
    Route::get('quan-tri/tai-khoan', [\App\Http\Controllers\Admin\AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('quan-tri/tai-khoan', [\App\Http\Controllers\Admin\AdminProfileController::class, 'update'])->name('admin.profile.update');

    // Cài đặt
    Route::post('quan-tri/cai-dat/thong-tin-chung', [\App\Http\Controllers\Admin\SettingController::class, 'storeGeneral'])->name('admin.settings.storeGeneral');
    Route::resource('quan-tri/cai-dat', \App\Http\Controllers\Admin\SettingController::class)->names('admin.settings')->parameters(['cai-dat' => 'setting']);

    // Cấu hình Chatbox AI (Admin)
    Route::post('quan-tri/chatbox/cai-dat/gioi-han', [\App\Http\Controllers\ChatboxController::class, 'updateLimit'])->name('admin.chatbox.limit.update');
    Route::post('quan-tri/chatbox/cai-dat/keys', [\App\Http\Controllers\ChatboxController::class, 'addKey'])->name('admin.chatbox.keys.add');
    Route::delete('quan-tri/chatbox/cai-dat/keys', [\App\Http\Controllers\ChatboxController::class, 'deleteKey'])->name('admin.chatbox.keys.delete');
});

// API Chatbox Message (Authenticated Users)
Route::post('/chatbox/message', [\App\Http\Controllers\ChatboxController::class, 'sendMessage'])
    ->middleware('auth')
    ->name('chatbox.message');

require __DIR__.'/auth.php';
