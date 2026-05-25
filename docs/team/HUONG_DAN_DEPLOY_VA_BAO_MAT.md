# Hướng Dẫn Triển Khai Lên Render & Các Giải Pháp An Toàn Thông Tin (ATTT)

Tài liệu này được chuẩn bị nhằm phục vụ việc triển khai (deploy) dự án **Pet Adoption Management System** lên nền tảng **Render**, đồng thời trình bày các giải pháp đảm bảo An toàn thông tin (bảo mật) và phương pháp kiểm thử (testing) sau khi deploy để báo cáo bài tập lớn (BTL).

---

## 🚀 PHẦN 1: HƯỚNG DẪN TRIỂN KHAI DỰ ÁN LÊN RENDER

Render là một nền tảng Cloud Application Hosting hiện đại. Để chạy một dự án PHP Laravel 12 ổn định trên Render (vốn sử dụng môi trường Container), giải pháp tối ưu và chuyên nghiệp nhất là sử dụng **Docker**.

### 1. Chuẩn bị file cấu hình triển khai
Chúng ta cần tạo 2 file cấu hình ở thư mục gốc của dự án: `Dockerfile` và `.dockerignore`.

#### File 1: `Dockerfile` (Dành cho Laravel)
File này hướng dẫn Render cách đóng gói mã nguồn, cài đặt các thư viện PHP, Composer và chạy máy chủ Web (Apache/Nginx):

```dockerfile
FROM php:8.2-apache

# 1. Cài đặt các thư viện hệ thống cần thiết cho Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# 2. Bật mod_rewrite của Apache (bắt buộc cho Laravel routing)
RUN a2enmod rewrite

# 3. Thay đổi Document Root của Apache trỏ vào thư mục public/ của Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 4. Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Copy toàn bộ mã nguồn vào container
WORKDIR /var/www/html
COPY . .

# 6. Cài đặt các thư viện PHP (phục vụ môi trường chạy - production)
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 7. Phân quyền ghi cho các thư mục cache của Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 8. Cấu hình port chạy
EXPOSE 80
```

#### File 2: `.dockerignore`
Giúp bỏ qua các file rác hoặc file cấu hình local không cần đẩy vào container:
```text
.env
/vendor
/node_modules
/storage/framework/views/*.php
/storage/framework/sessions/*
/storage/logs/*.log
.git
```

---

### 2. Giải pháp Database khi deploy lên Render
Render cung cấp dịch vụ Database PostgreSQL miễn phí, nhưng không hỗ trợ MySQL miễn phí. Do đó, bạn có 2 lựa chọn:

* **Lựa chọn 1 (Khuyên dùng - Dễ nhất):** Sử dụng một dịch vụ cung cấp MySQL miễn phí bên ngoài như **Aiven.io**, **Clever Cloud**, hoặc **Tidb Cloud**. Bạn chỉ cần tạo tài khoản, tạo DB MySQL miễn phí trên đó và lấy thông tin kết nối (`Host`, `Username`, `Password`, `Port`) điền vào biến môi trường trên Render.
* **Lựa chọn 2:** Chuyển cấu hình kết nối của Laravel sang PostgreSQL (Render hỗ trợ native). Laravel hỗ trợ ORM nên việc chuyển đổi hệ quản trị DB cực kỳ đơn giản, chỉ cần đổi cấu hình `DB_CONNECTION=pgsql` trên Render.

---

### 3. Các bước deploy trên Dashboard của Render
1. Push toàn bộ code dự án lên **GitHub** (nhớ là không đẩy file `.env` lên).
2. Tạo tài khoản trên **Render.com** và liên kết với tài khoản GitHub của bạn.
3. Trên Render Dashboard, bấm **New +** -> Chọn **Web Service**.
4. Chọn repository chứa dự án Pet Adoption của bạn.
5. Cấu hình các thông số sau:
   * **Name:** `pet-adoption-management`
   * **Environment:** chọn **Docker** (Render sẽ tự động quét file `Dockerfile` ở trên để build).
   * **Instance Type:** chọn **Free** (Miễn phí).
