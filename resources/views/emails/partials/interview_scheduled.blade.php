<span class="title-icon">📅</span>
<h1 class="main-title font-bold">Lịch phỏng vấn<br>đã sẵn sàng!</h1>

<p>Xin chào <strong>{{ $user->name ?? $user->Ho_ten ?? 'bạn' }}</strong>,</p>
<p>Đơn nhận nuôi của bạn cho bé <strong>{{ $application->thuCung->Ten ?? 'thú cưng' }}</strong> đã vượt qua vòng xét duyệt hồ sơ. Vui lòng xác nhận lịch phỏng vấn bên dưới.</p>

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

<div class="info-list">
    <div class="info-item">
        <div class="info-icon">📅</div>
        <div class="info-text">
            <strong>Ngày phỏng vấn</strong>
            {{ \Carbon\Carbon::parse($slot->Ngay)->format('d/m/Y') }}
        </div>
    </div>
    <div class="info-item">
        <div class="info-icon">🕒</div>
        <div class="info-text">
            <strong>Thời gian</strong>
            {{ \Carbon\Carbon::parse($slot->Gio_bat_dau)->format('H:i') }} - {{ \Carbon\Carbon::parse($slot->Gio_ket_thuc)->format('H:i') }}
        </div>
    </div>
    <div class="info-item">
        <div class="info-icon">📍</div>
        <div class="info-text">
            <strong>Địa điểm</strong>
            PETJAM Hà Nội<br>123 Đường Cầu Giấy, Hà Nội
        </div>
    </div>
</div>

<div class="alert-box">
    <div class="alert-icon">⚠️</div>
    <div>
        Vui lòng xác nhận lịch hẹn trước 18:00 ngày {{ \Carbon\Carbon::parse($application->han_xac_nhan_phong_van)->format('d/m/Y') }}.
    </div>
</div>

<a href="{{ route('frontend.user.adoptions.index') }}" class="btn btn-primary">Xác nhận lịch phỏng vấn</a>
<a href="{{ route('frontend.user.adoptions.index') }}" class="btn btn-outline">Xem trạng thái hồ sơ</a>

<div class="contact-info">
    <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi qua:</p>
    <div class="contact-row">
        <span>📞</span> (84) 123 456 789
    </div>
    <div class="contact-row">
        <span>✉️</span> support@petjam.com
    </div>
</div>
