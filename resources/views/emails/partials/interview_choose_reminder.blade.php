<span class="title-icon">⏰</span>
<h1 class="main-title font-bold text-orange">Chưa xác nhận<br>lịch phỏng vấn!</h1>

<p>Xin chào <strong>{{ $user->name ?? $user->Ho_ten ?? 'bạn' }}</strong>,</p>
<p>Đơn đăng ký nhận nuôi bé <strong>{{ $application->thuCung->Ten ?? 'thú cưng' }}</strong> của bạn đã được duyệt, nhưng bạn <strong>chưa chọn lịch phỏng vấn</strong>.</p>

<div class="pet-card">
    @if($application->thuCung)
        <img src="{{ $application->thuCung->anh_url }}" alt="{{ $application->thuCung->Ten }}" class="pet-avatar">
    @else
        <div class="pet-avatar" style="background-color: #f1f5f9; display: flex; align-items: center; justify-content: center; font-size: 24px;">🐾</div>
    @endif
    <div class="pet-info">
        <h3>{{ $application->thuCung->Ten ?? 'Thú cưng' }}</h3>
        <p>{{ $application->thuCung->Giong ?? 'Chưa cập nhật' }} • {{ $application->thuCung->nhom_tuoi_label ?? '?' }}</p>
    </div>
</div>

<div class="alert-box" style="background-color: #fef2f2; border-color: #fecaca; color: #b91c1c;">
    <div class="alert-icon">⚠️</div>
    <div>
        <strong>Sắp hết hạn!</strong><br>
        Bạn chỉ còn chưa đầy 12 giờ để xác nhận lịch. Hạn chót là: <strong>{{ \Carbon\Carbon::parse($application->han_xac_nhan_phong_van)->format('H:i d/m/Y') }}</strong>.
    </div>
</div>

<p class="text-center" style="font-size: 14px; margin-bottom: 20px;">Vui lòng truy cập hệ thống và chọn lịch trống ngay để không bỏ lỡ cơ hội đón bé nhé!</p>

<a href="{{ route('frontend.user.adoptions.index') }}" class="btn btn-primary">Chọn lịch ngay</a>

<div class="contact-info">
    <p>Nếu bạn gặp khó khăn khi chọn lịch, vui lòng liên hệ:</p>
    <div class="contact-row">
        <span>📞</span> (84) 123 456 789
    </div>
    <div class="contact-row">
        <span>✉️</span> support@petjam.com
    </div>
</div>
