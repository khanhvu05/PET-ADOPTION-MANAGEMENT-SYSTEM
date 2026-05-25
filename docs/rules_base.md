# Quy Tắc Phát Triển Dự Án Tiêu Chuẩn (Project Rules Base)

Tài liệu này định nghĩa hệ thống quy tắc cốt lõi về **MVC (Model-View-Controller)**, **OOP (Object-Oriented Programming)** và **Tính độc lập của tính năng (Feature Isolation)** trong dự án **PetAdoption**. 

> [!IMPORTANT]
> **CHỈ THỊ BẮT BUỘC:** Bất kỳ thành viên nào (kể cả AI Agent) trước khi bắt đầu đọc/viết mã nguồn của dự án này đều **PHẢI ĐỌC QUA** và **TUÂN THỦ TUYỆT ĐỐI** các quy tắc được định nghĩa trong file này.

---

## 1. Quy Tắc Kiến Trúc MVC & OOP Chuẩn

Để mã nguồn dễ đọc, dễ mở rộng và dễ bảo trì cho việc học tập, toàn bộ dự án phải tuân thủ nghiêm ngặt các tiêu chuẩn sau:

### 1.1. Model (Lớp Thực Thể & Dữ Liệu)
*   **Quy tắc 1 (OOP Encapsulation):** Mọi thuộc tính của bảng cơ sở dữ liệu phải được biểu diễn qua Eloquent Model. Các hành động kiểm tra trạng thái của đối tượng phải được viết thành phương thức hướng đối tượng (ví dụ: `isAdmin()`, `isStaff()`, `hasAdopted()`) thay vì so sánh chuỗi thô ngoài View hoặc Controller.
*   **Quy tắc 2 (Fat Model, Skinny Controller):** Các logic nghiệp vụ thuần túy về mặt truy vấn dữ liệu (ví dụ: lọc thú cưng theo độ tuổi, tìm kiếm nâng cao) phải được định nghĩa dưới dạng **Query Scopes** (ví dụ: `scopeActive($query)`) trong Model thay vì viết chuỗi truy vấn phức tạp trong Controller.
*   **Quy tắc 3 (An Toàn Dữ Liệu - Mass Assignment Protection):** Tuyệt đối không khai báo `$guarded = []` rỗng trên Model nhằm tránh lỗ hổng bảo mật gán hàng loạt (Mass Assignment Vulnerability). Phải liệt kê tường minh các trường được phép sửa đổi trong mảng `$fillable`.

### 1.2. Controller (Lớp Điều Hướng & Điều Phối)
*   **Quy tắc 4 (Single Responsibility - Nguyên lý Đơn Nhiệm):** Mỗi Controller chỉ xử lý các tác vụ thuộc một phạm vi nghiệp vụ cụ thể. Không gộp chung logic quản lý người dùng thường và các tác vụ của Quản trị viên vào một Controller.
*   **Quy tắc 5 (No Business Logic & Dependency Injection):** 
    *   Controller chỉ làm nhiệm vụ nhận dữ liệu đầu vào (đã qua kiểm tra), phối hợp dữ liệu và trả về View/Redirect/JSON.
    *   Sử dụng cơ chế **Dependency Injection (DI)** thông qua Constructor hoặc Method Parameter để đưa các Service, Repository hoặc Form Request vào Controller một cách tự động, tăng tính module hóa và dễ viết Unit Test.
*   **Quy tắc 6 (Strict Return Types - Định Kiểu Trả Về Tường Minh):** Mọi phương thức trong Controller bắt buộc phải khai báo kiểu dữ liệu trả về một cách tường minh (ví dụ: `: View`, `: RedirectResponse`, `: JsonResponse`) nhằm nâng cao độ tin cậy của lập trình hướng đối tượng (OOP Strong Typing).

### 1.3. View (Lớp Biểu Diễn Trực Quan)
*   **Quy tắc 7 (No Database Query in Views):** Tuyệt đối cấm viết các truy vấn SQL thô hoặc gọi trực tiếp Model từ file `.blade.php`. View chỉ hiển thị dữ liệu đã được truyền từ Controller hoặc Blade Components.
*   **Quy tắc 8 (Component-Driven & Layout Inheritance):** 
    *   Giao diện phải được thiết lập dựa trên kế thừa Layout gốc (`layouts/app.blade.php`) thông qua `@slot` hoặc kế thừa cấu trúc.
    *   Chia nhỏ giao diện thành các **Blade Components** tái sử dụng cao (ví dụ: `<x-text-input>`). Cấu hình tường minh các tham số đầu vào bằng `@props`.

---

## 2. Quy Tắc Cô Lập Tính Năng (Feature Isolation)

Mỗi chức năng khi phát triển mới **không được phép** ảnh hưởng đến tiến trình hoặc tính đúng đắn của các chức năng hiện có:

### 2.1. Độc Lập Về Route (Isolated Routing)
*   **Quy tắc 9 (Route Sandboxing):** Các nhóm tính năng khác nhau phải được cách ly rõ ràng bằng Middleware hoặc Tiền tố URL (Prefix) trong `routes/web.php` (ví dụ: Nhóm Route của Admin, nhóm Route của Staff, nhóm Route cá nhân).
*   Tuyệt đối không dùng chung một Endpoint cho hai hành vi có mục đích khác nhau.

