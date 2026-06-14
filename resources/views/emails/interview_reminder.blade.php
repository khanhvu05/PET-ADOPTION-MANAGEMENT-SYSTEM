@extends('emails.template', ['subject' => 'Nhắc Nhở: Vui Lòng Chọn Lịch Phỏng Vấn PetJam'])

@section('content')
<span class="title-icon">⏰</span>
<h1 class="main-title font-bold text-orange" style="color: #d97706;">Nhắc nhở chọn lịch phỏng vấn<br><span style="color: #0f172a; font-size: 20px;">Về hồ sơ nhận nuôi bé {{ $application->thuCung->Ten ?? 'thú cưng' }}</span></h1>

<p>Xin chào <strong>{{ $application->Ho_ten ?? 'bạn' }}</strong>,</p>
<p>Chúng tôi nhận thấy bạn vẫn chưa chọn lịch phỏng vấn để tiếp tục quy trình nhận nuôi bé <strong>{{ $application->thuCung->Ten ?? 'thú cưng' }}</strong>.</p>

<div class="alert-box danger" style="background-color: #fffbeb; border-color: #fcd34d; color: #b45309;">
    <div class="alert-icon">⏳</div>
    <div>
        <strong style="color: #b91c1c;">Thời hạn xác nhận của bạn chỉ còn lại 3 giờ!</strong><br>
        Vui lòng chọn lịch ngay, nếu không đơn của bạn sẽ bị hệ thống tự động hủy.
    </div>
</div>

<div class="text-center" style="margin: 30px 0;">
    <a href="{{ route('frontend.user.adoptions.index') }}" class="btn btn-primary" style="display: inline-block;">Chọn Lịch Ngay</a>
</div>

<div class="contact-info">
    <p>Nếu bạn gặp khó khăn, vui lòng liên hệ với chúng tôi qua:</p>
    <div class="contact-row">
        <span>📞</span> Hotline: 0987.654.321
    </div>
</div>
@endsection
