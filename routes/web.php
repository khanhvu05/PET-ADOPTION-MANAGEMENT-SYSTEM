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

    // Dashboard
    Route::get('/bang-dieu-khien', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Quản lý Phân Quyền (Roles & Permissions)
    Route::get('/quan-tri/vai-tro', [\App\Http\Controllers\Admin\RolePermissionController::class, 'index'])->name('admin.roles.index');
    Route::post('/quan-tri/vai-tro', [\App\Http\Controllers\Admin\RolePermissionController::class, 'storeRole'])->name('admin.roles.store');
    Route::delete('/quan-tri/vai-tro/{role}', [\App\Http\Controllers\Admin\RolePermissionController::class, 'destroyRole'])->name('admin.roles.destroy');
    Route::post('/quan-tri/vai-tro/{role}/quyen', [\App\Http\Controllers\Admin\RolePermissionController::class, 'updatePermissions'])->name('admin.roles.permissions.update');
    Route::post('/quan-tri/quyen', [\App\Http\Controllers\Admin\RolePermissionController::class, 'storePermission'])->name('admin.permissions.store');
    Route::delete('/quan-tri/quyen/{permission}', [\App\Http\Controllers\Admin\RolePermissionController::class, 'destroyPermission'])->name('admin.permissions.destroy');

    // Quản lý gán Role cho User
    Route::patch('/quan-tri/nguoi-dung/{user}/vai-tro', [\App\Http\Controllers\Admin\UserController::class, 'updateRole'])->name('admin.users.role.update');

    // Thú cưng (full CRUD)
    Route::resource('quan-tri/thu-cung', \App\Http\Controllers\Admin\PetController::class)->names('admin.pets')->parameters(['thu-cung' => 'pet']);

    // Đơn nhận nuôi (full CRUD + update status)
    Route::resource('quan-tri/don-nhan-nuoi', \App\Http\Controllers\Admin\AdoptionController::class)->names('admin.adoptions')->parameters(['don-nhan-nuoi' => 'adoption']);

    // Lịch phỏng vấn
    Route::put('quan-tri/lich-phong-van/{id}/an', [\App\Http\Controllers\Admin\InterviewScheduleController::class, 'hide'])->name('admin.interview_schedules.hide');
    Route::resource('quan-tri/lich-phong-van', \App\Http\Controllers\Admin\InterviewScheduleController::class)->names('admin.interview_schedules')->parameters(['lich-phong-van' => 'interview_schedule']);

    // Chiến dịch ủng hộ
    Route::put('quan-tri/chien-dich-ung-ho/{id}/dong', [\App\Http\Controllers\Admin\DonationCampaignController::class, 'close'])->name('admin.donation_campaigns.close');
    Route::resource('quan-tri/chien-dich-ung-ho', \App\Http\Controllers\Admin\DonationCampaignController::class)->names('admin.donation_campaigns')->parameters(['chien-dich-ung-ho' => 'donation_campaign']);

    // Donations
    Route::resource('quan-tri/ung-ho', \App\Http\Controllers\Admin\DonationController::class)->names('admin.donations')->parameters(['ung-ho' => 'donation'])->only(['index', 'show']);

    // Bài đăng / Tin tức
    Route::resource('quan-tri/bai-dang', \App\Http\Controllers\Admin\PostController::class)->names('admin.posts')->parameters(['bai-dang' => 'post']);

    // Người dùng
    Route::resource('quan-tri/nguoi-dung', \App\Http\Controllers\Admin\UserController::class)->names('admin.users')->parameters(['nguoi-dung' => 'user']);

    // Cài đặt
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
