# 🐾 Pet Adoption Management System (Hệ thống quản lý nhận nuôi thú cưng)

Chào mừng bạn đến với dự án **Pet Adoption Management System**! Đây là một ứng dụng web hiện đại giúp kết nối những người yêu động vật với các thú cưng đang cần tìm mái ấm mới. Dự án được xây dựng dựa trên nền tảng **Laravel 12**, kết hợp với **Vite**, **Tailwind CSS v4** và **Alpine.js**, sử dụng **MySQL** làm cơ sở dữ liệu chính thức.

---

## 🚀 Các Tính Năng Nổi Bật

- **Xác thực người dùng:** Đăng ký, đăng nhập, quên mật khẩu và quản lý thông tin cá nhân bảo mật cao sử dụng **Laravel Breeze**.
- **Phân quyền RBAC:** Ba cấp vai trò `admin`, `staff`, `user` với bảo vệ route và middleware tường minh.
- **Giao diện hiện đại:** Được tối ưu hóa bằng **Tailwind CSS v4** mới nhất mang lại trải nghiệm mượt mà, hỗ trợ cả Dark Mode/Light Mode.
- **Tương tác linh hoạt:** Sử dụng **Alpine.js** cho các tương tác UI nhanh chóng, không cần tải lại toàn bộ trang.
- **Hệ thống gửi Mail ảo:** Hỗ trợ lưu trữ email khôi phục mật khẩu vào log file hoặc chuyển tiếp SMTP cực kỳ dễ dàng.

---

## 🛠️ Yêu Cầu Hệ Thống (Prerequisites)

Trước khi bắt đầu, hãy đảm bảo máy tính của bạn đã cài đặt các công cụ sau:

- **PHP** >= 8.2
- **Composer** (Công cụ quản lý gói PHP)
- **Node.js** (Phiên bản LTS) & **NPM**
- **MySQL** >= 5.7 hoặc **MariaDB** >= 10.3 (đang chạy dưới dạng service)
- **MySQL Client** để quản lý database (ví dụ: phpMyAdmin, HeidiSQL, DBeaver, hoặc MySQL Workbench)

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
# Windows
copy .env.example .env

# macOS/Linux
cp .env.example .env
```

### 5. Tạo Application Key cho Laravel
```bash
php artisan key:generate
```

### 6. Cấu Hình Kết Nối Database (Aiven Cloud)
Dự án hiện đã được chuyển sang sử dụng hệ thống cơ sở dữ liệu đám mây **Aiven MySQL** dùng chung cho cả team. Bạn không cần phải cài đặt hay tạo database ở máy cá nhân nữa.

**Bước 6.1 — Cấu hình file `.env`:**
Mở file `.env` và điền thông số kết nối do Admin/Team Leader cung cấp:
```dotenv
DB_CONNECTION=mysql
DB_HOST=mysql-ac7c52b-petadoption-php.f.aivencloud.com
DB_PORT=14399
DB_DATABASE=defaultdb
DB_USERNAME=avnadmin
DB_PASSWORD="<Nhập_Password_Được_Cấp>"
```

**Bước 6.2 — Chạy lệnh dọn dẹp Cache & Cập nhật bảng (Nếu có sự thay đổi):**
Vì Database là dùng chung, cấu trúc bảng thường đã được Admin tạo sẵn. Bạn chỉ cần chạy lệnh này để đảm bảo máy bạn nhận đúng cấu hình:
```bash
php artisan config:clear
php artisan migrate
```

> [!TIP]
> 🔍 **Muốn xem dữ liệu bên trong Database?**
> Đừng dùng localhost phpMyAdmin mặc định nữa. Hãy xem hướng dẫn chi tiết cách cấu hình phpMyAdmin của bạn để soi thẳng vào Aiven tại đây:
> 👉 **[Hướng dẫn kết nối XAMPP phpMyAdmin sang Aiven](docs/team/Aiven_deploy_mysql/HUONG_DAN_KET_NOI_AIVEN_PHPMYADMIN.md)**

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

## 🔑 Tài Khoản Mẫu (Sau khi chạy `--seed`)

Sau khi chạy migration với seed, hệ thống tự động tạo sẵn 3 tài khoản để kiểm thử:

| Vai trò | Email | Mật khẩu |
| :--- | :--- | :--- |
| **Admin** | `admin@example.com` | `password` |
| **Staff** | `staff@example.com` | `password` |
| **User** | `user@example.com` | `password` |

> [!CAUTION]
> Nhớ đổi mật khẩu và thông tin tài khoản trước khi deploy lên môi trường production!

---

## 📧 Hướng Dẫn Test Tính Năng Reset Mật Khẩu (Quên mật khẩu)

Dự án đang được cấu hình ở chế độ `MAIL_MAILER=log` để kiểm thử cục bộ. 

1. Vào trang Đăng nhập → Chọn **Forgot your password?**.
2. Nhập Email của bạn và ấn gửi yêu cầu.
3. Thay vì gửi về hòm thư thật, Laravel sẽ ghi nội dung mail vào file:
   📂 **`storage/logs/laravel.log`** (nằm ở cuối file).
4. Bạn chỉ cần mở file này ra, tìm đến email mới nhất, **copy đường link reset mật khẩu** dạng `http://localhost:8000/reset-password/...` dán vào trình duyệt để cập nhật mật khẩu mới!

