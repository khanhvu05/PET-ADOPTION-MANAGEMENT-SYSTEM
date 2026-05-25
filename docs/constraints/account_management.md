# Ràng buộc (Constraints) & Bảo mật: Module Quản lý Tài khoản

Tài liệu này tổng hợp toàn bộ các quy tắc xác thực (Validation Rules), tiêu chuẩn bảo mật và logic phân quyền (RBAC) đang được áp dụng trong Module Quản lý Tài khoản (Tài khoản, Đăng nhập, Đăng ký, RBAC) của hệ thống PetAdoption. Tài liệu được trình bày dưới dạng bảng để phục vụ việc tra cứu và ôn tập thi vấn đáp một cách trực quan.

---

## 1. Bảng Ràng Buộc Dữ Liệu (Data Validation)

Dưới đây là các quy tắc kiểm tra dữ liệu đầu vào (Validation) được áp dụng tại các luồng Đăng ký, Đăng nhập, và Đặt lại mật khẩu.

| Trường Dữ Liệu | Thuộc tính (Rules) | Ý nghĩa / Mô tả chi tiết | Áp dụng tại |
| :--- | :--- | :--- | :--- |
| **Họ và tên** (`name`) | `required`, `string`, `max:255` | Bắt buộc nhập, phải là chuỗi ký tự, độ dài không vượt quá 255 ký tự. | Đăng ký, Cập nhật Profile |
| **Email** (`email`) | `required`, `string`, `lowercase`, `email`, `max:255` | Bắt buộc nhập, chuỗi chuẩn định dạng email, tự động chuyển thành chữ thường, tối đa 255 ký tự. | Đăng ký, Đăng nhập, Reset Password, Cập nhật Profile |
| **Email (Duy nhất)** | `unique:users` | Email đăng ký mới không được phép trùng lặp với bất kỳ email nào đã tồn tại trong database bảng `users`. | Đăng ký |
| **Email (Bỏ qua ID)** | `unique(User::class)->ignore($id)` | Khi cập nhật Profile, bỏ qua kiểm tra trùng lặp email đối với chính ID của user hiện tại (tránh lỗi email đã tồn tại). | Cập nhật Profile |
| **Mật khẩu** (`password`) | `required`, `string`, `Rules\Password::defaults()` | Bắt buộc nhập, là chuỗi, độ dài tối thiểu **8 ký tự**. (Có thể cấu hình thêm bắt buộc chữ hoa, số, ký tự đặc biệt). | Đăng ký, Reset Password |
| **Xác nhận MK** (`password_confirmation`) | `confirmed` | Trường xác nhận (confirmation) truyền lên bắt buộc phải khớp hoàn toàn với trường `password`. | Đăng ký, Reset Password |
| **Token (Khôi phục)** | `required`, Thời gian sống (TTL) | Bắt buộc có token bí mật trong liên kết. Token có thời hạn sử dụng giới hạn (mặc định 60 phút). | Reset Password |

---

## 2. Bảng Ràng Buộc Bảo Mật (Security Policies)

Hệ thống áp dụng các quy chuẩn bảo vệ chống lại các hình thức tấn công phổ biến.

| Cơ chế / Lỗ hổng | Phương pháp phòng vệ / Ràng buộc hệ thống | Nơi xử lý |
| :--- | :--- | :--- |
| **Mã hóa dữ liệu (Hashing)** | Tuyệt đối không lưu mật khẩu thô. Toàn bộ mật khẩu bị băm 1 chiều bằng thuật toán `Bcrypt` qua phương thức `Hash::make()`. | Controllers |
| **Chống Brute Force (Tấn công dò mật khẩu)** | **Rate Limiting**: Sử dụng `EnsureIsNotRateLimited`. Giới hạn chỉ được nhập sai tối đa **5 lần / 1 phút**. Sau 5 lần, khóa truy cập IP/Tài khoản tạm thời trong 60 giây. | LoginRequest |
| **Chống Session Fixation (Đánh cắp phiên)** | Bắt buộc tái tạo ID phiên mới bằng lệnh `session()->regenerate()` ngay sau khi xác thực (login) thành công. | AuthenticatedSessionController |
| **Bảo vệ xác thực đa bước** | Hủy trạng thái xác thực Email (`email_verified_at = null`) và yêu cầu verify lại từ đầu nếu người dùng thay đổi địa chỉ email trong Profile. | ProfileController |

---

## 3. Bảng Ràng Buộc Phân Quyền (RBAC)

Cơ chế Phân quyền Dựa trên Vai trò (Role-Based Access Control) đảm bảo an toàn truy cập tài nguyên. Việc phân quyền dựa vào giá trị cột `role` trong bảng `users`.

| Vai trò (Role) | Mức độ kiểm soát | Quyền hạn (Permissions & Capabilities) |
| :--- | :--- | :--- |
| **Admin** | **[Cao Nhất]** Toàn quyền | Truy cập toàn bộ hệ thống (Dashboard, Quản trị). Có quyền quản lý người dùng, thăng cấp/hạ cấp Role (RBAC) của người khác. |
| **Staff** | **[Trung Bình]** Quản trị Nội dung | Truy cập Admin Dashboard. Có quyền quản lý bài đăng, duyệt hồ sơ thú cưng, lịch hẹn. **Không** có quyền quản lý tài khoản người dùng khác. |
| **User** | **[Thấp Nhất]** Người dùng thường | Chỉ truy cập Frontend (Landing Page). Quản lý hồ sơ cá nhân và theo dõi đơn xin nhận nuôi của chính mình. |

> [!CAUTION]
> **Ràng buộc Middleware (Bảo vệ đường dẫn):**
> Tất cả các tuyến đường (Route) chức năng quản trị phải được bọc bởi middleware nghiêm ngặt (ví dụ kiểm tra `$user->isAdmin()`). Hệ thống sẽ trả về lỗi HTTP 403 (Forbidden) hoặc 404 (Not Found) để chặn đứng mọi Request cURL/Postman can thiệp trái phép, chứ không chỉ che giấu giao diện (UI) đơn thuần.