6. Click vào tab **Environment** trên Render và thêm các biến cấu hình quan trọng sau (y hệt file `.env` local của bạn):
   * `APP_ENV` = `production`
   * `APP_DEBUG` = `false` *(Cực kỳ quan trọng để bảo mật)*
   * `APP_KEY` = `base64:xxxx...` *(Chạy lệnh php artisan key:generate ở máy local lấy chuỗi mã hóa điền vào)*
   * `DB_CONNECTION` = `mysql`
   * `DB_HOST` = `<Địa_chỉ_host_DB_bên_ngoài>`
   * `DB_PORT` = `3306`
   * `DB_DATABASE` = `<Tên_DB>`
   * `DB_USERNAME` = `<Tên_đăng_nhập_DB>`
   * `DB_PASSWORD` = `<Mật_khẩu_DB>`
7. Bấm **Create Web Service** và đợi Render biên dịch và cấp tên miền chạy thử nghiệm (dạng `xxx.onrender.com`).

---

## 🛡️ PHẦN 2: CÁC GIẢI PHÁP ĐẢM BẢO AN TOÀN THÔNG TIN (ATTT)

Đây là phần lý thuyết và thực hành cực kỳ đắt giá để ghi điểm trong báo cáo BTL. Bạn hãy trình bày các giải pháp này chia làm 3 tầng chính:

### 1. Giải pháp bảo mật ở mức Ứng Dụng (Laravel Application)
Laravel mặc định đã là một Framework có độ bảo mật rất cao. Chúng ta tận dụng và cấu hình tối ưu các tính năng sau:

* **Tắt chế độ Debug khi lên môi trường thật (`APP_DEBUG=false`):** 
  * *Tác dụng:* Khi web bị lỗi, nó sẽ hiển thị trang lỗi thân thiện 500 thay vì hiển thị toàn bộ code nguồn, cấu hình database và mật khẩu lên màn hình (Ngăn chặn lỗi rò rỉ thông tin - Information Disclosure).
* **Phòng chống tấn công SQL Injection:**
  * *Giải pháp:* Dự án sử dụng hoàn toàn **Eloquent ORM** và **Query Builder** của Laravel. Các công cụ này mặc định sử dụng kỹ thuật *PDO parameter binding* (truyền tham số an toàn) giúp vô hiệu hóa hoàn toàn việc chèn lệnh SQL độc hại vào input.
* **Phòng chống tấn công Cross-Site Scripting (XSS):**
  * *Giải pháp:* Sử dụng trình biên dịch Blade với cú pháp `{{ $variable }}`. Laravel sẽ tự động chạy hàm lọc ký tự đặc biệt `htmlspecialchars()` trước khi in ra trình duyệt, ngăn chặn kẻ tấn công chèn các mã Javascript độc hại nhằm đánh cắp Cookie người dùng.
* **Phòng chống tấn công Cross-Site Request Forgery (CSRF):**
  * *Giải pháp:* Bắt buộc áp dụng Middleware bảo vệ CSRF của Laravel. Mọi form gửi yêu cầu lên (`POST`, `PUT`, `DELETE`) đều phải chứa thẻ ẩn `@csrf` chứa token bảo mật ngẫu nhiên.
* **Bảo mật lưu trữ mật khẩu:**
  * *Giải pháp:* Toàn bộ mật khẩu của Admin, Staff và User đều được băm bằng thuật toán bảo mật mạnh mẽ **Bcrypt** (thông qua hàm `Hash::make()` của Laravel) trước khi lưu vào DB. Ngay cả khi hacker lấy được DB, họ cũng không thể giải mã ngược lại mật khẩu thực tế.
* **Giới hạn số lần yêu cầu (Rate Limiting):**
  * *Giải pháp:* Sử dụng cấu hình Throttle trên các API và router nhạy cảm (như chức năng đăng nhập) nhằm ngăn chặn việc dò mật khẩu tự động (tấn công Brute Force). Giới hạn tối đa 5 lần thử đăng nhập mỗi phút.

### 2. Giải pháp bảo mật ở mức Hạ Tầng (Hosting & Network)
Khi đưa lên Render, chúng ta có các lớp bảo vệ:

* **Mã hóa dữ liệu truyền tải với HTTPS (SSL/TLS):**
  * *Giải pháp:* Render tự động cấp phát và gia hạn chứng chỉ SSL miễn phí của tổ chức **Let's Encrypt**. Toàn bộ dữ liệu truyền qua lại giữa trình duyệt người dùng và máy chủ Render đều được mã hóa trên đường truyền (Tránh tấn công nghe lén - Man-in-the-Middle).
