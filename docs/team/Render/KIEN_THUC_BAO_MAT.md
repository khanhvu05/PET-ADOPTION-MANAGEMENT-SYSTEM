# Cẩm Nang Kiến Thức Bảo Mật & An Toàn Thông Tin (Web Security)

Tài liệu này tổng hợp toàn bộ các kiến thức nền tảng, cơ chế kỹ thuật và giải pháp an toàn thông tin (ATTT) được áp dụng trực tiếp trong dự án **Pet Adoption Management System (Laravel 12 & MySQL)** nhằm bảo vệ hệ thống trước các cuộc tấn công mạng phổ biến. 

Tài liệu được thiết kế làm cẩm nang học tập cho nhóm và làm cơ sở nội dung cho phần **"Đảm bảo An toàn thông tin trên website"** trong báo cáo Bài tập lớn (BTL).

---

## 🔒 PHẦN 1: BẢO MẬT MỨC ỨNG DỤNG (APPLICATION SECURITY)

Bảo mật ứng dụng tập trung vào việc viết code an toàn và cấu hình tối ưu framework Laravel nhằm ngăn chặn các lỗ hổng phần mềm phổ biến (nằm trong danh mục **OWASP Top 10**).

### 1. Phòng Chống Tấn Công SQL Injection (SQLi)
* **Khái niệm:** SQL Injection xảy ra khi kẻ tấn công chèn các đoạn mã lệnh SQL độc hại vào các ô nhập liệu (input) nhằm can thiệp trực tiếp vào câu lệnh truy vấn database (ví dụ: đăng nhập không cần mật khẩu, xóa bảng dữ liệu).
* **Cơ chế phòng chống trong dự án:**
  * Toàn bộ mã nguồn dự án sử dụng **Eloquent ORM** và **Query Builder** của Laravel thay vì viết các câu lệnh SQL thuần ghép chuỗi (Raw SQL concatenation).
  * Laravel sử dụng cơ chế **PDO Parameter Binding** (liên kết tham số). Khi một giá trị được truyền qua Eloquent (ví dụ: `User::where('email', $email)->first()`), giá trị của biến `$email` sẽ được coi là một tham số thuần túy (literal value) chứ không phải là một phần của câu lệnh SQL. Mọi ký tự nguy hiểm như dấu nháy đơn `'`, nháy kép `"` đều bị vô hiệu hóa hoàn toàn trước khi gửi đến MySQL.

### 2. Phòng Chống Tấn Công Cross-Site Scripting (XSS)
* **Khái niệm:** XSS xảy ra khi kẻ tấn công tải lên hoặc lưu trữ một đoạn mã độc Javascript vào cơ sở dữ liệu của hệ thống. Khi người dùng khác truy cập trang web, trình duyệt của họ sẽ tự động thực thi đoạn mã độc này, dẫn đến nguy cơ bị đánh cắp Cookie, Session Token hoặc giả mạo giao diện để lừa đảo.
* **Cơ chế phòng chống trong dự án:**
  * Sử dụng cú pháp **`{{ $variable }}`** của Blade Template Engine khi in dữ liệu ra HTML.
  * Trình biên dịch Blade của Laravel sẽ tự động bọc mọi biến in ra bằng hàm `htmlspecialchars()` của PHP. Hàm này chuyển đổi các ký tự điều khiển HTML nguy hiểm thành các thực thể HTML an toàn:
    * Ký tự `<` chuyển thành `&lt;`
    * Ký tự `>` chuyển thành `&gt;`
    * Ký tự `&` chuyển thành `&amp;`
    * Ký tự `"` chuyển thành `&quot;`
  * Nhờ vậy, đoạn mã Javascript độc hại (như `<script>alert('hack')</script>`) khi hiển thị trên trình duyệt sẽ chỉ là chuỗi văn bản thông thường và hoàn toàn vô hại.