---

## 📚 Hệ Thống Tài Liệu Nội Bộ (Documentation)

Dự án đi kèm với hệ thống tài liệu hướng dẫn và quy chuẩn chi tiết dành riêng cho Team phát triển (lưu trong thư mục `docs/`):

### 1. 🏗️ Kiến Trúc & Thiết Kế
* [Phân tích kiến trúc tổng thể (Architecture)](docs/technical_analysis/architecture_analysis.md)
* [Quy chuẩn thiết kế UI/UX & Design System](docs/technical_analysis/design_taste_guidelines.md)
* [Chi tiết thiết kế (Design)](docs/design/design.md)
* [Các quy tắc chung (Rules Base)](docs/rules_base.md)
* [Ràng buộc quản lý tài khoản](docs/constraints/account_management.md)

### 2. 🔄 Quy Trình Làm Việc (Team Workflow)
* [Quy trình làm việc với Git & GitHub](docs/team/workflow/QUY_TRINH_LAM_VIEC_GIT_GITHUB.md)
* [Quy trình thiết kế Database](docs/team/workflow/QUY_TRINH_LAM_VIEC_DATABASE.md)

### 3. ☁️ Triển Khai Lên Mạng (Deploy & Server)
* [Hướng dẫn Deploy lên Render & Bảo mật](docs/team/Render/HUONG_DAN_DEPLOY_VA_BAO_MAT.md)
* [Nhật ký Deploy Render](docs/team/Render/NHAT_KY_DEPLOY_RENDER.md)
* [Kiến thức bảo mật Server](docs/team/Render/KIEN_THUC_BAO_MAT.md)
* [Hướng dẫn cấu hình phpMyAdmin kết nối Aiven Cloud](docs/team/Aiven_deploy_mysql/HUONG_DAN_KET_NOI_AIVEN_PHPMYADMIN.md)

### 4. 🐛 Khác
* [Sổ tay ghi chép lỗi & cách xử lý (Error Log)](docs/handling_error/error_log.md)
* [Tổng kết toàn bộ dự án](docs/TONG_KET_DU_AN.md)

---

## 👥 Danh Sách Thành Viên Thực Hiện

- **Nguyễn Văn A** - [GitHub](https://github.com/)
- **Trần Thị B** - [GitHub](https://github.com/)

---

## 📄 Giấy Phép (License)

Dự án này sử dụng giấy phép **MIT License**. Bạn có thể tự do học tập và phát triển thêm!