### 2.2. Độc Lập Về Xác Thực Dữ Liệu (Isolated Request Validation)
*   **Quy tắc 10 (Encapsulated Form Requests):** Mỗi hành động gửi biểu mẫu (Form Submission) phải sử dụng một lớp **Form Request** riêng biệt (ví dụ: `ProfileUpdateRequest`, `UpdatePasswordRequest`).
*   Việc xác thực dữ liệu thất bại ở chức năng này **phải được cách ly hoàn toàn**, chỉ hiển thị lỗi tương ứng trên túi lỗi cục bộ (ví dụ: `$errors->updatePassword` hoặc `$errors->userDeletion`) để không gây ảnh hưởng hay làm mất dữ liệu của các form khác trên cùng một trang.

### 2.3. Độc Lập Về Dữ Liệu (Isolated Database Mutation)
*   Mọi thay đổi dữ liệu trong cơ sở dữ liệu phải thông qua cơ chế Transaction (`DB::transaction`) nếu liên quan đến nhiều bảng, đảm bảo dữ liệu luôn nhất quán (Tính toàn vẹn ACID).
*   Khi thực hiện xoá dữ liệu, hãy ưu tiên sử dụng cơ chế **Soft Deletes** (`Illuminate\Database\Eloquent\SoftDeletes`) để tránh làm hỏng các ràng buộc khoá ngoại (Foreign Key Constraints) của các tính năng khác liên quan.

---

## 3. Tiêu Chuẩn Thực Hành Tốt Nhất (Laravel Clean Coding Best Practices)

### 3.1. Cấm Gọi env() Trực Tiếp (No Direct Environment Calls)
*   **Quy tắc 11:** Tuyệt đối không gọi trực tiếp hàm `env('KEY')` ngoài các file cấu hình trong thư mục `config/`. 
*   *Lý do:* Khi chạy lệnh tối ưu hóa cấu hình `php artisan config:cache` trong môi trường chạy thực tế (Production), hàm `env()` sẽ trả về `null`. Tất cả các biến môi trường bắt buộc phải được đọc qua file cấu hình rồi truy cập bằng hàm `config('file.key')`.

### 3.2. Không Thay Đổi Migration Cũ (Immutable Migrations)
*   **Quy tắc 12:** Khi dự án đã đi vào hoạt động thực tế (hoặc code đã được đồng bộ lên Git của nhóm), tuyệt đối không được phép chỉnh sửa trực tiếp các file Migration cũ đã chạy. Phải tạo một file Migration mới để sửa đổi cấu trúc bảng (ví dụ: `database/migrations/xxxx_add_column_to_table.php`).
*   *Ngoại lệ:* Chỉ cho phép sửa file migration ban đầu trong giai đoạn khởi tạo cục bộ khi chưa thiết lập và phân phối cơ sở dữ liệu (Local Draft).

---

## 4. Quản Lý Lỗi & Học Tập Chủ Động (Post-Mortem & Error Learning)

### 4.1. Quy Tắc Ghi Nhận Lỗi (Rule 13 - The Post-Mortem Rule)
*   Sau khi kết thúc thiết kế và lập trình bất kỳ tính năng nào, nếu có lỗi phát sinh trong quá trình biên dịch (Vite compilation), lỗi cú pháp (Syntax errors), biệt lệ PHP/Laravel (Exceptions), hoặc lỗi logic nghiệp vụ:
    *   **Bắt buộc phải ghi nhận** vào thư mục quản lý lỗi của dự án tại `docs/handling_error/`.
    *   Mỗi ghi nhận lỗi phải làm rõ các cấu trúc:
        1.  **Mô tả lỗi:** Chi tiết mã lỗi (Error Code/Exception), môi trường xảy ra.
        2.  **Nguyên nhân gốc rễ (Root Cause):** Tại sao lỗi xảy ra (sai cú pháp, thiếu import, lỗi logic liên kết...).
        3.  **Cách khắc phục (Resolution):** Mã nguồn sửa đổi, các lệnh kiểm tra đã chạy.
        4.  **Bài học đúc kết (Lessons Learned):** Quy tắc phòng tránh để không lặp lại lỗi này lần thứ hai.
*   *Ý nghĩa:* Biến mỗi bug phát sinh trong quá trình code thành một cơ hội học tập tích cực, giúp lập trình viên (và các AI Agent cộng tác) ngày càng hoàn thiện kỹ năng và giảm thiểu tối đa tỉ lệ lỗi ở các tính năng tiếp theo.

---

## 5. Tiêu Chuẩn Thiết Kế Giao Diện Tối Giản (Minimalist UI Standards)

Để duy trì tính đồng bộ thẩm mỹ cao chuẩn `minimalist-ui`:
1.  **Phối màu phấn nhạt (Washed-out Pastels):** Chỉ sử dụng màu sắc để chỉ thị trạng thái. Tuyệt đối không dùng màu gốc sặc sỡ cho các khối giao diện lớn.
2.  **Đường viền mỏng tinh tế:** Thay thế tất cả bóng đổ nặng bằng đường kẻ mảnh `border-[#EAEAEA]` hoặc `border-gray-100`.
3.  **Typography tương phản:** Tiêu đề dùng font Serif (Instrument Serif), mô tả dùng Sans-serif (Geist) và thông tin kỹ thuật/mã số dùng Monospace (Geist Mono).
4.  **Không biểu tượng cảm xúc (No Emojis):** Không chèn emoji vào code, text hiển thị hay bình luận. Sử dụng biểu tượng SVG thô tối giản hoặc icon hệ thống.

---

*Tài liệu này được cập nhật định kỳ mỗi khi có tiêu chuẩn lập trình mới được áp dụng.*
