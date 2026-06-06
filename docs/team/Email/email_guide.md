# Hướng Dẫn & Nghiệp Vụ Gửi Email (PetJam)

Tài liệu này tổng hợp toàn bộ kiến thức kỹ thuật và các luồng nghiệp vụ liên quan đến việc gửi email tự động trong hệ thống Pet Adoption Management System (PetJam).

---

## 1. Cấu Hình Kỹ Thuật (Brevo API)

Hệ thống sử dụng **Brevo (Sendinblue)** làm dịch vụ gửi email chính. Tuy nhiên, để tránh tình trạng các nền tảng deploy (như Render) block cổng SMTP truyền thống (25, 465, 587), hệ thống được cấu hình gửi qua **API Transport** thay vì SMTP.

### 1.1. Package Sử Dụng
Để sử dụng API của Brevo qua Laravel, dự án sử dụng:
- `symfony/brevo-mailer`
- `symfony/http-client` (Bắt buộc để gửi request API)

### 1.2. Cài Đặt Biến Môi Trường (`.env`)
```env
MAIL_MAILER=brevo
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=your_email@example.com
# QUAN TRỌNG: MAIL_PASSWORD PHẢI LÀ API KEY (Bắt đầu bằng xkeysib-...)
# Tuyệt đối KHÔNG dùng SMTP Key (Bắt đầu bằng xsmtpsib-...) sẽ gây lỗi 401 Unauthorized.
MAIL_PASSWORD=xkeysib-********************************
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="no-reply@petjam.com"
MAIL_FROM_NAME="PetJam Rescue"
```

> [!WARNING]
> **Lỗi 401 Unauthorized**: Nếu log báo lỗi `Key not found (code 401)`, nguyên nhân 100% là do bạn đang nhập khóa SMTP thay vì khóa API. Hãy vào mục **SMTP & API -> API Keys** trên Brevo để tạo mã API đúng chuẩn.

### 1.3. Đăng Ký Driver (Backend)
- **AppServiceProvider**: Custom mailer driver `brevo` được đăng ký thủ công tại `app/Providers/AppServiceProvider.php` (trong hàm `boot()`).
- **Cấu hình config**: Cấu hình chi tiết nằm ở `config/mail.php` dưới mảng `mailers.brevo`.
- **Dịch vụ Gửi Mail**: Hệ thống sử dụng service class `App\Services\MailService` làm wrapper trung gian giúp gửi email đơn giản hóa thông qua hàm `$mailService->send($to, $subject, $body)`.

---

## 2. Các Luồng Nghiệp Vụ Có Gửi Email (Adoption Workflow)

Các email sẽ được gửi tự động trong suốt vòng đời của một Đơn Nhận Nuôi (Adoption Application).

### 2.1. Quản Trị Viên Phê Duyệt Đơn (Chuyển sang "Đã Duyệt")
- **Khi nào**: Admin xem hồ sơ và bấm "Phê duyệt & Hẹn phỏng vấn".
- **Nội dung email**: Chúc mừng đơn đã vượt qua vòng hồ sơ. Yêu cầu ứng viên truy cập vào website để chọn ca phỏng vấn phù hợp trong vòng 24 giờ.
- **Controller**: `AdoptionController@approveApplication`

### 2.2. Khách Hàng Xác Nhận Lịch Phỏng Vấn (Chuyển sang "Chờ phỏng vấn")
- **Khi nào**: Ứng viên chọn một slot (ca) phỏng vấn thành công trên giao diện người dùng.
- **Nội dung email**: Xác nhận thời gian, địa điểm cụ thể (Trạm cứu hộ PetJam), và nhắc nhở ứng viên mang theo các giấy tờ tùy thân (CCCD/CMND).
- **Controller**: `UserAdoptionController@scheduleInterview`

### 2.3. Hoàn Tất Nhận Nuôi (Phỏng Vấn Thành Công)
- **Khi nào**: Ứng viên phỏng vấn đạt, Admin bấm "Phỏng vấn thành công" / "Xác nhận đã nhận nuôi".
- **Nội dung email**: Chúc mừng ứng viên đã chính thức đón bé về nhà thành công và gửi lời cảm ơn từ trạm.
- **Controller**: `AdoptionController@completeApplication`

### 2.4. Từ Chối / Hủy Đơn / Phỏng Vấn Thất Bại
- **Khi nào**: Admin bấm Hủy đơn hoặc Từ chối hồ sơ (trước hoặc sau khi phỏng vấn).
- **Nội dung email**: Thư chia buồn thông báo đơn không được chấp thuận. 
  - *Đặc biệt*: Nếu khách hàng rớt phỏng vấn (từ chối khi trạng thái đang là `cho_phong_van`), email sẽ thông báo rõ: *"Sau buổi phỏng vấn, điều kiện hiện tại của bạn chưa thực sự phù hợp..."*
  - Nội dung email **luôn bao gồm "Ghi chú từ quản trị viên"** để khách hàng biết lý do chi tiết.
- **Controller**: `AdoptionController@update`

### 2.5. Tự Động Từ Chối Các Đơn Trùng (Auto-Reject)
- **Khi nào**: Khi một thú cưng được "Hoàn tất nhận nuôi" bởi một người A.
- **Nội dung email**: Bất kỳ người dùng B, C nào đang có đơn ứng tuyển (trạng thái pending/pre_approved) cho bé thú cưng này sẽ tự động bị hệ thống hủy đơn. Họ sẽ nhận được email chia buồn với lý do: *"Bé đã được nhận nuôi thành công bởi một người khác nhanh tay hơn."*
- **Controller**: `AdoptionController@completeApplication`

---

## 3. Lưu Ý Khi Phát Triển & Xử Lý Lỗi

1. **Email Chạy Nền (Terminating/Queues)**:
   - Các logic gửi email (gọi `$mailService->send`) thường được bọc trong `app()->terminating(...)`. Việc này giúp Laravel có thể trả về HTTP Response cho người dùng ngay lập tức để giao diện hiển thị mượt mà, sau đó mới tiến hành gọi API gửi email ở background.
2. **Clear Cache Môi Trường**:
   - Nếu bạn thay đổi `MAIL_PASSWORD` hoặc bất kỳ tham số nào trong `.env`, bắt buộc phải chạy `php artisan config:clear` và khởi động lại Server (`php artisan serve`). Nếu không, Laravel sẽ vẫn dùng mật khẩu cũ được lưu trong cache.
