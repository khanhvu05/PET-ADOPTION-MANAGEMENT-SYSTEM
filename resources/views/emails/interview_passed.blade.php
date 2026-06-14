@extends('emails.template', ['subject' => 'Chúc Mừng Nhận Nuôi Thành Công PetJam'])

@section('content')
<span class="title-icon">🎉</span>
<h1 class="main-title font-bold text-orange">Chúc Mừng!<br><span style="color: #0f172a; font-size: 20px;">Bạn đã vượt qua phỏng vấn nhận nuôi bé {{ $application->thuCung->Ten ?? 'thú cưng' }}</span></h1>

<div class="pet-card-large">
    @if($application->thuCung && $application->thuCung->anh_url)
        <img src="{{ $application->thuCung->anh_url }}" alt="{{ $application->thuCung->Ten }}" class="pet-photo">
    @else
        <div class="pet-photo" style="background-color: #f1f5f9; display: flex; align-items: center; justify-content: center; font-size: 48px;">🐾</div>
    @endif
</div>

<p>Xin chào <strong>{{ $application->Ho_ten ?? 'bạn' }}</strong>,</p>
<p>Đội ngũ PETJAM vô cùng vui mừng thông báo bạn đã xuất sắc vượt qua buổi phỏng vấn. Hồ sơ nhận nuôi bé <strong>{{ $application->thuCung->Ten ?? 'thú cưng' }}</strong> của bạn đã chính thức được duyệt!</p>
<p>Bé đang rất háo hức chờ bạn đến đón về nhà mới!</p>

<div class="info-list" style="background-color: #f8fafc; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0; margin-top: 20px;">
    <h3 style="margin-top: 0; font-size: 16px; color: #0f172a; margin-bottom: 15px;">Hướng dẫn nhận bé</h3>
    <div class="info-item">
        <div class="info-icon">📍</div>
        <div class="info-text">
            <strong>Địa chỉ trạm PETJAM:</strong>
            Số 1, Đại Cồ Việt, Hai Bà Trưng, Hà Nội
        </div>
    </div>
    <div class="info-item">
        <div class="info-icon">📅</div>
        <div class="info-text">
            <strong>Thời hạn:</strong>
            Trong vòng 1 tuần kể từ ngày nhận email này
        </div>
    </div>
    <div class="info-item">
        <div class="info-icon">👜</div>
        <div class="info-text">
            <strong>Lưu ý khi đến:</strong>
            Hãy mang theo CMND/CCCD và lồng/túi vận chuyển thú cưng.
        </div>
    </div>
</div>

<div class="contact-info">
    <p>Nếu bạn cần thay đổi lịch hẹn hoặc có bất kỳ thắc mắc nào, vui lòng liên hệ hotline/zalo:</p>
    <div class="contact-row">
        <span>📞</span> Hotline: 0987.654.321
    </div>
</div>
@endsection