### 3. Phòng Chống Tấn Công Cross-Site Request Forgery (CSRF)
* **Khái niệm:** CSRF là cuộc tấn công giả mạo yêu cầu từ chính người dùng đã đăng nhập. Kẻ tấn công lừa nạn nhân nhấn vào một liên kết độc hại trên một trang web khác, liên kết này âm thầm gửi một yêu cầu thay đổi mật khẩu hoặc chuyển tiền đến trang web mục tiêu (nơi nạn nhân vẫn đang giữ phiên đăng nhập hợp lệ).
* **Cơ chế phòng chống trong dự án:**
  * Laravel bắt buộc áp dụng Middleware **`VerifyCsrfToken`** đối với toàn bộ các yêu cầu HTTP sử dụng phương thức ghi dữ liệu (`POST`, `PUT`, `PATCH`, `DELETE`).
  * Trong mọi form nhập liệu của dự án, bắt buộc khai báo chỉ thị `@csrf`. Laravel sẽ tự động sinh ra một input ẩn chứa một token bảo mật ngẫu nhiên (CSRF Token) duy nhất cho mỗi phiên làm việc của người dùng.
  * Khi form được gửi lên, Middleware sẽ đối chiếu token từ form và token trong Session của người dùng. Nếu không khớp hoặc thiếu token, hệ thống sẽ lập tức từ chối yêu cầu và trả về lỗi `419 Page Expired`.

### 4. Bảo Mật Lưu Trữ Mật Khẩu (Password Hashing)
* **Khái niệm:** Việc lưu mật khẩu dưới dạng văn bản thuần (Plaintext) là một sai lầm nghiêm trọng. Nếu database bị rò rỉ, toàn bộ tài khoản người dùng sẽ bị lộ.
* **Cơ chế phòng chống trong dự án:**
  * Toàn bộ mật khẩu của các vai trò (Admin, Staff, User) đều được băm bằng thuật toán bảo mật mạnh mẽ **Bcrypt** thông qua phương thức `Hash::make()` của Laravel.
  * Bcrypt sử dụng cơ chế tự động tạo chuỗi muối ngẫu nhiên (salt) tích hợp cho mỗi mật khẩu. Điều này có nghĩa là ngay cả khi hai người dùng đặt mật khẩu giống hệt nhau (ví dụ: `password`), chuỗi hash được lưu trong cơ sở dữ liệu của họ vẫn hoàn toàn khác nhau.
  * Thuật toán băm là một chiều (One-way hash), không có bất kỳ cách nào có thể giải mã ngược chuỗi hash trở lại mật khẩu ban đầu. Việc xác thực đăng nhập được thực hiện bằng cách băm mật khẩu người dùng vừa nhập và so sánh hai chuỗi băm với nhau (`Hash::check()`).

### 5. Ngăn Chặn Rò Rỉ Thông Tin Qua Chế Độ Debug (Debug Mode Leakage)
* **Khái niệm:** Khi phát triển ứng dụng ở máy local, chế độ Debug (`APP_DEBUG=true`) hiển thị chi tiết lỗi, dòng code bị sai, và thậm chí cả thông tin kết nối Database cùng các biến môi trường nhạy cảm. Đây là mỏ vàng đối với hacker nếu hệ thống chạy thực tế (Production).
* **Cơ chế phòng chống trong dự án:**
  * Trên môi trường chạy thực tế (Render), cấu hình biến môi trường **`APP_DEBUG=false`** và **`APP_ENV=production`**.
  * Khi xảy ra lỗi hệ thống không mong muốn, Laravel sẽ chỉ hiển thị một giao diện lỗi 500 chung chung, sạch sẽ và an toàn. Toàn bộ thông tin chi tiết lỗi (Stack Trace) sẽ được ghi lặng lẽ vào file log tại máy chủ (`storage/logs/laravel.log`) để lập trình viên tự kiểm tra, tuyệt đối không phơi bày ra ngoài.

