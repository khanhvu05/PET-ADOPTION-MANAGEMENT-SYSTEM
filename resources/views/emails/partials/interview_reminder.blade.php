<span class="title-icon">🔔</span>
<h1 class="main-title font-bold">Sắp đến lịch<br>phỏng vấn của bạn!</h1>

<p>Xin chào <strong>{{ $user->name ?? $user->Ho_ten ?? 'bạn' }}</strong>,</p>
<p>Đây là email nhắc nhở về lịch phỏng vấn nhận nuôi bé <strong>{{ $application->thuCung->Ten ?? 'thú cưng' }}</strong>.</p>

<div class="pet-card">
    @if($application->thuCung && $application->thuCung->Anh_dai_dien)
        <img src="{{ url($application->thuCung->Anh_dai_dien) }}" alt="{{ $application->thuCung->Ten }}" class="pet-avatar">
    @else
        <div class="pet-avatar" style="background-color: #f1f5f9; display: flex; align-items: center; justify-content: center; font-size: 24px;">🐾</div>
    @endif
    <div class="pet-info">
        <h3>{{ $application->thuCung->Ten ?? 'Thú cưng' }}</h3>
        <p>{{ $application->thuCung->giongLoai->Ten_giong ?? 'Chưa cập nhật' }} • {{ $application->thuCung->Tuoi ?? '?' }} tháng tuổi</p>
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

<div class="alert-box" style="background-color: #fff7ed; border-color: #ffedd5;">
    <div class="alert-icon">⏳</div>
    <div>
        <strong>Còn chưa đầy 24 giờ nữa</strong><br>
        đến lịch phỏng vấn của bạn.
    </div>
</div>

<div class="alert-box success">
    <div class="alert-icon">💡</div>
    <div>
        <strong>Lưu ý quan trọng</strong><br>
        Nếu bạn không thể tham gia, vui lòng hủy hoặc đổi lịch trước ít nhất 12 giờ để chúng tôi có thể sắp xếp lại.
    </div>
</div>

<a href="{{ route('frontend.user.adoptions.index') }}" class="btn btn-primary">Xem chi tiết lịch hẹn</a>
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