* **Ẩn thư mục gốc của hệ thống (Document Root):**
  * *Giải pháp:* Cấu hình máy chủ Apache chỉ trỏ trực tiếp vào thư mục `/public`. Kẻ tấn công không có cách nào truy cập trực tiếp vào các file nhạy cảm ở thư mục gốc như file cấu hình `.env`, mã nguồn hay các file log hệ thống.
* **Sử dụng dịch vụ lưu trữ bên thứ ba cho File Upload:**
  * *Vấn đề trên Cloud:* Render sử dụng cơ chế ổ đĩa tạm (Ephemeral disk) trên gói miễn phí, nghĩa là file ảnh thú cưng do người dùng upload lên thư mục `storage` sẽ bị xóa sạch mỗi lần container restart.
  * *Giải pháp ATTT & kỹ thuật:* Sử dụng dịch vụ **Cloudinary** hoặc **Amazon S3** để lưu trữ các file upload của người dùng. Dịch vụ này vừa bảo vệ máy chủ chính tránh bị tải lên các file mã độc (như file `.php` độc hại) chạy trực tiếp trên server, vừa đảm bảo dữ liệu không bị mất mát.

---

## 🔍 PHẦN 3: PHƯƠNG PHÁP KIỂM THỬ HOST (HOST TESTING)

Để chứng minh hệ thống của bạn sau khi deploy là an toàn, chạy nhanh và chịu tải tốt, bạn có thể thực hiện 3 bài kiểm thử (Testing) sau và chụp ảnh đưa vào báo cáo BTL:

### 1. Kiểm thử bảo mật (Security Testing)

* **Công cụ quét lỗ hổng bảo mật: OWASP ZAP (Zed Attack Proxy)**
  * *Cách làm:* Tải công cụ miễn phí OWASP ZAP về máy. Nhập link web Render của bạn vào và thực hiện quét tự động (Automated Scan).
  * *Kết quả cần đạt:* Báo cáo của OWASP ZAP chỉ ra không có lỗi bảo mật mức độ Nghiêm trọng (High), các cảnh báo nhẹ (Low/Medium) liên quan đến tiêu đề bảo mật HTTP có thể dễ dàng giải trình trong báo cáo.
* **Đánh giá tiêu đề bảo mật bằng Mozilla Observatory:**
  * *Cách làm:* Truy cập trang web trực tuyến [observatory.mozilla.org](https://observatory.mozilla.org/) và nhập URL trang web Render vào để quét.
  * *Ý nghĩa:* Đo lường độ an toàn cấu hình tiêu đề HTTP nhằm chống các cuộc tấn công nhúng iframe độc hại (Clickjacking), chống giả mạo MIME type.
* **Kiểm tra độ bảo mật đường truyền SSL/TLS bằng SSL Labs:**
  * *Cách làm:* Truy cập [ssllabs.com/ssltest/](https://www.ssllabs.com/ssltest/) để quét domain của bạn. Do Render quản lý SSL rất tốt, bạn sẽ dễ dàng nhận được điểm số **A** hoặc **A+** về chất lượng mã hóa đường truyền.

### 2. Kiểm thử hiệu năng và chịu tải (Performance & Load Testing)

Do gói Render miễn phí (Free) có cấu hình khá giới hạn (0.1 CPU, 512MB RAM), việc kiểm thử chịu tải là rất cần thiết để tìm ra giới hạn của server:

* **Kiểm thử hiệu năng trang bằng Google Lighthouse:**
  * *Cách làm:* Mở trang web Render của bạn trên Chrome -> Nhấn `F12` -> Chọn tab **Lighthouse** -> Bấm **Analyze page load**.
  * *Kết quả:* Chụp ảnh màn hình điểm số Lighthouse về Hiệu năng (Performance), SEO, Khả năng truy cập (Accessibility) và Các phương pháp tốt nhất (Best Practices).
* **Kiểm thử chịu tải bằng công cụ K6 (Load Testing):**
  * *Cách làm:* Viết một đoạn mã script ngắn bằng k6 giả lập **50 - 100 người dùng truy cập đồng thời** vào trang web Render trong vòng 5 phút.
  * *Kết quả:* Xem thời gian phản hồi trung bình (Response Time) và tỷ lệ yêu cầu thành công là bao nhiêu %. Điều này chứng minh máy chủ chịu tải tốt ở mức độ sử dụng thông thường của dự án.
