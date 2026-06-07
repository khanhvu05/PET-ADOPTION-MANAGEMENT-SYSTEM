<!DOCTYPE html>
<html>
<head>
    <title>Hủy Đơn Đăng Ký Quá Hạn</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 8px;">
        <h2 style="color: #e11d48;">Thông báo hủy đơn nhận nuôi</h2>
        <p>Xin chào <strong>{{ $application->Ho_ten }}</strong>,</p>
        <p>Hệ thống PetJam ghi nhận bạn đã không chọn lịch phỏng vấn trong vòng 24 giờ kể từ khi nhận được email mời phỏng vấn đối với bé <strong>{{ $application->thuCung->Ten }}</strong>.</p>
        
        <p>Theo quy định của chúng tôi, hồ sơ của bạn đã tự động chuyển sang trạng thái <strong>Hủy bỏ / Từ chối</strong> để dành cơ hội cho các bạn khác.</p>

        <p>Nếu bạn vẫn còn nguyện vọng nhận nuôi, vui lòng nộp lại đơn đăng ký mới trên hệ thống website của chúng tôi.</p>

        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
        <p style="font-size: 12px; color: #777;">Trân trọng,<br>Đội ngũ PetJam</p>
    </div>
</body>
</html>
