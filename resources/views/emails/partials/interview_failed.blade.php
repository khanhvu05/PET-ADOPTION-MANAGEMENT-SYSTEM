<span class="title-icon" style="filter: grayscale(100%);">😢</span>
<h1 class="main-title font-bold">Thông báo kết quả<br>phỏng vấn</h1>

<p>Xin chào <strong>{{ $user->name ?? $user->Ho_ten ?? 'bạn' }}</strong>,</p>
<p>Cảm ơn bạn đã tham gia buổi phỏng vấn nhận nuôi bé <strong>{{ $application->thuCung->Ten ?? 'thú cưng' }}</strong>.</p>
<p>Sau khi xem xét kỹ lưỡng, chúng tôi rất tiếc chưa thể tiếp tục hồ sơ này.</p>

<div class="alert-box danger" style="margin-top: 25px;">
    <div style="width: 100%;">
        <h3 style="margin-top: 0; font-size: 15px; margin-bottom: 8px;">Lý do chưa phù hợp</h3>
        <p style="margin: 0; line-height: 1.5;">
            {{ $ghiChu ?? 'Điều kiện sinh hoạt hiện tại của bạn chưa hoàn toàn phù hợp với nhu cầu chăm sóc và đặc tính của bé để đảm bảo bé có cuộc sống tốt nhất.' }}
        </p>
    </div>
</div>

<div class="alert-box" style="background-color: #fffbeb; border-color: #fde68a; color: #92400e;">
    <div class="alert-icon">💡</div>
    <div>
        Chúng tôi luôn trân trọng tấm lòng của bạn và hy vọng bạn sẽ tiếp tục đồng hành cùng PETJAM trên hành trình giúp đỡ thú cưng. Bạn vẫn có thể tìm thấy một người bạn bốn chân phù hợp khác.
    </div>
</div>

<a href="{{ route('frontend.adoptions.index') }}" class="btn btn-primary">Tìm thú cưng khác</a>

<div class="contact-info">
    <p>Nếu bạn cần hỗ trợ hoặc có thắc mắc, đừng ngần ngại liên hệ với chúng tôi:</p>
    <div class="contact-row">
        <span>📞</span> (84) 123 456 789
    </div>
    <div class="contact-row">
        <span>✉️</span> support@petjam.com
    </div>
</div>
