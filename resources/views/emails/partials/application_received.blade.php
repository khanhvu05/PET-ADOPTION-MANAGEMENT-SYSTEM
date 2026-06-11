<span class="title-icon">📬</span>
<h1 class="main-title font-bold text-orange">Đã nhận đơn<br>đăng ký nhận nuôi</h1>

<p>Xin chào <strong>{{ $user->name ?? $user->Ho_ten ?? 'bạn' }}</strong>,</p>
<p>Chúng tôi đã nhận được đơn đăng ký nhận nuôi bé <strong>{{ $application->thuCung->Ten ?? 'thú cưng' }}</strong> của bạn.</p>
<p>Đội ngũ PETJAM đang tiến hành xem xét hồ sơ của bạn. Quá trình này có thể mất từ 1-3 ngày làm việc. Chúng tôi sẽ thông báo ngay khi có kết quả.</p>

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

<div class="alert-box success">
    <div class="alert-icon">💚</div>
    <div>
        Cảm ơn bạn đã sẵn sàng mở rộng vòng tay chào đón một sinh mệnh mới! Hãy thường xuyên kiểm tra email để cập nhật lịch phỏng vấn nhé.
    </div>
</div>

<a href="{{ route('frontend.user.adoptions.index') }}" class="btn btn-primary">Theo dõi trạng thái hồ sơ</a>

<div class="contact-info">
    <p>Nếu bạn có bất kỳ thắc mắc nào trong lúc chờ đợi, vui lòng liên hệ:</p>
    <div class="contact-row">
        <span>📞</span> (84) 123 456 789
    </div>
    <div class="contact-row">
        <span>✉️</span> support@petjam.com
    </div>
</div>
