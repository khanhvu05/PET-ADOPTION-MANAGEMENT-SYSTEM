@extends('emails.template', ['subject' => 'Thông Báo Từ PetJam'])

@section('content')
<span class="title-icon">😔</span>
<h1 class="main-title font-bold text-orange" style="color: #64748b;">Thông báo từ PETJAM<br><span style="color: #0f172a; font-size: 20px;">Về hồ sơ nhận nuôi bé {{ $application->thuCung->Ten ?? 'thú cưng' }}</span></h1>

<p>Xin chào <strong>{{ $application->Ho_ten ?? 'bạn' }}</strong>,</p>
<p>Cảm ơn bạn đã quan tâm và dành tình cảm cho bé <strong>{{ $application->thuCung->Ten ?? 'thú cưng' }}</strong>.</p>
<p>Rất tiếc, chúng tôi không thể tiếp tục hồ sơ nhận nuôi của bạn vì lý do sau:</p>

<div class="alert-box" style="background-color: #f8fafc; border-color: #cbd5e1; color: #475569;">
    <div class="alert-icon">ℹ️</div>
    <div style="font-style: italic;">
        {{ $reason ?? 'Chưa đáp ứng đủ tiêu chí nhận nuôi của trạm ở thời điểm hiện tại.' }}
    </div>
</div>

<p>Hành trình tìm tổ ấm cho các bé luôn cần những tiêu chí phù hợp nhất để đảm bảo tương lai lâu dài. Mong bạn đừng buồn và tiếp tục theo dõi, ủng hộ các bé khác tại PETJAM nhé!</p>

<div class="text-center" style="margin: 30px 0;">
    <a href="{{ url('/') }}" class="btn btn-outline" style="display: inline-block;">Xem thêm các bé khác</a>
</div>

<div class="contact-info">
    <p>Nếu bạn có thắc mắc, vui lòng liên hệ:</p>
    <div class="contact-row">
        <span>✉️</span> support@petjam.com
    </div>
</div>
@endsection
