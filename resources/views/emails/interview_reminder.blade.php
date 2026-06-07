<!DOCTYPE html>
<html>
<head>
    <title>Nhắc Nhở: Vui Lòng Chọn Lịch Phỏng Vấn</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #f59e0b; border-radius: 8px;">
        <h2 style="color: #d97706;">Nhắc nhở chọn lịch phỏng vấn</h2>
        <p>Xin chào <strong>{{ $application->Ho_ten }}</strong>,</p>
        <p>Chúng tôi nhận thấy bạn vẫn chưa chọn lịch phỏng vấn để nhận nuôi bé <strong>{{ $application->thuCung->Ten }}</strong>.</p>
        
        <p style="color: #b91c1c; font-weight: bold;">Thời hạn xác nhận của bạn chỉ còn lại 3 giờ!</p>

        <p>Vui lòng nhấp vào nút dưới đây để chọn lịch ngay, nếu không đơn của bạn sẽ bị hủy tự động:</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/adoptions/interviews/' . $application->Ma_don) }}" style="background-color: #f59e0b; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold;">
                Chọn Lịch Ngay
            </a>
        </div>

        <p>Nếu bạn gặp khó khăn, vui lòng liên hệ hotline: <strong>0987.654.321</strong>.</p>
        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
        <p style="font-size: 12px; color: #777;">Trân trọng,<br>Đội ngũ PetJam</p>
    </div>
</body>
</html>
