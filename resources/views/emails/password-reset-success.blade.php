@extends('emails.template', ['subject' => 'Đổi Mật Khẩu Thành Công'])

@section('content')
<span class="title-icon">🔐</span>
<h1 class="main-title font-bold text-orange" style="color: #0f172a;">Đổi Mật Khẩu Thành Công</h1>

<p>Xin chào <strong>{{ $user->Ho_ten ?? 'bạn' }}</strong>,</p>
<p>Mật khẩu cho tài khoản PETJAM của bạn vừa được thay đổi thành công. Nếu bạn là người thực hiện thay đổi này, bạn có thể yên tâm bỏ qua email này.</p>

<div class="alert-box danger">
    <div class="alert-icon">⚠️</div>
    <div>
        Nếu bạn không yêu cầu thay đổi mật khẩu, vui lòng liên hệ với bộ phận hỗ trợ của chúng tôi ngay lập tức để bảo vệ tài khoản của bạn.
    </div>
</div>

<div class="text-center" style="margin: 30px 0;">
    <a href="{{ url('/login') }}" class="btn btn-primary" style="display: inline-block;">Đăng nhập ngay</a>
</div>

<div class="contact-info">
    <p>Cần hỗ trợ? Vui lòng liên hệ với chúng tôi qua:</p>
    <div class="contact-row">
        <span>📞</span> Hotline: 0987.654.321
    </div>
    <div class="contact-row">
        <span>✉️</span> support@petjam.com
    </div>
</div>
@endsection
