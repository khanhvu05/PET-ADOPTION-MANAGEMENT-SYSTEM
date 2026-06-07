<!DOCTYPE html>
<html>
<head>
    <title>Chúc Mừng Nhận Nuôi Thành Công</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #10b981; border-radius: 8px;">
        <div style="text-align: center; margin-bottom: 20px;">
            <h1 style="color: #059669; margin: 0;">🎉 Xin Chúc Mừng! 🎉</h1>
        </div>
        
        <p>Xin chào <strong>{{ $application->Ho_ten }}</strong>,</p>
        <p>Đội ngũ PetJam vô cùng vui mừng thông báo bạn đã xuất sắc vượt qua buổi phỏng vấn nhận nuôi bé <strong>{{ $application->thuCung->Ten }}</strong>.</p>
        
        <p>Hồ sơ của bạn đã được duyệt chính thức. Bé đang rất háo hức chờ bạn đến đón về nhà mới!</p>
        
        <div style="background-color: #ecfdf5; padding: 15px; border-left: 4px solid #10b981; margin: 20px 0;">
            <h3 style="color: #047857; margin-top: 0;">Hướng dẫn nhận bé:</h3>
            <p>Vui lòng tới trạm PetJam để hoàn tất thủ tục bàn giao và đón bé về nhà:</p>
            <ul style="margin-bottom: 0;">
                <li><strong>Địa chỉ trạm:</strong> Số 1, Đại Cồ Việt, Hai Bà Trưng, Hà Nội</li>
                <li><strong>Thời hạn:</strong> Trong vòng 1 tuần kể từ ngày nhận email này</li>
                <li><strong>Lưu ý:</strong> Hãy mang theo CMND/CCCD và lồng/túi vận chuyển thú cưng.</li>
            </ul>
        </div>

        <p>Nếu bạn cần thay đổi lịch hẹn hoặc có bất kỳ thắc mắc nào, vui lòng liên hệ hotline/zalo: <strong>0987.654.321</strong>.</p>

        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
        <p style="font-size: 12px; color: #777;">Trân trọng,<br>Đội ngũ PetJam</p>
    </div>
</body>
</html>
