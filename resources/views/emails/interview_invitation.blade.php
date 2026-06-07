<!DOCTYPE html>
<html>
<head>
    <title>Mời Phỏng Vấn Nhận Nuôi</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 8px;">
        <h2 style="color: #0d9488;">Chúc mừng bạn!</h2>
        <p>Xin chào <strong>{{ $application->Ho_ten }}</strong>,</p>
        <p>Hồ sơ xin nhận nuôi bé <strong>{{ $application->thuCung->Ten }}</strong> của bạn đã vượt qua vòng sơ loại của PetJam.</p>
        <p>Để tiếp tục quy trình, mời bạn truy cập vào đường link bên dưới để chọn lịch phỏng vấn phù hợp nhất với bạn (Trực tiếp tại trạm hoặc Online):</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('frontend.user.adoptions.index') }}" style="background-color: #0d9488; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold;">
                Chọn Lịch Phỏng Vấn
            </a>
        </div>

        <p style="color: #e11d48; font-weight: bold;">Lưu ý quan trọng: Vui lòng xác nhận lịch trong vòng 24h kể từ khi nhận email này. Nếu quá hạn, hệ thống sẽ tự động hủy đơn đăng ký của bạn.</p>

        <p>Nếu bạn cần hỗ trợ, vui lòng liên hệ hotline: <strong>0987.654.321</strong>.</p>
        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
        <p style="font-size: 12px; color: #777;">Trân trọng,<br>Đội ngũ PetJam</p>
    </div>
</body>
</html>
