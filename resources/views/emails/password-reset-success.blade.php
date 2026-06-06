<x-mail::message>
# Đổi Mật Khẩu Thành Công

Xin chào {{ $user->Ho_ten }},

Mật khẩu cho tài khoản PetJam của bạn vừa được thay đổi thành công. Nếu bạn là người thực hiện thay đổi này, bạn có thể bỏ qua email này.

Nếu bạn không yêu cầu thay đổi mật khẩu, vui lòng liên hệ với bộ phận hỗ trợ của chúng tôi ngay lập tức để bảo vệ tài khoản của bạn.

<x-mail::button :url="url('/login')">
Đăng nhập ngay
</x-mail::button>

Trân trọng,<br>
Đội ngũ {{ config('app.name') }}
</x-mail::message>
