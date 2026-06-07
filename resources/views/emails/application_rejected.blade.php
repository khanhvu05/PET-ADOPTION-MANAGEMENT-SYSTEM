<!DOCTYPE html>
<html>
<head>
    <title>Thông Báo Từ PetJam</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 8px;">
        <h2 style="color: #64748b;">Thông báo từ PetJam</h2>
        <p>Xin chào <strong>{{ $application->Ho_ten }}</strong>,</p>
        <p>Cảm ơn bạn đã quan tâm và dành tình cảm cho bé <strong>{{ $application->thuCung->Ten }}</strong>.</p>
        <p>Rất tiếc, chúng tôi không thể tiếp tục hồ sơ nhận nuôi của bạn vì lý do sau:</p>
        
        <div style="background-color: #f8fafc; padding: 15px; border-left: 4px solid #94a3b8; margin: 20px 0; font-style: italic;">
            {{ $reason }}
        </div>

        <p>Hành trình tìm tổ ấm cho các bé luôn cần những tiêu chí phù hợp nhất để đảm bảo tương lai lâu dài. Mong bạn đừng buồn và tiếp tục theo dõi, ủng hộ các bé khác tại PetJam nhé!</p>

        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
        <p style="font-size: 12px; color: #777;">Trân trọng,<br>Đội ngũ PetJam</p>
    </div>
</body>
</html>
