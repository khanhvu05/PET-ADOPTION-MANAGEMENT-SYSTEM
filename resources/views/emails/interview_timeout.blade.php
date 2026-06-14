@extends('emails.template', ['subject' => 'Hủy Đơn Đăng Ký Quá Hạn - PetJam'])

@section('content')
<span class="title-icon">🚫</span>
<h1 class="main-title font-bold text-orange" style="color: #e11d48;">Thông báo hủy đơn nhận nuôi<br><span style="color: #0f172a; font-size: 20px;">Hồ sơ quá hạn xác nhận lịch phỏng vấn</span></h1>

<p>Xin chào <strong>{{ $application->Ho_ten ?? 'bạn' }}</strong>,</p>
<p>Hệ thống PETJAM ghi nhận bạn đã không chọn lịch phỏng vấn trong vòng 24 giờ kể từ khi nhận được email mời phỏng vấn đối với bé <strong>{{ $application->thuCung->Ten ?? 'thú cưng' }}</strong>.</p>

<div class="alert-box danger">
    <div class="alert-icon">⚠️</div>
    <div>
        Theo quy định của trạm, hồ sơ của bạn đã tự động chuyển sang trạng thái <strong>Hủy bỏ / Từ chối</strong> để dành cơ hội cho các bạn khác.
    </div>
</div>

<p>Nếu bạn vẫn còn nguyện vọng nhận nuôi, vui lòng nộp lại đơn đăng ký mới trên hệ thống website của chúng tôi.</p>

<div class="text-center" style="margin: 30px 0;">
    <a href="{{ url('/') }}" class="btn btn-outline" style="display: inline-block;">Quay Lại Trang Chủ</a>
</div>

<div class="contact-info">
    <p>Nếu có thắc mắc, vui lòng liên hệ:</p>
    <div class="contact-row">
        <span>✉️</span> support@petjam.com
    </div>
</div>
@endsection
