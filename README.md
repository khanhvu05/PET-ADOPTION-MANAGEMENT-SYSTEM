# 🐾 Pet Adoption Management System (Hệ thống quản lý nhận nuôi thú cưng)

Chào mừng bạn đến với dự án **Pet Adoption Management System**! Đây là một ứng dụng web hiện đại giúp kết nối những người yêu động vật với các thú cưng đang cần tìm mái ấm mới. Dự án được xây dựng dựa trên nền tảng **Laravel 12**, kết hợp với **Vite**, **Tailwind CSS v4** và **Alpine.js**.

---

## 🚀 Các Tính Năng Nổi Bật

- **Xác thực người dùng:** Đăng ký, đăng nhập, quên mật khẩu và quản lý thông tin cá nhân bảo mật cao sử dụng **Laravel Breeze**.
- **Giao diện hiện đại:** Được tối ưu hóa bằng **Tailwind CSS v4** mới nhất mang lại trải nghiệm mượt mà, hỗ trợ cả Dark Mode/Light Mode.
- **Tương tác linh hoạt:** Sử dụng **Alpine.js** cho các tương tác UI nhanh chóng, không cần tải lại toàn bộ trang.
- **Hệ thống gửi Mail ảo:** Hỗ trợ lưu trữ email khôi phục mật khẩu vào log file hoặc chuyển tiếp SMTP cực kỳ dễ dàng.

---

## 🛠️ Yêu Cầu Hệ Thống (Prerequisites)

Trước khi bắt đầu, hãy đảm bảo máy tính của bạn đã cài đặt các công cụ sau:

- **PHP** >= 8.2
- **Composer** (Công cụ quản lý gói PHP)
- **Node.js** (Phiên bản LTS) & **NPM**
- **Cơ sở dữ liệu:** SQLite (mặc định) hoặc MySQL.

---

## 📥 Hướng Dẫn Cài Đặt & Chạy Dự Án

Thực hiện lần lượt các bước sau trong Terminal của bạn:

### 1. Clone dự án từ GitHub
Chạy lệnh sau để tải mã nguồn dự án về máy:
```bash
git clone https://github.com/USERNAME/Pet_Adoption_Management_System.git
cd Pet_Adoption_Management_System
```
> [!NOTE]  
> *Lưu ý: Hãy thay đổi link GitHub trên bằng đường dẫn repository chính xác của bạn.*

### 2. Cài đặt các thư viện PHP (Composer)
Cài đặt toàn bộ các dependency cần thiết cho Laravel:
```bash
composer install
```

### 3. Cài đặt các thư viện JavaScript (NPM)
Cài đặt các gói tài nguyên dành cho giao diện:
```bash
npm install
```

### 4. Tạo file cấu hình môi trường `.env`
Nhân bản file `.env.example` thành file cấu hình chính thức `.env`:
```bash
copy .env.example .env
```
*(Trên hệ điều hành macOS/Linux, bạn dùng lệnh: `cp .env.example .env`)*

### 5. Tạo Application Key cho Laravel
```bash
php artisan key:generate
```

### 6. Cấu hình cơ sở dữ liệu & Chạy Migration
Dự án sử dụng **SQLite** làm cơ sở dữ liệu mặc định để tiện lợi cho việc phát triển ở local. 
- Hãy tạo một file database trống trong thư mục `database`:
  - **Windows (PowerShell):**
    ```powershell
    New-Item -Path database -Name database.sqlite -ItemType File
    ```
  - **macOS/Linux / Git Bash:**
    ```bash
    touch database/database.sqlite
    ```
- Sau đó, tiến hành chạy migration để khởi tạo các bảng dữ liệu:
  ```bash
  php artisan migrate --seed
  ```

### 7. Build tài nguyên giao diện (Vite & Tailwind v4)
Chạy dev server của Vite để biên dịch CSS/JS thời gian thực:
```bash
npm run dev
```

### 8. Khởi chạy ứng dụng
Mở thêm một Terminal mới tại thư mục dự án và chạy server PHP của Laravel:
```bash
php artisan serve
```

Bây giờ bạn đã có thể truy cập hệ thống tại: **[http://127.0.0.1:8000](http://127.0.0.1:8000)** 🎉

---

## 📧 Hướng Dẫn Test Tính Năng Reset Mật Khẩu (Quên mật khẩu)

Dự án đang được cấu hình ở chế độ `MAIL_MAILER=log` để kiểm thử cục bộ. 

1. Vào trang Đăng nhập -> Chọn **Forgot your password?**.
2. Nhập Email của bạn và ấn gửi yêu cầu.
3. Thay vì gửi về hòm thư thật, Laravel sẽ ghi nội dung mail vào file:
   📂 **`storage/logs/laravel.log`** (nằm ở cuối file).
4. Bạn chỉ cần mở file này ra, tìm đến email mới nhất, **copy đường link reset mật khẩu** dạng `http://localhost:8000/reset-password/...` dán vào trình duyệt để cập nhật mật khẩu mới!

---

## 👥 Danh Sách Thành Viên Thực Hiện

- **Nguyễn Văn A** - [GitHub](https://github.com/)
- **Trần Thị B** - [GitHub](https://github.com/)

---

## 📄 Giấy Phép (License)

Dự án này sử dụng giấy phép **MIT License**. Bạn có thể tự do học tập và phát triển thêm!
