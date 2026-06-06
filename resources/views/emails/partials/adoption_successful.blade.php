<span class="title-icon">🎉</span>
<h1 class="main-title font-bold text-orange">Chúc mừng!<br><span style="color: #0f172a; font-size: 20px;">Bạn đã được duyệt nhận nuôi {{ $application->thuCung->Ten ?? 'thú cưng' }}</span></h1>

<div class="pet-card-large">
    @if($application->thuCung && $application->thuCung->Anh_dai_dien)
        <img src="{{ url($application->thuCung->Anh_dai_dien) }}" alt="{{ $application->thuCung->Ten }}" class="pet-photo">
    @else
        <div class="pet-photo" style="background-color: #f1f5f9; display: flex; align-items: center; justify-content: center; font-size: 48px;">🐾</div>
    @endif
</div>

<p>Xin chào <strong>{{ $user->name ?? $user->Ho_ten ?? 'bạn' }}</strong>,</p>
<p>PETJAM rất vui khi thông báo rằng hồ sơ nhận nuôi của bạn đã được phê duyệt chính thức!</p>

<div class="info-list" style="background-color: #f8fafc; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0; margin-top: 20px;">
    <h3 style="margin-top: 0; font-size: 16px; color: #0f172a; margin-bottom: 15px;">Thông tin bàn giao</h3>
    <div class="info-item">
        <div class="info-icon">🐾</div>
        <div class="info-text">
            <strong>Thú cưng:</strong>
            {{ $application->thuCung->Ten ?? 'Thú cưng' }} • {{ $application->thuCung->giongLoai->Ten_giong ?? 'Chưa cập nhật' }}
        </div>
    </div>
    <div class="info-item">
        <div class="info-icon">📅</div>
        <div class="info-text">
            <strong>Mã hồ sơ:</strong>
            ADP-{{ date('Y') }}-{{ str_pad($application->Ma_don, 4, '0', STR_PAD_LEFT) }}
        </div>
    </div>
    <div class="info-item">
        <div class="info-icon">📍</div>
        <div class="info-text">
            <strong>Địa điểm đón bé:</strong>
            PETJAM Hà Nội<br>123 Đường Cầu Giấy, Hà Nội
        </div>
    </div>
</div>

<div class="alert-box success">
    <div class="alert-icon">💚</div>
    <div>
        Chúng tôi sẽ liên hệ với bạn để xác nhận thời gian bàn giao cụ thể và hướng dẫn chi tiết.
    </div>
</div>

<a href="{{ route('frontend.user.adoptions.index') }}" class="btn btn-primary">Xem hướng dẫn bàn giao</a>
<a href="{{ route('frontend.user.adoptions.index') }}" class="btn btn-outline">Theo dõi hồ sơ của tôi</a>

<div class="contact-info">
    <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi qua:</p>
    <div class="contact-row">
        <span>📞</span> (84) 123 456 789
    </div>
    <div class="contact-row">
        <span>✉️</span> support@petjam.com
    </div>
</div>
