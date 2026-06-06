<div align="center">
  <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?w=300&h=300&fit=crop" alt="PetJam Logo" width="150" style="border-radius: 50%;">
  <h1>🐾 PetJam - Hệ Thống Quản Lý Nhận Nuôi Thú Cưng</h1>
  <p><em>Kết nối yêu thương - Lan tỏa hạnh phúc</em></p>
</div>

---

## 🌟 Giới thiệu (Introduction)
**PetJam** là một nền tảng quản lý nhận nuôi thú cưng chuyên nghiệp được xây dựng bằng Laravel. Dự án giúp tự động hóa và số hóa quy trình từ lúc tiếp nhận thú cưng, xét duyệt đơn nhận nuôi, đến việc hỗ trợ gây quỹ thông qua cổng thanh toán trực tuyến.

## 🚀 Tính năng nổi bật (Features)

### Dành cho Khách hàng (Frontend)
- **Danh mục Thú Cưng:** Xem danh sách, tìm kiếm và lọc các bé chó, mèo đang tìm chủ.
- **Đăng ký Nhận Nuôi:** Nộp đơn nhận nuôi, trả lời khảo sát và theo dõi trạng thái đơn.
- **Đặt lịch Phỏng Vấn:** Chủ động chọn ca phỏng vấn phù hợp khi đơn đã được duyệt.
- **Quyên góp & Ủng hộ (VNPay):** Hỗ trợ chi phí hoạt động cho trạm cứu hộ thông qua cổng thanh toán VNPay.
- **Thông báo Email Tự Động:** Nhận email thông báo trạng thái đơn, thư mời phỏng vấn và cảm ơn quyên góp (Email HTML giao diện đẹp).

### Dành cho Admin (Backend/Dashboard)
- **Quản lý Thú Cưng:** Thêm mới, chỉnh sửa thông tin, tải ảnh lên tự động qua **Cloudinary**.
- **Xét duyệt Đơn:** Workflow chặt chẽ (Chờ duyệt -> Đã duyệt -> Chờ phỏng vấn -> Đã nhận nuôi).
- **Quản lý Ca Phỏng Vấn:** Mở các khung giờ phỏng vấn, giới hạn số lượng người tham gia.
- **Thống kê Dashboard:** Trực quan hóa dữ liệu về số đơn, số tiền quyên góp, biểu đồ nhận nuôi.

## 🛠 Công nghệ sử dụng (Tech Stack)
- **Framework:** Laravel 11.x (PHP 8.2+)
- **Cơ sở dữ liệu:** MySQL (Đang chạy trên Aiven Cloud)
- **Giao diện:** Blade Templates, TailwindCSS, Alpine.js, SweetAlert2.
- **Lưu trữ Ảnh:** Cloudinary API
- **Thanh toán:** Cổng thanh toán VNPay
- **Email:** SMTP (PHPMailer / Mailable)

## ⚙️ Hướng dẫn cài đặt (Installation)

### Yêu cầu hệ thống
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

### Các bước triển khai (Local)
1. **Clone dự án:**
   ```bash
   git clone https://github.com/WangChukz/PET_ADOPTION_MANAGEMENT_SYSTEM.git
   cd PET_ADOPTION_MANAGEMENT_SYSTEM
   ```

2. **Cài đặt thư viện:**
   ```bash
   composer install
   npm install && npm run build
   ```

3. **Cấu hình biến môi trường (.env):**
   - Copy file `.env.example` thành `.env`.
   - Cập nhật thông tin kết nối MySQL (ví dụ dùng Aiven).
   - Bổ sung cấu hình VNPay (`VNP_TMN_CODE`, `VNP_HASH_SECRET`).
   - Bổ sung cấu hình Cloudinary (`CLOUDINARY_URL`).
   - Bổ sung cấu hình Mail SMTP.

4. **Chạy Migration & Seeders:**
   ```bash
   php artisan key:generate
   php artisan migrate --seed
   ```

5. **Khởi động Server:**
   ```bash
   php artisan serve
   ```

## 🌐 Deploy lên Render
Dự án được tối ưu để có thể triển khai lên **Render.com**. Bạn chỉ cần kết nối repository này với Render, thiết lập **Environment Variables** từ file `.env`, và Render sẽ tự động build.

---
*Phát triển với ❤️ cho cộng đồng yêu động vật.*
