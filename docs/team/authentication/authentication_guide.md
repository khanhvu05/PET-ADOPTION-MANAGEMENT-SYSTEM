# 🔐 Tài Liệu Authentication & Bảo Mật Hệ Thống (PetJam)

> [!NOTE]
> Tài liệu này lưu trữ các kiến thức, cơ chế bảo mật, phân quyền và quản lý tài khoản đang được áp dụng trong dự án PetJam. Tài liệu sẽ liên tục được cập nhật trong quá trình phát triển.

---

## 1. Cơ chế Quản lý Phiên (Session) & Cookie

### 1.1. Session (Phiên làm việc)
- **Sử dụng cái gì?** Laravel Session (hiện tại đang dùng `SESSION_DRIVER=file`).
- **Mục đích:** Lưu trữ trạng thái của người dùng (đã đăng nhập hay chưa, thông báo lỗi, dữ liệu tạm thời form) giữa các HTTP requests.
- **Tác dụng:** Giúp hệ thống nhận diện được người dùng đang tương tác là ai mà không cần họ phải đăng nhập lại mỗi lần chuyển trang.
- **Thời gian lưu (Lifetime):** Mặc định là **120 phút**. 
- **Nơi cấu hình:**
  - File `.env`: Biến `SESSION_LIFETIME=120`.
  - File `config/session.php`: Quản lý các cấu hình sâu hơn (như `expire_on_close` - hủy session ngay khi đóng trình duyệt).

### 1.2. Lỗi 419 Page Expired & Bảo mật CSRF
- **Sử dụng cái gì?** CSRF Token (`@csrf` trong các form Blade).
- **Mục đích:** Chống lại các cuộc tấn công Cross-Site Request Forgery (giả mạo request từ trang web khác).
- **Tác dụng:** Mỗi khi người dùng mở form, hệ thống sinh ra một token ẩn. Khi submit, hệ thống kiểm tra token này. Nếu token không khớp, Laravel sẽ chặn lại và báo lỗi **419 Page Expired**.
- **Nguyên nhân phổ biến gây lỗi 419:**
  - Người dùng để trang quá lâu khiến Session (120 phút) bị hết hạn, kéo theo CSRF token bị hủy.
  - Cấu hình sai `APP_URL` trong `.env` so với tên miền thực tế.
  - Thư mục `storage/framework/sessions` trên server không có quyền ghi (`chmod 775`).

### 1.3. Cơ chế "Ghi nhớ đăng nhập" (Remember Me)
- **Sử dụng cái gì?** Cột `remember_token` trong Database (bảng `users`) và Cookie `remember_web_...` trên trình duyệt.
- **Mục đích:** Giúp người dùng duy trì đăng nhập trong thời gian rất dài mà không bị giới hạn bởi 120 phút của Session thông thường.
- **Tác dụng:** 
  - Khi tick vào ô "Ghi nhớ đăng nhập", Laravel tạo ra một chuỗi token ngẫu nhiên lưu vào DB (`remember_token`) và tạo một Cookie có tuổi thọ mặc định là **5 năm** trên trình duyệt.
  - Lần sau khi vào web, dù Session đã hết hạn, hệ thống sẽ tự động đọc Cookie này, đối chiếu với DB và tự động tạo lại Session mới cho người dùng.

---

## 2. Phân Quyền (Authorization)

### 2.1. Spatie Laravel Permission
- **Sử dụng cái gì?** Package `spatie/laravel-permission`.
- **Mục đích:** Quản lý quyền (Permissions) và vai trò (Roles) một cách linh hoạt, thay vì hard-code trong logic.
- **Tác dụng:** 
  - Cho phép tạo bảng `roles`, `permissions`, `model_has_roles`, `role_has_permissions`.
  - Giúp gán quyền dễ dàng qua code (vd: `$user->assignRole('customer')`) và kiểm tra quyền ở Blade (vd: `@can('manage pets')`).
  
### 2.2. Danh sách Roles (Vai trò) hiện tại
- `admin`: Có toàn quyền hệ thống.
- `staff`: Nhân viên / Tình nguyện viên (quản lý thú cưng, cứu hộ, duyệt đơn nhận nuôi...).
- `customer`: Người dùng phổ thông (chỉ dùng các tính năng cơ bản, tạo đơn nhận nuôi, quyên góp).

> [!WARNING]
> **Lưu ý quan trọng khi Deploy:**
> Khi đưa code lên server thật, bắt buộc phải chạy Seeder (`php artisan db:seed --class=RolesAndPermissionsSeeder`) để Database trên server có sẵn các Role này. Nếu không, khi người dùng mới đăng ký, hệ thống gọi hàm `assignRole('customer')` sẽ gây ra lỗi 500 (`RoleDoesNotExist`).

---

## 3. Cấu Hình Gửi Email (SMTP)

- **Sử dụng cái gì?** Brevo (trước đây là Sendinblue) thông qua giao thức SMTP.
- **Mục đích:** Gửi email thông báo, xác minh tài khoản, khôi phục mật khẩu.
- **Cấu hình chuẩn trong `.env`:**
  ```env
  MAIL_MAILER=smtp
  MAIL_HOST=smtp-relay.brevo.com
  MAIL_PORT=587
  MAIL_USERNAME=email_dang_ky_brevo
  MAIL_PASSWORD=xsmtpsib-ma-smtp-key-cua-brevo
  MAIL_FROM_ADDRESS="email_nguoi_gui_da_xac_thuc"
  ```

> [!IMPORTANT]
> - `MAIL_PASSWORD` là **SMTP Key** (được tạo trong Dashboard của Brevo), không phải mật khẩu đăng nhập tài khoản.
> - Bắt buộc phải thêm và xác thực `MAIL_FROM_ADDRESS` trong phần **Senders & Domains** của Brevo để không bị từ chối gửi.
