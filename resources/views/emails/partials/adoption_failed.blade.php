<span class="title-icon" style="color: #ef4444;">❌</span>
<h1 class="main-title font-bold">Thông báo về hồ sơ<br>nhận nuôi {{ $application->thuCung->Ten ?? 'thú cưng' }}</h1>

<p>Xin chào <strong>{{ $user->name ?? $user->Ho_ten ?? 'bạn' }}</strong>,</p>
<p>Rất tiếc hồ sơ nhận nuôi <strong>{{ $application->thuCung->Ten ?? 'thú cưng' }}</strong> của bạn không thể tiếp tục hoàn tất.</p>

<div class="info-list" style="background-color: #f8fafc; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0; margin-top: 20px;">
    <div class="info-item" style="margin-bottom: 15px;">
        <div class="info-text" style="width: 100%;">
            <strong style="color: #64748b; font-size: 12px; text-transform: uppercase;">Trạng thái hồ sơ</strong>
            <div style="color: #ef4444; font-weight: 700; font-size: 15px; display: flex; align-items: center; margin-top: 5px;">
                <span style="margin-right: 5px;">❌</span> Không thành công
            </div>
        </div>
    </div>
    <div style="border-top: 1px dashed #cbd5e1; margin-bottom: 15px;"></div>
    <div class="info-item">
        <div class="info-text" style="width: 100%;">
            <strong style="color: #64748b; font-size: 12px; text-transform: uppercase;">Lý do</strong>
            <p style="margin: 5px 0 0 0; color: #334155;">
                {{ $ghiChu ?? 'Không đáp ứng đủ các điều kiện nhận nuôi hoặc vi phạm chính sách của chúng tôi.' }}
            </p>
        </div>
    </div>
</div>

<div class="alert-box success">
    <div class="alert-icon">💚</div>
    <div>
        Chúng tôi hiểu điều này có thể không như bạn mong đợi, nhưng hy vọng bạn sẽ sớm tìm được một người bạn phù hợp khác.
    </div>
</div>

<a href="{{ route('frontend.adoptions.index') }}" class="btn btn-primary">Xem các bé đang chờ nhận nuôi</a>
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
