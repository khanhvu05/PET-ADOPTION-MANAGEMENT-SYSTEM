@extends('emails.template', ['subject' => 'Mời Phỏng Vấn Nhận Nuôi PetJam'])

@section('content')
<span class="title-icon">🎉</span>
<h1 class="main-title font-bold text-orange">Chúc mừng!<br><span style="color: #0f172a; font-size: 20px;">Hồ sơ nhận nuôi {{ $application->thuCung->Ten ?? 'thú cưng' }} đã vượt qua vòng sơ loại</span></h1>

<div class="pet-card-large">
    @if($application->thuCung && $application->thuCung->anh_url)
        <img src="{{ $application->thuCung->anh_url }}" alt="{{ $application->thuCung->Ten }}" class="pet-photo">
    @else
        <div class="pet-photo" style="background-color: #f1f5f9; display: flex; align-items: center; justify-content: center; font-size: 48px;">🐾</div>
    @endif
</div>

<p>Xin chào <strong>{{ $application->Ho_ten ?? 'bạn' }}</strong>,</p>
<p>PETJAM rất vui thông báo rằng hồ sơ xin nhận nuôi bé <strong>{{ $application->thuCung->Ten ?? 'thú cưng' }}</strong> của bạn đã vượt qua vòng đánh giá sơ bộ.</p>
<p>Để tiếp tục quy trình, mời bạn truy cập vào đường link bên dưới để chọn lịch phỏng vấn phù hợp nhất với bạn (Trực tiếp tại trạm hoặc Online):</p>

<div class="text-center" style="margin: 30px 0;">
    <a href="{{ route('frontend.user.adoptions.index') }}" class="btn btn-primary" style="display: inline-block;">Chọn Lịch Phỏng Vấn</a>
</div>

<div class="alert-box danger">
    <div class="alert-icon">⚠️</div>
    <div>
        <strong>Lưu ý quan trọng:</strong> Vui lòng xác nhận lịch trong vòng 24h kể từ khi nhận email này. Nếu quá hạn, hệ thống sẽ tự động hủy đơn đăng ký của bạn.
    </div>
</div>

<div class="contact-info">
    <p>Nếu bạn cần hỗ trợ, vui lòng liên hệ với chúng tôi qua:</p>
    <div class="contact-row">
        <span>📞</span> Hotline: 0987.654.321
    </div>
    <div class="contact-row">
        <span>✉️</span> support@petjam.com
    </div>
</div>
@endsection
