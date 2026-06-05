# Tài liệu Đặc tả Nghiệp vụ (SRS) - Module Khảo Sát Nhận Nuôi (Survey Module)

## 1. Giới thiệu chung
Module Khảo sát nhận nuôi là một phần quan trọng trong quy trình xét duyệt đơn nhận nuôi thú cưng (Module M2). Mục đích của module này là thu thập các thông tin chi tiết về điều kiện sống, kinh nghiệm, và mức độ phù hợp của người nộp đơn đối với thú cưng mà họ muốn nhận nuôi.

## 2. Bài toán thực tế và Giải pháp thiết kế
Trong nghiệp vụ thực tế, bộ câu hỏi khảo sát người nhận nuôi thường xuyên thay đổi tùy thuộc vào chính sách của trạm cứu hộ (ví dụ: thêm câu hỏi mới về dịch bệnh, thay đổi câu hỏi cho chó/mèo khác nhau). 

Nếu thiết kế theo **mô hình Tĩnh (Static - fix cứng các cột trong Database)**, ví dụ tạo các cột `Cau_1`, `Cau_2`, hệ thống sẽ vô cùng khó bảo trì. Mỗi lần đổi câu hỏi, lập trình viên phải sửa cấu trúc Database (Migration) và sửa lại code giao diện (View).

Do đó, hệ thống đã được thiết kế theo mô hình **Khảo sát Động (EAV - Entity Attribute Value) kết hợp định dạng JSON** thông qua 2 bảng `adoption_questions` và `adoption_answers`. Mô hình này cho phép:
1. Tạo ra vô số câu hỏi với các định dạng khác nhau (text tự do, chọn 1 - single choice, chọn nhiều - multi choice).
2. Tích hợp trực tiếp các đáp án lựa chọn (options) vào trường JSON `Cac_lua_chon` của bảng câu hỏi, giúp giảm bớt số lượng bảng liên kết dư thừa (không cần bảng `adoption_options` riêng biệt).
3. Dễ dàng mở rộng trong tương lai mà không làm thay đổi hay phá vỡ cấu trúc Database hiện tại.

## 3. Kiến trúc dữ liệu (Database Schema)
Hệ thống lưu trữ khảo sát qua 2 bảng chính:

1. **`adoption_questions` (Bảng Câu hỏi)**: Lưu trữ nội dung câu hỏi, loại câu hỏi (text, radio, checkbox), các lựa chọn (dạng JSON), trạng thái bắt buộc, thứ tự hiển thị. Cột `Hoat_dong` giúp Admin tạm ẩn câu hỏi mà không làm mất lịch sử dữ liệu cũ.
2. **`adoption_answers` (Bảng Câu trả lời)**: Lưu trữ câu trả lời gắn liền với một Đơn đăng ký (`Ma_don`) và một Câu hỏi (`Ma_cau_hoi`). Câu trả lời tự do lưu ở cột `Noi_dung_tra_loi` (TEXT), còn câu trả lời trắc nghiệm được lưu thành mảng trong cột `Lua_chon_da_chon` (JSON).

*(Xem chi tiết cấu trúc bảng và index tại file `database/CSDL.md`)*

## 4. Hướng tiếp cận hiện tại (v1.0) và Định hướng phát triển tương lai

**Phiên bản hiện tại (v1.0): "Data-driven Static UI"**
Do thời hạn của đồ án, ở phiên bản v1.0 này, chức năng giao diện Quản trị (CRUD) các câu hỏi dành cho Admin tạm thời được tinh giản. 
- Thay vào đó, bộ 9 câu hỏi chuẩn được **khởi tạo sẵn (hard-code data) thông qua Database Seeding** khi dựng hệ thống.
- Form hiển thị khảo sát ngoài Frontend được render trực tiếp dựa trên việc đọc dữ liệu từ bảng `adoption_questions`.
- Lựa chọn thiết kế này là một thủ thuật tối ưu hóa thời gian lập trình (đáp ứng MVP - Sản phẩm khả dụng tối thiểu) nhưng vẫn bảo toàn được kiến trúc CSDL cực kỳ linh hoạt và có khả năng mở rộng.

**Định hướng phát triển trong tương lai:**
- **Không yêu cầu tái cấu trúc Database:** Cấu trúc cơ sở dữ liệu hiện tại đã đáp ứng 100% tính Động (Dynamic).
- **Phát triển UI/UX:** Hệ thống chỉ cần xây dựng bổ sung một module giao diện Quản trị (Admin UI) với các thao tác Thêm/Sửa/Xóa/Ẩn (CRUD) gọi trực tiếp tới bảng `adoption_questions`. 
- Khi đó, nền tảng sẽ lập tức trở thành một hệ thống Dynamic Survey hoàn chỉnh, cho phép người quản lý trạm cứu hộ tự do sáng tạo và thiết lập các chiến dịch khảo sát mới mà không cần bất kỳ sự can thiệp nào từ đội ngũ Lập trình viên.