### 6. Ngăn Chặn Tấn Công Dò Mật Khẩu (Rate Limiting / Brute Force)
* **Khái niệm:** Kẻ tấn công sử dụng các công cụ tự động để liên tục gửi hàng ngàn yêu cầu đăng nhập với các mật khẩu khác nhau nhằm dò tìm mật khẩu của quản trị viên (Admin).
* **Cơ chế phòng chống trong dự án:**
  * Áp dụng tính năng giới hạn lượt yêu cầu (**Rate Limiting Throttle**) tích hợp sẵn trong Route của Laravel.
  * Cấu hình mặc định giới hạn tối đa **5 lần thử đăng nhập sai liên tiếp trong vòng 1 phút** đối với một địa chỉ IP. Nếu vượt quá giới hạn, địa chỉ IP đó sẽ lập tức bị khóa tính năng đăng nhập trong vòng 60 giây tiếp theo, làm nản lòng và vô hiệu hóa hoàn toàn các công cụ dò quét tự động.

---

## 🌐 PHẦN 2: BẢO MẬT MỨC HẠ TẦNG & MÔI TRƯỜNG (INFRASTRUCTURE & NETWORK)

Bảo mật hạ tầng bảo vệ máy chủ chứa mã nguồn, đường truyền dữ liệu và cách lưu trữ các cấu hình nhạy cảm.

### 1. Mã Hóa Đường Truyền Bằng HTTPS (SSL/TLS)
* **Khái niệm:** Khi sử dụng giao thức HTTP thông thường, mọi dữ liệu (bao gồm cả mật khẩu đăng nhập của Admin) truyền giữa trình duyệt và máy chủ đều là văn bản thuần. Bất kỳ ai ở cùng mạng Wi-Fi hoặc các nút mạng trung gian đều có thể đọc lén được dữ liệu này (Tấn công nghe lén - *Man-in-the-Middle*).
* **Cơ chế triển khai:**
  * Khi deploy dự án lên nền tảng **Render**, Render tự động cấu hình chứng chỉ bảo mật **SSL/TLS** miễn phí thông qua tổ chức uy tín toàn cầu **Let's Encrypt**.
  * Toàn bộ dữ liệu truyền tải trên mạng sẽ được mã hóa bất đối xứng trước khi gửi đi, đảm bảo tính toàn vẹn và tuyệt mật của thông tin.

### 2. Cô Lập Thư Mục Gốc & Ngăn Chặn Duyệt Thư Mục trái phép (Directory Traversal)
* **Khái niệm:** Lỗ hổng duyệt thư mục cho phép kẻ tấn công truy cập vào các file cấu hình hệ thống nằm ngoài thư mục web công khai để đọc trộm code hoặc mật khẩu.
* **Cơ chế triển khai:**
  * Cấu hình Document Root của máy chủ web (như Apache trong Dockerfile) trỏ thẳng vào thư mục `/public` của Laravel chứ không trỏ vào thư mục gốc của dự án.
  * Thư mục `/public` chỉ chứa các tài nguyên tĩnh như CSS, JS, hình ảnh công khai và file chạy duy nhất `index.php`. Toàn bộ mã nguồn cốt lõi (Controllers, Models, Views) và đặc biệt là file cấu hình nhạy cảm chứa mật khẩu `.env` đều nằm ở các thư mục cha phía trên. Kẻ tấn công trên internet hoàn toàn không có đường dẫn hay quyền truy cập trực tiếp đến các file nhạy cảm này.

### 3. Bảo Mật Các Biến Môi Trường (.env Isolation)
* **Khái niệm:** File `.env` chứa toàn bộ các bí mật của hệ thống như khóa bảo mật ứng dụng `APP_KEY`, mật khẩu database `DB_PASSWORD`, thông tin tài khoản mail. Nếu đẩy file này lên GitHub, bất kỳ ai cũng có thể đọc được và chiếm quyền kiểm soát toàn bộ hệ thống.
* **Cơ chế triển khai:**
  * Thêm file `.env` vào file `.gitignore` để Git bỏ qua file này trong mọi lần commit.
  * Khi deploy lên **Render**, toàn bộ các giá trị cấu hình bảo mật được nhập thủ công trực tiếp vào mục **Environment Variables** trên Dashboard quản trị của Render. Các giá trị này được Render mã hóa an toàn và chỉ cung cấp riêng cho Container chạy ứng dụng dưới dạng các biến môi trường hệ thống.

