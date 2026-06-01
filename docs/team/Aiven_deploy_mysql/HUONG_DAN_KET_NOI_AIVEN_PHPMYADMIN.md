# Hướng Dẫn Cấu Hình phpMyAdmin (XAMPP) Để Kết Nối Sang Aiven MySQL

Mặc định, `phpMyAdmin` của XAMPP được cấu hình để tự động đăng nhập ngầm vào Database máy chủ ảo (localhost - 127.0.0.1) và không hiển thị màn hình đăng nhập.

Để có thể dùng giao diện phpMyAdmin quản lý Database nằm trên Cloud (như Aiven), bạn cần cấu hình lại file `config.inc.php` để bật chế độ hiển thị màn hình Đăng nhập (Login Screen) và khai báo thêm máy chủ Aiven vào danh sách.

## 🛠️ Các Bước Thực Hiện

### Bước 1: Mở file cấu hình
1. Mở thư mục cài đặt XAMPP trên máy của bạn (Thường nằm ở `C:\xampp`).
2. Vào thư mục `phpMyAdmin`.
3. Tìm và mở file `config.inc.php` bằng phần mềm đọc code (VS Code, Notepad, hoặc Sublime Text).

### Bước 2: Tắt chế độ Auto-Login (Tự động đăng nhập)
Tìm đến đoạn code định nghĩa máy chủ đầu tiên (thường nằm ở khoảng dòng 18-20), thay đổi `auth_type` từ `config` sang `cookie`.

**Trước khi sửa:**
```php
/* Authentication type and info */
$cfg['Servers'][$i]['auth_type'] = 'config'; // Đang là config
$cfg['Servers'][$i]['user'] = 'root';
$cfg['Servers'][$i]['password'] = '';
```

**Sau khi sửa:**
```php
/* Authentication type and info */
$cfg['Servers'][$i]['auth_type'] = 'cookie'; // Đổi thành cookie
$cfg['Servers'][$i]['user'] = 'root';
$cfg['Servers'][$i]['password'] = '';
```

### Bước 3: Thêm máy chủ Aiven
Cuộn xuống **dưới cùng** của file `config.inc.php`, dán đoạn code sau vào:

```php
/* --- KẾT NỐI ĐẾN AIVEN MYSQL TỪ XA --- */
$i++;
$cfg['Servers'][$i]['host'] = 'mysql-ac7c52b-petadoption-php.f.aivencloud.com'; // Sửa thành Host của bạn
$cfg['Servers'][$i]['port'] = '14399'; // Sửa thành Port của bạn
$cfg['Servers'][$i]['connect_type'] = 'tcp';
$cfg['Servers'][$i]['extension'] = 'mysqli';
$cfg['Servers'][$i]['auth_type'] = 'cookie';
$cfg['Servers'][$i]['AllowNoPassword'] = false;
```
> **Lưu ý:** Nhớ thay thế giá trị `host` và `port` bằng thông số chính xác mà Aiven cấp cho bạn trong màn hình Overview.

### Bước 4: Đăng nhập
1. Lưu lại file `config.inc.php`.
2. Mở trình duyệt web và truy cập: `http://localhost/phpmyadmin` (Đảm bảo bạn đã Start Apache trên XAMPP).
3. Lúc này màn hình đăng nhập sẽ hiện ra cùng một khung chọn **Máy chủ (Server Choice)**.
   - **Để vào máy tính (Local):** Chọn máy chủ `127.0.0.1`, Username `root`, để trống Password.
   - **Để lên Aiven (Cloud):** Chọn máy chủ Aiven dài ngoằng, Username `avnadmin` và Password lấy từ Dashboard của Aiven.

---
📝 *Tài liệu này được soạn thảo để giúp Team phát triển dễ dàng quản lý chung một cơ sở dữ liệu khi dự án đã deploy.*
