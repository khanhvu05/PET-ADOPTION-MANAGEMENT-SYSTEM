Dưới đây là nội dung bảng Từ điển WBS của dự án. Hãy giúp tôi xuất nội dung này thành một file Word (.docx) hoàn chỉnh.

Yêu cầu định dạng:
1. Sử dụng style bảng mặc định, chuyên nghiệp của Word (có viền kẻ rõ ràng).
2. Tự động gộp ô (Merge cells) theo chiều dọc ở cột "Giai đoạn chính" cho các hàng nằm trong cùng một giai đoạn để bảng dễ nhìn hơn.
3. Chữ in đậm cho các mục Level 1 và Level 2 (như trong bảng).
4. Phía dưới bảng ghi chú thích: "**Bảng 9: Từ điển WBS hệ thống PetJam**" (căn giữa).

Nội dung bảng cần xuất:

| Giai đoạn chính | Hạng mục công việc (WBS Code) | Ý nghĩa & Mô tả chi tiết |
|---|---|---|
| **1. QUẢN LÝ DỰ ÁN**<br>*(Quản lý toàn bộ dự án từ lập kế hoạch đến giám sát tiến độ)* | 1.1. Lập kế hoạch | Xác định các bước cần thực hiện và lập kế hoạch chi tiết cho từng công việc. |
| | 1.2. Quản lý phạm vi | Giới hạn dự án trong các yêu cầu đã đề ra, tránh mở vượt ngoài phạm vi. |
| | 1.3. Quản lý thời gian | Lên lịch và giám sát để đảm bảo dự án đúng tiến độ. |
| | 1.4. Quản lý chi phí | Kiểm soát ngân sách, tối ưu hoá chi phí dự án. |
| | 1.5. Quản lý chất lượng | Đảm bảo sản phẩm đạt tiêu chuẩn chất lượng yêu cầu. |
| | 1.6. Quản lý nhân lực | Điều phối và phân bổ nguồn nhân lực phù hợp với từng công việc. |
| | 1.7. Quản lý rủi ro | Xác định và xử lý các rủi ro có thể ảnh hưởng đến tiến độ dự án. |
| **2. THU THẬP & PHÂN TÍCH**<br>*(Lấy yêu cầu từ người dùng và hệ thống)* | 2.1. Yêu cầu người dùng | Xác định các nhu cầu và mong muốn của người dùng cuối đối với hệ thống. |
| | 2.2. Yêu cầu hệ thống | Xác định các yêu cầu kỹ thuật để đảm bảo hệ thống hoạt động ổn định. |
| | 2.3. Mô hình hóa yêu cầu | Xây dựng các biểu đồ (UML/Use Case) để làm rõ quy trình nghiệp vụ. |
| **3. THIẾT KẾ**<br>*(Thiết kế giao diện và kiến trúc dữ liệu)* | **3.1. Thiết kế giao diện** | **Thiết kế trải nghiệm (UX) và giao diện (UI) thân thiện, dễ sử dụng.** |
| | 3.1.1. Giao diện Khách hàng | Thiết kế giao diện người dùng cuối (trang chủ, danh sách, form nhận nuôi). |
| | 3.1.2. Giao diện Admin/Staff | Thiết kế giao diện quản trị viên để quản lý dữ liệu, phê duyệt hồ sơ. |
| | **3.2. Thiết kế CSDL** | **Xây dựng cấu trúc cơ sở dữ liệu cho hệ thống.** |
| | 3.2.1. Mức khái niệm | Thiết kế mô hình dữ liệu ở mức khái niệm, xác định các thực thể chính. |
| | 3.2.2. Mức logic | Thiết kế mô hình ở mức logic, mô tả các mối quan hệ giữa các đối tượng. |
| | 3.2.3. Mức vật lý | Thiết kế vật lý, xác định cách lưu trữ dữ liệu trong hệ quản trị CSDL. |
| **4. PHÁT TRIỂN**<br>*(Lập trình và triển khai các tính năng)* | **4.1. Xác thực người dùng** | **Phát triển các module liên quan đến định danh người dùng.** |
| | 4.1.1. Đăng ký | Lập trình chức năng cho phép khách hàng tạo tài khoản mới. |
| | 4.1.2. Đăng nhập / Đăng xuất | Lập trình chức năng đăng nhập an toàn và đóng phiên làm việc. |
| | 4.1.3. Quên mật khẩu | Lập trình chức năng khôi phục mật khẩu tài khoản qua email. |
| | **4.2. Chức năng Khách hàng** | **Phát triển luồng nghiệp vụ tương tác frontend dành cho khách hàng.** |
| | 4.2.1. Tìm kiếm thú cưng | Lập trình chức năng tìm kiếm, lọc thú cưng theo tiêu chí (giống, tuổi). |
| | 4.2.2. Gửi đơn nhận nuôi | Lập trình form điền hồ sơ và gửi yêu cầu xin nhận nuôi trực tuyến. |
| | 4.2.3. Ủng hộ & Gây quỹ | Lập trình chức năng thanh toán đóng góp tài chính qua cổng VNPAY. |
| | 4.2.4. Chatbot tư vấn AI | Tích hợp Chatbot AI hỗ trợ tự động giải đáp các quy trình, thắc mắc. |
| | 4.2.5. Quản lý hồ sơ cá nhân | Lập trình chức năng theo dõi lịch sử nhận nuôi và sửa thông tin cá nhân. |
| | **4.3. Quản trị & Nhân viên** | **Phát triển các module backend điều hành tổ chức cứu hộ.** |
| | 4.3.1. Dashboard & Thống kê | Xây dựng bảng điều khiển báo cáo doanh thu, số lượng đơn, hoạt động. |
| | 4.3.2. Quản lý hồ sơ thú cưng | Lập trình chức năng thêm, sửa, xoá và cập nhật tình trạng thú cưng. |
| | 4.3.3. Quản lý đơn nhận nuôi | Lập trình chức năng kiểm duyệt, từ chối và xử lý hồ sơ xin nhận nuôi. |
| | 4.3.4. Quản lý lịch phỏng vấn | Lập trình tính năng đặt lịch hẹn phỏng vấn ứng viên và gửi thông báo. |
| | 4.3.5. Quản lý quỹ & Chiến dịch | Lập trình chức năng quản lý dòng tiền và thiết lập chiến dịch gây quỹ. |
| | 4.3.6. Quản lý người dùng | Lập trình chức năng xem, sửa, khoá/mở khoá danh sách tài khoản. |
| | 4.3.7. Phân quyền hệ thống | Lập trình phân quyền chi tiết (RBAC) cấp quyền từng chức năng. |
| | 4.3.8. Cài đặt hệ thống | Lập trình chức năng thay đổi cấu hình, thông tin liên hệ của website. |
| **5. KIỂM THỬ**<br>*(Đảm bảo phần mềm không có lỗi)* | 5.1. Kế hoạch kiểm thử | Lập kế hoạch xác định các module cần test trong hệ thống. |
| | 5.2. Kiểm thử đơn vị | Viết và thực hiện Unit Test cho từng chức năng. |
| | 5.3. Kiểm thử tích hợp | Viết và thực hiện Integration Test đảm bảo tương tác giữa các module. |
| | 5.4. Biên bản kiểm thử | Viết biên bản báo cáo về các trường hợp lỗi và kết quả sau kiểm thử. |
| | 5.5. Sửa lỗi & điều chỉnh | Fix bugs, tối ưu hệ thống dựa trên báo cáo kiểm thử. |
| **6. TRIỂN KHAI**<br>*(Đưa hệ thống vào sử dụng)* | 6.1. Cài đặt môi trường | Thiết lập cơ sở hạ tầng, môi trường server (hosting/VPS) cần thiết. |
| | 6.2. Triển khai server | Cài đặt website lên môi trường thực tế (production), đưa vào hoạt động. |
| | 6.3. Đào tạo người dùng | Hướng dẫn admin và nhân viên tổ chức cách sử dụng hệ thống. |
| | 6.4. Bàn giao sản phẩm | Bàn giao toàn bộ source code hệ thống cùng tài liệu kỹ thuật. |
| **7. BẢO TRÌ**<br>*(Duy trì sự ổn định)* | 7.1. Hỗ trợ người dùng | Trực tiếp giải đáp vướng mắc trong quá trình vận hành hệ thống. |
| | 7.2. Khắc phục sự cố | Sửa chữa nhanh các lỗi downtime phát sinh trên môi trường thực tế. |
| | 7.3. Nâng cấp tính năng | Phát triển và nâng cấp thêm chức năng mới dựa trên phản hồi. |