### 4. Bảo Mật File Upload & Chống Mã Độc (Secure File Upload)
* **Khái niệm:** Chức năng cho phép người dùng tải lên ảnh thú cưng có thể bị hacker lợi dụng để tải lên các file mã độc PHP (ví dụ file `shell.php`). Nếu máy chủ web cho phép thực thi file PHP này trong thư mục tải lên, hacker sẽ chiếm toàn quyền điều khiển máy chủ (Remote Code Execution).
* **Cơ chế triển khai:**
  * Sử dụng dịch vụ lưu trữ bên thứ 3 là **Cloudinary** hoặc **Amazon S3** để làm nơi lưu trữ các file hình ảnh thú cưng do người dùng tải lên.
  * Các file tải lên sẽ được chuyển thẳng sang máy chủ lưu trữ của bên thứ ba chứ không lưu trên ổ cứng của máy chủ web chính. Đồng thời, các dịch vụ này chỉ lưu trữ file dưới dạng tài nguyên tĩnh (Static assets), không hỗ trợ thực thi bất kỳ đoạn mã script hay mã PHP nào từ file đó, triệt tiêu hoàn toàn nguy cơ chạy file độc hại.

---

## 🔍 PHẦN 3: PHƯƠNG PHÁP KIỂM THỬ AN TOÀN THÔNG TIN (SECURITY TESTING)

Để đánh giá và chứng minh hệ thống của bạn thực sự an toàn sau khi triển khai lên máy chủ thật, chúng ta áp dụng các phương pháp và công cụ kiểm thử chuẩn quốc tế sau:

### 1. Quét Lỗ Hổng Bảo Mật Tự Động (Automated Vulnerability Scanning)
* **Công cụ sử dụng:** **OWASP ZAP (Zed Attack Proxy)**
* **Mô tả:** Đây là công cụ quét bảo mật mã nguồn mở hàng đầu thế giới được đề xuất bởi tổ chức OWASP.
* **Cách thực hiện:** 
  1. Cài đặt OWASP ZAP trên máy local.
  2. Điền URL trang web đã deploy trên Render của bạn vào mục *Quick Start*.
  3. Bấm nút **Attack** để công cụ tiến hành thu thập thông tin (spidering) và thực hiện các cuộc tấn công thử nghiệm (active scanning) như chèn mã SQLi, XSS thử nghiệm vào các input trên trang web của bạn.
  4. Xuất báo cáo kết quả quét (chụp lại màn hình các lỗi được tìm thấy để đưa vào báo cáo BTL). Mục tiêu đạt được: Không có cảnh báo mức nguy hiểm (High/Critical).

### 2. Kiểm Tra Cấu Hình Tiêu Đề Bảo Mật HTTP (HTTP Security Headers Check)
* **Công cụ sử dụng:** **Mozilla Observatory** (Tiêu chuẩn của Mozilla)
* **Cách thực hiện:** Truy cập trang web [observatory.mozilla.org](https://observatory.mozilla.org/) và nhập domain trang web của bạn vào để quét trực tuyến.
* **Mục đích:** Đánh giá xem máy chủ web của bạn có được cấu hình các tiêu đề bảo mật để chống các kiểu tấn công như nhúng khung iframe giả mạo (Clickjacking), chặn tải tài nguyên từ nguồn không tin cậy (Content Security Policy) hay không, từ đó tối ưu hóa cấu hình an toàn cho máy chủ.

### 3. Kiểm Tra Chất Lượng Mã Hóa SSL/TLS
* **Công cụ sử dụng:** **Qualys SSL Labs (SSL Server Test)**
* **Cách thực hiện:** Truy cập [ssllabs.com/ssltest/](https://www.ssllabs.com/ssltest/) và nhập địa chỉ trang web của bạn vào.
* **Mục đích:** Công cụ sẽ phân tích chi tiết chứng chỉ SSL/TLS được cài đặt trên Render, kiểm tra xem máy chủ có sử dụng các thuật toán mã hóa mạnh mẽ và phiên bản giao thức an toàn (TLS 1.2, TLS 1.3) hay không. Nhờ hạ tầng bảo mật tốt của Render, kết quả trả về thường sẽ đạt điểm tuyệt đối **A** hoặc **A+**, chứng minh đường truyền dữ liệu của dự án được bảo vệ an toàn tối đa.
