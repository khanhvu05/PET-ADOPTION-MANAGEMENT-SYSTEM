# HỌC VIỆN NGÂN HÀNG
## KHOA CÔNG NGHỆ THÔNG TIN & KINH TẾ SỐ

# TÀI LIỆU ĐẶC TẢ YÊU CẦU PHẦN MỀM
## Software Requirements Specification (SRS)
# HỆ THỐNG QUẢN LÝ CỨU HỘ VÀ NHẬN NUÔI THÚ CƯNG (PETJAM)

| Thuộc tính | Thông tin |
|---|---|
| Phiên bản | 1.2 |
| Ngày cập nhật | 10/06/2026 |
| Dựa trên | SRS v1.0 (01/06/2026) |
| Trạng thái | Bản cập nhật chính thức |
| Chuẩn tham chiếu | IEEE 830-1998 |

---

## CHƯƠNG 1. GIỚI THIỆU

### 1.1 Mục đích tài liệu

Tài liệu này mô tả đầy đủ các yêu cầu chức năng và phi chức năng của Hệ thống Quản lý Cứu hộ và Nhận nuôi Thú cưng – PETJAM phiên bản 1.2. Tài liệu được viết theo chuẩn IEEE 830-1998 nhằm:

- Làm cơ sở thỏa thuận giữa nhóm phát triển và các bên liên quan về phạm vi và chức năng hệ thống.
- Cung cấp nền tảng cho thiết kế, lập trình, kiểm thử và bàn giao sản phẩm.
- Hỗ trợ đánh giá và kiểm tra chất lượng phần mềm sau khi hoàn thiện.

### 1.2 Phạm vi hệ thống

Hệ thống PETJAM là một ứng dụng web phục vụ hoạt động cứu hộ, chăm sóc và nhận nuôi thú cưng tại các trung tâm cứu hộ động vật. Hệ thống bao gồm 6 module chức năng chính:

- **M1 – Quản lý hồ sơ thú cưng:** Lưu trữ thông tin thú cưng, ca cứu hộ và lịch sử tiêm chủng.
- **M2 – Nhận nuôi:** Tiếp nhận đơn đăng ký nhận nuôi, quản lý slot lịch phỏng vấn theo 2 giai đoạn và gửi email xác nhận.
- **M3 – Quản lý ủng hộ:** Tiếp nhận và quản lý giao dịch ủng hộ tiền qua cổng thanh toán VNPay.
- **M4 – Quản lý người dùng & phân quyền:** Quản lý tài khoản và phân quyền theo mô hình RBAC với hai vai trò Admin và User.
- **M5 – Chatbox hỗ trợ:** Widget chat tích hợp AI API hỗ trợ hỏi đáp, điều hướng giao diện, và phân tích ảnh thú cưng. Chatbox hiển thị cho cả Admin và User đã đăng nhập.

**Hệ thống KHÔNG bao gồm:**

- Ủng hộ hiện vật (đồ dùng, thức ăn,...).
- Đăng nhập bằng nhận diện khuôn mặt.
- Quản lý hồ sơ khám bệnh, phẫu thuật, chăm sóc tạm thời.
- Ký hợp đồng điện tử hay bàn giao thú cưng trực tuyến.
- Tính năng AI phân loại spam đơn nhận nuôi (đã loại bỏ trong v1.2).

### 1.3 Đối tượng đọc

| Đối tượng | Mục đích sử dụng tài liệu |
|---|---|
| Nhóm phát triển (Dev, BA) | Hiểu yêu cầu để thiết kế và lập trình |
| Tester / QA | Xây dựng test case từ các yêu cầu |
| Quản lý dự án | Lập kế hoạch, theo dõi tiến độ |
| Giảng viên hướng dẫn | Đánh giá chất lượng phân tích và thiết kế |
| Admin trung tâm cứu hộ | Xác nhận yêu cầu nghiệp vụ |

### 1.4 Thuật ngữ & Định nghĩa

| Thuật ngữ / Viết tắt | Định nghĩa |
|---|---|
| SRS | Software Requirements Specification – Đặc tả yêu cầu phần mềm |
| FR | Functional Requirement – Yêu cầu chức năng |
| NFR | Non-Functional Requirement – Yêu cầu phi chức năng |
| RBAC | Role-Based Access Control – Kiểm soát truy cập theo vai trò |
| UUID | Universally Unique Identifier – Mã định danh duy nhất toàn cục |
| VNPay | Cổng thanh toán điện tử phổ biến tại Việt Nam |
| AI | Artificial Intelligence – Trí tuệ nhân tạo |
| Admin | Quản trị viên hệ thống, có toàn quyền |
| User | Người dùng đăng ký tài khoản để tham gia nhận nuôi hoặc ủng hộ |
| PETJAM | Tên hệ thống quản lý cứu hộ và nhận nuôi thú cưng |
| Phí nhận nuôi | Tổng chi phí cứu hộ + chi phí tiêm chủng mà người nhận nuôi cần thanh toán |
| bcrypt | Thuật toán băm mật khẩu một chiều được sử dụng trong hệ thống |
| Slot lịch | Khung giờ phỏng vấn cố định do Admin tạo trong bảng interview_slots |
| Groq API | API của Groq sử dụng model LLaMA cho tính năng Chatbox M5 |
| Token usage | Lượng token AI tiêu thụ, được theo dõi theo từng tài khoản mỗi tuần |

### 1.5 Tài liệu tham khảo

- IEEE Std 830-1998 – IEEE Recommended Practice for Software Requirements Specifications.
- PETJAM_SRS_v1_0.pdf – Tài liệu SRS phiên bản 1.0 ngày 01/06/2026.
- PETJAM_SRS_DB_Changes_v1_2.docx – Tài liệu phân tích thay đổi DB & SRS phiên bản 1.2.
- NỘI_DUNG_2.pdf – Tài liệu thiết kế cơ sở dữ liệu Chương 3, phiên bản nội bộ nhóm.
- Hội thoại làm rõ nghiệp vụ giữa nhóm phát triển – biên bản Q&A, tháng 06/2026.
- Tài liệu kỹ thuật VNPay – https://sandbox.vnpayment.vn/apis/docs/
- Tài liệu Groq API – https://console.groq.com/docs
- Tài liệu Laravel – https://laravel.com/docs

---

## CHƯƠNG 2. YÊU CẦU TỔNG QUÁT

### 2.1 Bối cảnh hệ thống

Nhiều trung tâm cứu hộ động vật tại Việt Nam hiện vận hành theo phương thức thủ công: ghi chép hồ sơ thú cưng bằng giấy, tiếp nhận đơn nhận nuôi qua mạng xã hội và xử lý ủng hộ tiền mặt không có hệ thống theo dõi. Điều này dẫn đến dữ liệu phân tán, khó kiểm soát và tốn nhiều nhân lực.

PETJAM được xây dựng nhằm số hóa toàn bộ quy trình, từ tiếp nhận thú cưng cứu hộ đến bàn giao cho người nhận nuôi, đồng thời tích hợp VNPay để tiếp nhận ủng hộ trực tuyến và AI Chatbox để hỗ trợ người dùng điều hướng và tư vấn thú cưng.

### 2.2 Giả định & Ràng buộc

#### 2.2.1 Giả định

- Hệ thống triển khai trên môi trường web, người dùng truy cập qua trình duyệt.
- Người dùng có kết nối Internet ổn định khi thực hiện các thao tác chính.
- Dữ liệu thú cưng và người dùng được nhập thủ công bởi Admin.
- Mỗi tài khoản User tương ứng một người thật và chịu trách nhiệm pháp lý về thông tin đăng ký.
- Tính năng Chatbox (M5) sử dụng Groq API với model LLaMA hỗ trợ vision. API key được Admin cung cấp và quản lý.

#### 2.2.2 Ràng buộc

- Hệ thống chỉ hỗ trợ thanh toán qua cổng VNPay (không hỗ trợ MoMo, ZaloPay hoặc thẻ quốc tế trong phiên bản này).
- Ngôn ngữ giao diện: Tiếng Việt.
- Mọi dữ liệu nhạy cảm (mật khẩu, thông tin cá nhân) phải được mã hóa hoặc băm trước khi lưu.
- Hệ thống phải tuân thủ Luật An toàn thông tin mạng Việt Nam (Luật số 86/2015/QH13).
- Phiên bản này không hỗ trợ ứng dụng di động native (iOS/Android).
- API key Groq tuyệt đối không được expose ra phía client; chỉ được gọi server-side.

### 2.3 Đặc điểm người dùng

| Vai trò | Mô tả | Kỹ năng kỹ thuật |
|---|---|---|
| Admin | Quản trị viên hệ thống: quản lý toàn bộ dữ liệu, người dùng, phân quyền và chiến dịch. Cấu hình API key và hạn mức token chatbox. | Thành thạo máy tính, hiểu nghiệp vụ hệ thống |
| User | Người dùng thông thường: đăng ký nhận nuôi, theo dõi đơn, ủng hộ chiến dịch, sử dụng chatbox hỗ trợ. | Biết sử dụng web cơ bản |

### 2.4 Môi trường chạy

| Thành phần | Yêu cầu / Công nghệ |
|---|---|
| Frontend (Blade Template) | Laravel Blade hoặc kết hợp Vite + Alpine.js/Vue.js; hỗ trợ Chrome, Firefox, Edge (2 phiên bản gần nhất) |
| Backend | PHP 8.x + Laravel 10/11, REST API (Laravel Sanctum cho xác thực) |
| Cơ sở dữ liệu | MySQL 8.x hoặc PostgreSQL 15+, hỗ trợ UUID và TIMESTAMP; quản lý migration qua Artisan |
| ORM | Eloquent ORM (tích hợp sẵn Laravel) |
| Lưu trữ phụ | database.json (hoặc bảng Laravel cache/storage) cho cấu hình chatbox (weeklyTokenLimit, userTokenUsage) |
| Thanh toán | VNPay API tích hợp qua Laravel HTTP Client (sandbox và production) |
| AI Chatbox | Groq API với model LLaMA hỗ trợ vision; gọi server-side qua Laravel HTTP Client; cấu hình qua .env GROQ_API_KEYS |
| Email | Laravel Mail + SMTP / Mailtrap (dev) / SendGrid (production) để gửi email xác nhận, link chọn slot, đặt lại mật khẩu |
| Queue | Laravel Queue (database driver hoặc Redis) để xử lý gửi email bất đồng bộ |
| Triển khai | Máy chủ Linux (Apache/Nginx), HTTPS bắt buộc, SSL/TLS, hỗ trợ PHP-FPM |
| Build tool | Composer (PHP dependencies), npm + Vite (frontend assets) |
| Trình duyệt tối thiểu | Chrome 100+, Firefox 100+, Edge 100+ |

---

## CHƯƠNG 3. YÊU CẦU CHỨC NĂNG

### 3.1 Module M1 – Quản lý hồ sơ thú cưng

#### 3.1.1 FR-001 – Thêm mới hồ sơ thú cưng

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-001 |
| Tên chức năng | Thêm mới hồ sơ thú cưng |
| Mô tả | Admin phải tạo được hồ sơ thú cưng mới với đầy đủ thông tin nhận dạng và tình trạng sức khỏe. |
| Đầu vào | Họ tên, loài, giống, nhóm tuổi, cân nặng, giới tính, tình trạng tiêm phòng, triệt sản, trạng thái, vị trí, 3 boolean thân thiện, chế độ ăn đặc biệt, ngày tiếp nhận, mô tả, người phụ trách. |
| Xử lý | Hệ thống phải sinh UUID tự động cho Ma_thu_cung và Ma_hien_thi. Phí nhận nuôi mặc định bằng 0. Hệ thống phải ghi nhận Ngay_tao và Ngay_cap_nhat. |
| Đầu ra | Hồ sơ thú cưng mới được lưu vào bảng pets. Hiển thị thông báo thành công. |
| Luồng thay thế | Nếu thiếu trường bắt buộc (Ten, Ngay_tiep_nhan), hệ thống phải hiển thị thông báo lỗi và không lưu dữ liệu. |

#### 3.1.2 FR-002 – Cập nhật hồ sơ thú cưng

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-002 |
| Tên chức năng | Cập nhật hồ sơ thú cưng |
| Mô tả | Admin phải chỉnh sửa được thông tin thú cưng đã tồn tại trong hệ thống. |
| Đầu vào | Ma_thu_cung (định danh bản ghi cần sửa) và các trường cần cập nhật. |
| Xử lý | Hệ thống phải cập nhật các trường được truyền vào và tự động ghi nhận Ngay_cap_nhat. Trường Phi_nhan_nuoi không được chỉnh sửa trực tiếp – hệ thống tự tính lại khi chi phí thay đổi. |
| Đầu ra | Dữ liệu thú cưng được cập nhật. Hiển thị thông báo thành công. |
| Luồng thay thế | Nếu Ma_thu_cung không tồn tại, hệ thống phải trả về lỗi 404. |

#### 3.1.3 FR-003 – Tìm kiếm và lọc danh sách thú cưng

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-003 |
| Tên chức năng | Tìm kiếm và lọc danh sách thú cưng |
| Mô tả | Người dùng (User, Admin) phải tìm kiếm và lọc thú cưng theo nhiều tiêu chí. |
| Đầu vào | Các tham số lọc tùy chọn: tên, loài, giống, nhóm tuổi, giới tính, trạng thái, vị trí, nổi bật. |
| Xử lý | Hệ thống phải trả về danh sách thú cưng khớp với tất cả điều kiện lọc. Hỗ trợ phân trang (mặc định 10 bản ghi/trang). Kết quả sắp xếp theo Ngay_tiep_nhan giảm dần. |
| Đầu ra | Danh sách thú cưng với đầy đủ thông tin cơ bản và số trang. |
| Luồng thay thế | Nếu không có kết quả, hiển thị thông báo "Không tìm thấy thú cưng phù hợp". |

#### 3.1.4 FR-004 – Quản lý ca cứu hộ

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-004 |
| Tên chức năng | Quản lý ca cứu hộ |
| Mô tả | Admin phải tạo, xem và cập nhật trạng thái ca cứu hộ liên kết với thú cưng. |
| Đầu vào | Ma_thu_cung, ngày cứu hộ, địa điểm, loại tình huống, người báo cáo, người thực hiện, chi phí, ghi chú. |
| Xử lý | Hệ thống phải lưu ca cứu hộ với UUID tự động. Sau khi lưu, hệ thống phải tự động cộng Chi_phi_cuu_ho vào Phi_nhan_nuoi của bảng pets tương ứng. |
| Đầu ra | Ca cứu hộ được lưu trong bảng rescue_cases. Phi_nhan_nuoi của thú cưng được cập nhật. |
| Luồng thay thế | Nếu Ma_thu_cung không tồn tại, hệ thống phải từ chối và hiển thị lỗi. |

#### 3.1.5 FR-005 – Quản lý lịch sử tiêm chủng

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-005 |
| Tên chức năng | Quản lý lịch sử tiêm chủng |
| Mô tả | Admin phải ghi nhận lịch tiêm vắc-xin cho thú cưng và hệ thống phải tự cập nhật phí nhận nuôi. |
| Đầu vào | Ma_thu_cung, tên vắc-xin, ngày tiêm, ngày tiêm nhắc tiếp theo, người thực hiện, nơi tiêm, chi phí. |
| Xử lý | Hệ thống lưu bản ghi tiêm chủng với UUID tự động. Sau khi lưu, cộng Chi_phi vào Phi_nhan_nuoi. Cập nhật Da_tiem_phong = TRUE nếu thú cưng có ít nhất 1 lịch tiêm. |
| Đầu ra | Bản ghi tiêm chủng mới trong vaccination_history. Phi_nhan_nuoi và Da_tiem_phong được cập nhật. |
| Luồng thay thế | Nếu ngày tiêm nhắc nhỏ hơn ngày tiêm, hệ thống phải hiển thị lỗi xác thực. |

### 3.2 Module M2 – Nhận nuôi (Luồng 2 giai đoạn)

#### 3.2.1 FR-006 – Nộp đơn đăng ký nhận nuôi

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-006 |
| Tên chức năng | Nộp đơn đăng ký nhận nuôi |
| Mô tả | User đã đăng nhập phải điền và nộp đơn đăng ký nhận nuôi một thú cưng cụ thể. |
| Đầu vào | Ma_thu_cung, họ tên, số điện thoại, địa chỉ, nghề nghiệp, loại nhà ở, kinh nghiệm nuôi thú cưng, lý do nhận nuôi, cam kết (boolean). |
| Xử lý | Hệ thống phải xác thực toàn bộ trường bắt buộc. Sau khi lưu đơn với trạng thái 'pending', hệ thống chờ Admin xét duyệt sơ bộ. Một User chỉ được có 1 đơn đang chờ xử lý cho mỗi thú cưng. |
| Đầu ra | Đơn nhận nuôi mới trong bảng adoption_applications. Người dùng nhận thông báo "Đơn đang chờ admin xét duyệt". |
| Luồng thay thế | Nếu thú cưng có trạng thái 'da_nhan_nuoi' hoặc 'da_mat', hệ thống phải từ chối và thông báo thú cưng không còn sẵn sàng. |

#### 3.2.2 FR-007 – Xem và lọc danh sách đơn nhận nuôi

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-007 |
| Tên chức năng | Xem và lọc danh sách đơn nhận nuôi trên timeline |
| Mô tả | Admin phải xem danh sách đơn nhận nuôi trên giao diện timeline, có thể lọc theo trạng thái đơn. |
| Đầu vào | Tham số lọc tùy chọn: trang_thai (pending / pre_approved / approved / rejected / cancelled), ngày bắt đầu, ngày kết thúc. |
| Xử lý | Hệ thống trả về danh sách đơn kèm thông tin lịch phỏng vấn và trạng thái. Giao diện timeline theo Ngay_tao hoặc ngày duyệt đơn. |
| Đầu ra | Danh sách đơn với: họ tên, thú cưng, trạng thái đơn. |
| Luồng thay thế | Nếu không có đơn nào, hiển thị thông báo "Chưa có đơn nhận nuôi". |

#### 3.2.3 FR-008 – Duyệt / Từ chối đơn nhận nuôi (chính thức)

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-008 |
| Tên chức năng | Duyệt hoặc từ chối đơn nhận nuôi (chính thức) |
| Mô tả | Admin phải thay đổi trạng thái đơn nhận nuôi thành approved hoặc rejected sau khi phỏng vấn diễn ra. |
| Đầu vào | Ma_don, trạng thái mới (approved / rejected), ghi chú admin. |
| Xử lý | Hệ thống phải cập nhật Trang_thai của đơn. Nếu approved, cập nhật trạng thái thú cưng thành 'da_nhan_nuoi'. Ngay_cap_nhat được ghi nhận. |
| Đầu ra | Đơn nhận nuôi được cập nhật trạng thái. Trạng thái thú cưng được cập nhật nếu được duyệt. |
| Luồng thay thế | Nếu thú cưng đã có đơn approved khác, hệ thống phải cảnh báo trước khi xác nhận. |

#### 3.2.4 FR-009 – Admin duyệt sơ bộ đơn nhận nuôi

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-009 |
| Tên chức năng | Admin duyệt sơ bộ đơn nhận nuôi |
| Mô tả | Admin xem xét đơn và quyết định cho tiến hành phỏng vấn hay không (giai đoạn 1 của luồng nhận nuôi 2 giai đoạn). |
| Đầu vào | Ma_don, hành động (duyet_so_bo / tu_choi_som), ghi chú admin. |
| Xử lý | Nếu duyệt sơ bộ: Trang_thai = 'pre_approved', hệ thống tự tạo bản ghi interview_schedules và gửi email kèm link chọn lịch đến người đăng ký. Nếu từ chối sớm: Trang_thai = 'rejected'. |
| Đầu ra | Trạng thái đơn được cập nhật. Email kèm link chọn lịch gửi đến người đăng ký. |
| Luồng thay thế | Nếu gửi email thất bại: ghi log, Email_da_gui = FALSE, vẫn lưu trạng thái đơn. |

#### 3.2.5 FR-010 – Admin quản lý slot lịch phỏng vấn

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-010 |
| Tên chức năng | Admin quản lý slot lịch phỏng vấn |
| Mô tả | Admin tạo, sửa, xóa/hủy các slot cố định để người đăng ký chọn khi nhận được email link. |
| Đầu vào | Ngày, giờ bắt đầu, giờ kết thúc, số lượng tối đa, nhân viên xử lý; hoặc Ma_slot để sửa/hủy. |
| Xử lý | Hệ thống lưu vào bảng interview_slots. Slot đã có đăng ký không được xóa, chỉ được hủy (Trang_thai = 'huy'). |
| Đầu ra | Danh sách slot được cập nhật. Slot hiển thị khi khách truy cập link chọn lịch. |
| Luồng thay thế | Nếu Gio_ket_thuc <= Gio_bat_dau, hệ thống hiển thị lỗi xác thực. |

#### 3.2.6 FR-011 – Khách chọn lịch phỏng vấn từ link email

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-011 |
| Tên chức năng | Khách chọn lịch phỏng vấn từ link email |
| Mô tả | Người đăng ký truy cập link trong email, xem các slot còn chỗ và đăng ký một slot phù hợp. |
| Đầu vào | Token link email, Ma_slot được chọn (hoặc đề xuất thời gian linh hoạt nếu không có slot phù hợp). |
| Xử lý | Nếu chọn slot cố định: cập nhật interview_schedules với Ma_slot, Loai_lich = 'slot_co_dinh', Trang_thai = 'da_xac_nhan'; tăng So_luong_hien_tai. Nếu đề xuất lịch khác: Loai_lich = 'lich_khac', Trang_thai = 'cho_duyet', chờ Admin xác nhận. |
| Đầu ra | Lịch phỏng vấn được tạo/cập nhật. Email xác nhận gửi đến người đăng ký. |
| Luồng thay thế | Nếu token hết hạn hoặc đơn không còn ở trạng thái 'pre_approved', hiển thị thông báo lỗi phù hợp. |

### 3.3 Module M3 – Quản lý ủng hộ

#### 3.3.1 FR-012 – Tạo và quản lý chiến dịch gây quỹ

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-012 |
| Tên chức năng | Tạo và quản lý chiến dịch gây quỹ |
| Mô tả | Admin phải tạo, chỉnh sửa và đóng chiến dịch gây quỹ. |
| Đầu vào | Tiêu đề, mô tả, ảnh đại diện, số tiền mục tiêu (NULL = không giới hạn), ngày bắt đầu, ngày kết thúc (NULL = không giới hạn), trạng thái. |
| Xử lý | Hệ thống lưu chiến dịch với UUID tự động. So_tien_hien_tai mặc định = 0. Khi chiến dịch đóng (Trang_thai = 'closed'), hệ thống không cho phép nhận thêm giao dịch mới. |
| Đầu ra | Chiến dịch được lưu trong donation_campaigns. Hiển thị trên trang ủng hộ công khai. |
| Luồng thay thế | Nếu Ngay_ket_thuc < Ngay_bat_dau, hệ thống phải từ chối và thông báo lỗi. |

#### 3.3.2 FR-013 – Thực hiện giao dịch ủng hộ qua VNPay

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-013 |
| Tên chức năng | Thực hiện giao dịch ủng hộ qua VNPay |
| Mô tả | Người dùng (có hoặc không có tài khoản) phải ủng hộ tiền cho chiến dịch thông qua VNPay. |
| Đầu vào | Ma_chien_dich (tùy chọn), tên người ủng hộ, tùy chọn ẩn danh, số tiền (> 0 VND), lời nhắn (tùy chọn). |
| Xử lý | Hệ thống tạo bản ghi giao dịch với UUID duy nhất. Chuyển hướng đến cổng VNPay. Khi nhận callback, xác thực chữ ký HMAC-SHA512: nếu vnp_ResponseCode = '00' thì Trang_thai = 'success' và cộng dồn số tiền; ngược lại Trang_thai = 'failed'. |
| Đầu ra | Giao dịch được cập nhật trạng thái. So_tien_hien_tai của chiến dịch được cập nhật khi thành công. |
| Luồng thay thế | Nếu callback VNPay không có chữ ký hợp lệ, hệ thống phải từ chối cập nhật và ghi log cảnh báo bảo mật. |

#### 3.3.3 FR-014 – Xem lịch sử giao dịch ủng hộ

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-014 |
| Tên chức năng | Xem lịch sử giao dịch ủng hộ |
| Mô tả | Admin phải xem được danh sách toàn bộ giao dịch ủng hộ. User đã đăng nhập phải xem được lịch sử giao dịch của chính mình. |
| Đầu vào | Tham số lọc tùy chọn: Ma_chien_dich, trang_thai, khoảng thời gian, Ma_nguoi_dung (chỉ Admin). |
| Xử lý | Hệ thống trả về danh sách giao dịch phù hợp, sắp xếp theo Ngay_tao giảm dần. Thông tin người ủng hộ ẩn danh hiển thị là "Ẩn danh". |
| Đầu ra | Danh sách giao dịch với: tên người ủng hộ, số tiền, lời nhắn, trạng thái, thời điểm. |
| Luồng thay thế | User thông thường chỉ xem được giao dịch của chính mình; nếu cố truy cập giao dịch người khác, hệ thống phải trả về lỗi 403. |

### 3.4 Module M4 – Quản lý người dùng & Phân quyền

#### 3.4.1 FR-015 – Đăng ký tài khoản

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-015 |
| Tên chức năng | Đăng ký tài khoản |
| Mô tả | Người dùng mới phải đăng ký tài khoản với email và mật khẩu. |
| Đầu vào | Họ tên, email, mật khẩu, số điện thoại (tùy chọn), ngày sinh (tùy chọn), loại tài khoản (cá nhân / tổ chức). |
| Xử lý | Kiểm tra email chưa tồn tại trong cơ sở dữ liệu. Mật khẩu phải được băm bằng bcrypt trước khi lưu. Gán vai trò 'user' mặc định. Gửi email xác thực và đặt Email_da_xac_thuc = FALSE cho đến khi xác nhận. |
| Đầu ra | Tài khoản mới được tạo. Email xác thực được gửi. |
| Luồng thay thế | Nếu email đã tồn tại, hiển thị thông báo "Email đã được sử dụng". |

#### 3.4.2 FR-016 – Đăng nhập và xác thực

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-016 |
| Tên chức năng | Đăng nhập và xác thực |
| Mô tả | Người dùng đã có tài khoản phải đăng nhập bằng email và mật khẩu. |
| Đầu vào | Email, mật khẩu. |
| Xử lý | Hệ thống so sánh mật khẩu nhập vào với mật khẩu đã băm bằng bcrypt. Nếu khớp và tài khoản 'hoat_dong', sinh Laravel Sanctum token và trả về. Ghi nhật ký đăng nhập vào activity_logs. |
| Đầu ra | Token hợp lệ (Laravel Sanctum). Người dùng được chuyển đến trang chính. |
| Luồng thay thế | Sau 5 lần đăng nhập sai liên tiếp, hệ thống phải khóa tài khoản tạm thời trong 15 phút. |

#### 3.4.3 FR-017 – Quản lý tài khoản người dùng (Admin)

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-017 |
| Tên chức năng | Quản lý tài khoản người dùng |
| Mô tả | Admin phải xem, tạo, chỉnh sửa và khóa tài khoản người dùng trong hệ thống. |
| Đầu vào | Thông tin người dùng cần tạo hoặc cập nhật; Ma_nguoi_dung cho thao tác sửa/khóa. |
| Xử lý | Hệ thống cho phép Admin thực hiện CRUD đầy đủ trên bảng users. Thao tác khóa tài khoản chỉ cập nhật Trang_thai = 'bi_khoa', không xóa dữ liệu. |
| Đầu ra | Tài khoản được tạo/cập nhật/khóa. Mọi thao tác được ghi vào activity_logs. |
| Luồng thay thế | Admin không thể khóa tài khoản Admin duy nhất còn lại trong hệ thống. |

#### 3.4.4 FR-018 – Phân công và quản lý vai trò (RBAC)

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-018 |
| Tên chức năng | Phân công và quản lý vai trò |
| Mô tả | Admin phải gán và thu hồi vai trò cho người dùng, và cấu hình quyền hạn cho từng vai trò. |
| Đầu vào | Ma_nguoi_dung, Ma_vai_tro, ngày hết hạn (tùy chọn); hoặc Ma_vai_tro, Ma_quyen để cấu hình quyền. |
| Xử lý | Hệ thống lưu phân công vai trò vào bảng user_roles và quyền hạn vào role_permissions. Mọi thao tác phân quyền phải ghi nhận Nguoi_cap và Thoi_diem_cap. |
| Đầu ra | Vai trò và quyền hạn được cập nhật. Người dùng nhận quyền mới ngay trong phiên tiếp theo. |
| Luồng thay thế | Hệ thống phải không cho phép xóa vai trò hệ thống (La_vai_tro_he_thong = TRUE). |

#### 3.4.5 FR-019 – Đặt lại mật khẩu

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-019 |
| Tên chức năng | Đặt lại mật khẩu qua email |
| Mô tả | Người dùng quên mật khẩu phải yêu cầu đặt lại qua email. |
| Đầu vào | Email đã đăng ký. |
| Xử lý | Kiểm tra email tồn tại. Nếu có, sinh token ngẫu nhiên, lưu vào password_reset_tokens với Ngay_het_han = hiện tại + 15 phút, gửi email chứa link reset. Khi người dùng truy cập link, kiểm tra token còn hạn và chưa dùng, cho phép đặt mật khẩu mới, sau đó đánh dấu Da_su_dung = TRUE. |
| Đầu ra | Token được tạo và email reset được gửi. Mật khẩu được cập nhật sau xác nhận. |
| Luồng thay thế | Nếu token đã hết hạn hoặc đã dùng, hiển thị "Liên kết không hợp lệ hoặc đã hết hạn". |

#### 3.4.6 FR-020 – Ghi nhật ký hoạt động

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-020 |
| Tên chức năng | Ghi nhật ký hoạt động hệ thống |
| Mô tả | Hệ thống phải tự động ghi nhật ký mọi thao tác quan trọng của người dùng vào bảng activity_logs. |
| Đầu vào | Không yêu cầu đầu vào từ người dùng – hệ thống tự thu thập. |
| Xử lý | Với mỗi thao tác (tạo, cập nhật, xóa, đăng nhập, đăng xuất, phân quyền), hệ thống phải ghi: Ma_nguoi_dung, tài nguyên thao tác, hành động, chi tiết (JSON diff), địa chỉ IP và thời điểm. |
| Đầu ra | Bản ghi nhật ký trong bảng activity_logs. Admin có thể tra cứu lịch sử hoạt động theo người dùng và khoảng thời gian. |
| Luồng thay thế | Nếu ghi nhật ký thất bại, hệ thống phải tiếp tục xử lý thao tác chính và ghi log lỗi riêng, không làm gián đoạn trải nghiệm người dùng. |

### 3.5 Module M5 – Chatbox hỗ trợ người dùng

Module M5 bổ sung widget chat tích hợp AI API, đặt tại giao diện của cả Admin lẫn User. Chatbox hỗ trợ hỏi đáp thông thường, điều hướng giao diện PETJAM, và phân tích ảnh thú cưng. Mỗi lần gọi AI là một request độc lập, không lưu lịch sử hội thoại vào cơ sở dữ liệu.

#### 3.5.1 FR-021 – Gửi và nhận tin nhắn chatbox

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-021 |
| Tên chức năng | Gửi và nhận tin nhắn chatbox |
| Mô tả | Người dùng đã đăng nhập (Admin hoặc User) gửi tin nhắn văn bản và nhận phản hồi từ AI theo thời gian thực. |
| Đầu vào | Nội dung tin nhắn văn bản từ người dùng. userId lấy từ session hiện tại. |
| Xử lý | ① Kiểm tra hạn mức token tuần của userId. ② Nếu đã vượt weeklyTokenLimit → trả về thông báo hết hạn mức, không gọi API. ③ Nếu còn hạn mức → gọi Groq API server-side với system prompt + tin nhắn người dùng. ④ Nhận phản hồi AI, ghi bản ghi { userId, tokens, timestamp } vào userTokenUsage. |
| Đầu ra | Phản hồi AI hiển thị cho người dùng. Bản ghi tiêu thụ token được thêm vào database.json. |
| Luồng thay thế | Nếu API AI lỗi: hiển thị "Chatbot tạm thời không khả dụng". Nếu vượt hạn mức: hiển thị thông báo yêu cầu liên hệ Admin. |

#### 3.5.2 FR-022 – Điều hướng giao diện qua chatbox

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-022 |
| Tên chức năng | Điều hướng giao diện qua chatbox |
| Mô tả | AI chatbox nhận diện ý định điều hướng của người dùng và tự động chuyển trang hoặc cung cấp link đến trang phù hợp trong hệ thống PETJAM. |
| Đầu vào | Câu hỏi hoặc yêu cầu điều hướng từ người dùng (ví dụ: "xem thú cưng", "nộp đơn nhận nuôi", "xem lịch phỏng vấn"). |
| Xử lý | System prompt mô tả đầy đủ cấu trúc và các trang của PETJAM, kèm danh sách tool function (dieu_huong_trang, mo_form_dang_ky). AI nhận diện intent và gọi tool phù hợp để thực hiện điều hướng. |
| Đầu ra | Trang giao diện được chuyển đến trang liên quan. Chatbox hiển thị xác nhận hành động điều hướng. |
| Luồng thay thế | Nếu intent không rõ ràng: AI hỏi lại để làm rõ yêu cầu trước khi điều hướng. |

#### 3.5.3 FR-023 – Phân tích ảnh thú cưng qua chatbox

| Trường | Nội dung |
|---|---|
| Mã yêu cầu | FR-023 |
| Tên chức năng | Phân tích ảnh thú cưng qua chatbox |
| Mô tả | Người dùng đã đăng nhập upload ảnh thú cưng trong chatbox. AI phân tích và trả về mô tả đặc điểm, giống loài, tình trạng sức khỏe nhìn qua ảnh. |
| Đầu vào | File ảnh (JPG/PNG) do người dùng upload kèm câu hỏi phân tích (tùy chọn). Áp dụng cho cả Admin và User đã đăng nhập. |
| Xử lý | ① Xác thực người dùng đã đăng nhập. ② Server encode ảnh sang base64. ③ Gọi Groq API với message dạng multipart image + text (model phải hỗ trợ vision). ④ Nhận kết quả phân tích. ⑤ Ghi bản ghi token usage vào userTokenUsage. |
| Đầu ra | Kết quả phân tích ảnh hiển thị trong chatbox. Bản ghi tiêu thụ token được ghi nhận. |
| Luồng thay thế | Nếu model không hỗ trợ vision: hiển thị thông báo lỗi cụ thể. Nếu người dùng chưa đăng nhập: không hiển thị tính năng upload ảnh. |

---

## CHƯƠNG 4. YÊU CẦU PHI CHỨC NĂNG

### 4.1 Yêu cầu Hiệu suất

| Mã | Yêu cầu | Tiêu chí đo lường |
|---|---|---|
| NFR-001 | Thời gian phản hồi API thông thường | ≤ 2 giây cho 95% request dưới tải bình thường |
| NFR-002 | Thời gian phản hồi API tìm kiếm | ≤ 3 giây với dữ liệu ≤ 10.000 bản ghi thú cưng |
| NFR-003 | Thời gian phản hồi chatbox AI | ≤ 10 giây từ khi gửi tin nhắn đến khi có phản hồi AI |
| NFR-004 | Người dùng đồng thời | Hệ thống phải xử lý ≥ 200 người dùng đồng thời không giảm hiệu suất |
| NFR-005 | Thời gian tải trang | Trang chính phải tải hoàn toàn trong ≤ 3 giây trên kết nối 10 Mbps |
| NFR-006 | Xử lý callback VNPay | ≤ 1 giây từ lúc nhận callback đến khi cập nhật trạng thái giao dịch |

### 4.2 Yêu cầu Bảo mật

| Mã | Yêu cầu | Chi tiết |
|---|---|---|
| SEC-001 | Mã hóa mật khẩu | Mật khẩu phải được băm bằng bcrypt với cost factor ≥ 12 |
| SEC-002 | Xác thực Token | Mọi API yêu cầu xác thực phải sử dụng Laravel Sanctum Token với thời hạn ≤ 24 giờ |
| SEC-003 | HTTPS bắt buộc | Toàn bộ giao tiếp phải qua HTTPS/TLS 1.2 trở lên; HTTP phải bị chặn |
| SEC-004 | Phân quyền RBAC | Mọi endpoint phải kiểm tra quyền hạn theo vai trò trước khi xử lý |
| SEC-005 | Bảo vệ SQL Injection | Hệ thống phải dùng Eloquent ORM / Query Builder với prepared statements cho mọi truy vấn |
| SEC-006 | Xác thực callback VNPay | Hệ thống phải xác thực chữ ký HMAC-SHA512 trước khi xử lý callback |
| SEC-007 | Giới hạn đăng nhập | Khóa tài khoản 15 phút sau 5 lần đăng nhập sai liên tiếp (Laravel RateLimiter) |
| SEC-008 | Nhật ký bảo mật | Mọi thao tác nhạy cảm phải được ghi vào activity_logs kèm IP nguồn |
| SEC-009 | Bảo vệ XSS | Toàn bộ đầu vào người dùng phải được sanitize; Blade template tự động escape output |
| SEC-010 | Token đặt lại mật khẩu | Token có hiệu lực ≤ 15 phút và chỉ dùng được 1 lần |
| SEC-011 | Bảo mật API key Chatbox | Groq API key lưu trong .env server-side (GROQ_API_KEYS); tuyệt đối không expose ra client |
| SEC-012 | Giới hạn token chatbox | Mỗi tài khoản bị giới hạn tổng token tiêu thụ trong 7 ngày; Admin cấu hình ngưỡng toàn cục |
| SEC-013 | CSRF Protection | Laravel CSRF token bắt buộc cho tất cả các form POST/PUT/DELETE |

### 4.3 Yêu cầu Độ tin cậy

| Mã | Yêu cầu | Tiêu chí đo lường |
|---|---|---|
| NFR-007 | Độ khả dụng | Hệ thống phải đạt uptime ≥ 99.5% / tháng (cho phép tối đa ~3.6 giờ downtime) |
| NFR-008 | Sao lưu dữ liệu | Cơ sở dữ liệu phải được sao lưu tự động mỗi 24 giờ; lưu trữ tối thiểu 30 ngày |
| NFR-009 | Thời gian phục hồi | RTO ≤ 4 giờ |
| NFR-010 | Điểm phục hồi | RPO ≤ 24 giờ |
| NFR-011 | Tính nhất quán giao dịch | Giao dịch VNPay phải đảm bảo ACID; không ghi nhận thanh toán nếu chưa xác nhận thành công từ VNPay |

### 4.4 Yêu cầu Khả năng Mở rộng

| Mã | Yêu cầu |
|---|---|
| NFR-012 | Kiến trúc phải cho phép mở rộng theo chiều ngang (horizontal scaling) khi số lượng người dùng tăng |
| NFR-013 | Cơ sở dữ liệu phải hỗ trợ phân vùng (partitioning) bảng activity_logs khi dữ liệu vượt 1 triệu bản ghi |
| NFR-014 | Thiết kế API phải theo chuẩn RESTful (Laravel Resource Routes) để dễ tích hợp với ứng dụng di động trong tương lai |
| NFR-015 | Module Chatbox M5 phải được thiết kế theo kiến trúc có thể thay thế model AI/provider khác mà không ảnh hưởng module khác |

### 4.5 Yêu cầu Khả năng Sử dụng

| Mã | Yêu cầu |
|---|---|
| NFR-016 | Giao diện phải hỗ trợ đầy đủ trên màn hình desktop (≥ 1024px) và tablet (≥ 768px) |
| NFR-017 | Thông báo lỗi phải bằng tiếng Việt, mô tả rõ nguyên nhân và cách khắc phục |
| NFR-018 | Tất cả form nhập liệu phải có xác thực phía client trước khi gửi lên server |
| NFR-019 | Hệ thống phải hiển thị loading indicator khi thao tác mất hơn 1 giây |
| NFR-020 | Email gửi tự động (xác nhận lịch, xác thực tài khoản, link chọn slot) phải đến hộp thư trong ≤ 2 phút |
| NFR-021 | Widget chatbox phải hiển thị trạng thái loading khi đang chờ phản hồi AI; không được freeze giao diện |

---

## CHƯƠNG 5. MA TRẬN PHÂN QUYỀN

> **Ký hiệu:** ✓ = Có quyền | ✗ = Không có quyền | Chỉ mình = Chỉ dữ liệu của chính mình

| Chức năng / Tài nguyên | Admin | User |
|---|:---:|:---:|
| M1 – Xem danh sách thú cưng | ✓ | ✓ |
| M1 – Thêm / Sửa hồ sơ thú cưng | ✓ | ✗ |
| M1 – Xóa hồ sơ thú cưng | ✓ | ✗ |
| M1 – Quản lý ca cứu hộ | ✓ | ✗ |
| M1 – Quản lý lịch sử tiêm chủng | ✓ | ✗ |
| M2 – Nộp đơn nhận nuôi (FR-006) | ✗ | ✓ |
| M2 – Xem đơn của chính mình | ✓ | Chỉ mình |
| M2 – Xem tất cả đơn / timeline (FR-007) | ✓ | ✗ |
| M2 – Duyệt / Từ chối chính thức (FR-008) | ✓ | ✗ |
| M2 – Duyệt sơ bộ đơn nhận nuôi (FR-009) | ✓ | ✗ |
| M2 – Quản lý slot lịch phỏng vấn (FR-010) | ✓ | ✗ |
| M2 – Chọn lịch từ link email (FR-011) | ✗ | ✓ |
| M3 – Tạo / Sửa chiến dịch ủng hộ | ✓ | ✗ |
| M3 – Xem chiến dịch ủng hộ | ✓ | ✓ |
| M3 – Thực hiện giao dịch ủng hộ | ✓ | ✓ |
| M3 – Xem tất cả giao dịch | ✓ | ✗ |
| M3 – Xem giao dịch của mình | ✓ | Chỉ mình |
| M4 – Quản lý tài khoản người dùng | ✓ | ✗ |
| M4 – Phân công vai trò / quyền | ✓ | ✗ |
| M4 – Xem nhật ký hoạt động | ✓ | ✗ |
| M4 – Đăng ký / Đăng nhập | ✓ | ✓ |
| M4 – Đặt lại mật khẩu của mình | ✓ | ✓ |
| M4 – Sửa thông tin cá nhân của mình | ✓ | ✓ |
| M5 – Sử dụng chatbox / nhắn tin (FR-021) | ✓ | ✓ |
| M5 – Điều hướng qua chatbox (FR-022) | ✓ | ✓ |
| M5 – Phân tích ảnh qua chatbox (FR-023) | ✓ | ✓ |
| M5 – Xem thống kê token từng tài khoản | ✓ | ✗ |
| M5 – Cấu hình hạn mức token tuần | ✓ | ✗ |

---

## CHƯƠNG 6. YÊU CẦU TÍCH HỢP

### 6.1 Tích hợp VNPay

| Thuộc tính | Chi tiết |
|---|---|
| Mục đích | Xử lý thanh toán giao dịch ủng hộ trực tuyến |
| Loại tích hợp | REST API (HTTP redirect + IPN callback) |
| Endpoint thanh toán | POST /api/donations/vnpay/create-payment-url |
| Endpoint callback (IPN) | POST /api/donations/vnpay/ipn |
| Xác thực | HMAC-SHA512 với vnp_SecureHash |
| Mã phản hồi thành công | vnp_ResponseCode = '00' |
| Trường hợp thất bại | Cập nhật Trang_thai = 'failed'; không thay đổi So_tien_hien_tai chiến dịch |
| Môi trường | Sandbox cho phát triển; Production khi triển khai thực tế |
| Tích hợp Laravel | Sử dụng Laravel HTTP Client để tạo URL và xử lý IPN callback; đăng ký route trong api.php |

### 6.2 Tích hợp Email (SMTP / Laravel Mail)

| Thuộc tính | Chi tiết |
|---|---|
| Mục đích | Gửi email xác thực tài khoản, xác nhận/link chọn lịch phỏng vấn, đặt lại mật khẩu |
| Nhà cung cấp đề xuất | Mailtrap (dev/test) hoặc SendGrid (production); cấu hình qua .env MAIL_* |
| Tích hợp Laravel | Laravel Mail + Mailable class + Queue Job để gửi bất đồng bộ |
| Loại email (1) | Xác thực tài khoản khi đăng ký |
| Loại email (2) | Email kèm link chọn slot lịch phỏng vấn sau khi Admin duyệt sơ bộ (FR-009) |
| Loại email (3) | Xác nhận lịch phỏng vấn sau khi khách chọn slot (FR-011) |
| Loại email (4) | Đặt lại mật khẩu (FR-019) |
| Kích hoạt | Sau FR-009 (duyệt sơ bộ) và FR-011 (khách chọn slot) |
| Xử lý lỗi gửi | Ghi log lỗi; Email_da_gui = FALSE; không làm gián đoạn quy trình chính |

### 6.3 Tích hợp AI Chatbox – Groq API

| Thuộc tính | Chi tiết |
|---|---|
| Mục đích | Hỗ trợ người dùng chat hỏi đáp, điều hướng giao diện PETJAM và phân tích ảnh thú cưng |
| Provider / Model | Groq API với model LLaMA hỗ trợ vision (cấu hình qua biến môi trường GROQ_API_KEYS) |
| Phương thức gọi | Server-side API call qua Laravel HTTP Client. API key tuyệt đối không được expose ra client |
| Quản lý API Key | Admin thêm/xóa Groq API Key qua giao diện quản trị. Hệ thống tự động xác thực key khi thêm mới và luân chuyển round-robin nếu có nhiều key |
| Context truyền vào | System prompt mô tả hệ thống PETJAM + nội dung tin nhắn người dùng. Không lưu lịch sử hội thoại – mỗi tin nhắn là một lần gọi API độc lập |
| Phân tích ảnh | Người dùng upload ảnh, server encode base64 và truyền vào API call dưới dạng image content. Chỉ hoạt động với model hỗ trợ vision |
| Giới hạn token | Mỗi tài khoản bị giới hạn tổng số token tiêu thụ trong 7 ngày gần nhất. Ngưỡng toàn cục do Admin cấu hình (mặc định 50.000 token/tuần) |
| Ghi nhận tiêu thụ | Sau mỗi lần gọi API thành công, ghi bản ghi { userId, tokens, timestamp } vào mảng userTokenUsage trong database.json |
| Xử lý lỗi | Nếu API lỗi: hiển thị thông báo thân thiện, ghi log server. Nếu hết hạn mức: trả về thông báo liên hệ Admin |
| Bảo mật API key | Lưu trong biến môi trường GROQ_API_KEYS. Không bao giờ trả key về client |

---

## CHƯƠNG 7. PHỤ LỤC

### 7.1 Danh sách bảng cơ sở dữ liệu

| Module | Tên bảng (tiếng Anh) | Mô tả |
|---|---|---|
| M1 | pets | Hồ sơ thú cưng |
| M1 | rescue_cases | Ca cứu hộ |
| M1 | vaccination_history | Lịch sử tiêm chủng |
| M2 | adoption_applications | Đơn xin nhận nuôi |
| M2 | interview_slots | Slot lịch phỏng vấn cố định *(THÊM MỚI v1.2)* |
| M2 | interview_schedules | Lịch phỏng vấn (đã cập nhật thêm Loai_lich, Ma_slot) |
| M3 | donation_campaigns | Chiến dịch gây quỹ |
| M3 | donations | Giao dịch ủng hộ |
| M4 | users | Người dùng |
| M4 | adopter_profiles | Hồ sơ người nhận nuôi |
| M4 | roles | Vai trò |
| M4 | permissions | Quyền hạn |
| M4 | user_roles | Phân công vai trò |
| M4 | role_permissions | Phân công quyền hạn |
| M4 | activity_logs | Nhật ký hoạt động |
| M4 | password_reset_tokens | Token đặt lại mật khẩu |
| M5 | database.json | Cấu hình chatbox: weeklyTokenLimit, userTokenUsage *(không phải bảng SQL)* |

> **Lưu ý v1.2:** Các bảng `ai_spam_results` và `ai_spam_overrides` (Module M3 cũ) đã bị xóa. Module M5 sử dụng `database.json` thay vì tạo bảng quan hệ mới.

### 7.2 Cấu trúc bảng interview_slots (MỚI v1.2)

| Tên trường | Kiểu dữ liệu | Ràng buộc | Ghi chú |
|---|---|---|---|
| Ma_slot | VARCHAR(36) | PRIMARY KEY | UUID slot |
| Ngay | DATE | NOT NULL | Ngày diễn ra slot |
| Gio_bat_dau | TIME | NOT NULL | Giờ bắt đầu |
| Gio_ket_thuc | TIME | NOT NULL | Giờ kết thúc |
| So_luong_toi_da | INT | DEFAULT 1 | Số đơn tối đa / slot |
| So_luong_hien_tai | INT | DEFAULT 0 | Số đơn đã đăng ký |
| Nhan_vien_xu_ly | VARCHAR(36) | FK → users | Nhân viên phụ trách |
| Trang_thai | VARCHAR(20) | CHECK IN ('mo','day','huy') | Trạng thái slot |
| Ngay_tao | TIMESTAMPTZ | DEFAULT NOW() | Thời điểm tạo |

### 7.3 Quy ước trạng thái thú cưng

| Trạng thái | Mô tả |
|---|---|
| dang_cuu_ho | Đang trong quá trình cứu hộ, chưa về trung tâm |
| chua_san_sang | Đã về trung tâm nhưng đang điều trị, chưa sẵn sàng cho nhận nuôi |
| san_sang | Đã ổn định, sẵn sàng được nhận nuôi |
| da_nhan_nuoi | Đã có người nhận nuôi và bàn giao thành công |
| da_mat | Đã mất trong quá trình cứu hộ hoặc điều trị |

### 7.4 Quy trình nhận nuôi tổng quát (v1.2 – Luồng 2 giai đoạn)

| Bước | Diễn giải | Vai trò |
|---|---|---|
| 1 | User chọn thú cưng và điền đơn đăng ký nhận nuôi | User |
| 2 | Admin xem xét đơn và duyệt sơ bộ hoặc từ chối sớm | Admin |
| 3 | Hệ thống tự động gửi email kèm link chọn lịch đến người đăng ký | Hệ thống (tự động) |
| 4 | Khách truy cập link, chọn slot từ danh sách Admin đã tạo hoặc đề xuất lịch linh hoạt | User |
| 5 | Admin xác nhận lịch linh hoạt (nếu khách đề xuất thời gian khác) | Admin |
| 6 | Phỏng vấn diễn ra theo lịch đã xác nhận | Admin + User |
| 7 | Admin cập nhật kết quả: approved hoặc rejected chính thức | Admin |
| 8 | Nếu approved: trạng thái thú cưng cập nhật thành 'da_nhan_nuoi' | Hệ thống (tự động) |

**Bảng tổng hợp ý nghĩa từng trạng thái lịch phỏng vấn:**

| Trạng thái | Ý nghĩa | Ai kích hoạt |
|---|---|---|
| cho_xac_nhan_don | Lịch vừa được tạo, chờ User chọn slot qua link email | Hệ thống tự động (sau FR-009) |
| cho_duyet | User đã đề xuất lịch linh hoạt, chờ Admin xác nhận | User (FR-011) |
| da_xac_nhan | Lịch đã được xác nhận — hoặc User chọn slot cố định, hoặc Admin duyệt lịch linh hoạt | Hệ thống (slot cố định) hoặc Admin |
| da_doi_lich | Admin đã thay đổi thời gian so với lịch ban đầu | Admin |
| da_huy | Lịch bị hủy (User rút đơn hoặc Admin hủy) | Admin hoặc hệ thống |

### 7.5 Luồng giao dịch VNPay

| Bước | Mô tả |
|---|---|
| 1 | Người dùng nhập thông tin ủng hộ và nhấn "Ủng hộ ngay" |
| 2 | Hệ thống tạo bản ghi donations với Trang_thai = 'pending' và sinh Ma_giao_dich_he_thong |
| 3 | Hệ thống tạo URL thanh toán VNPay và chuyển hướng người dùng |
| 4 | Người dùng hoàn tất thanh toán trên cổng VNPay |
| 5 | VNPay gửi IPN callback đến hệ thống với vnp_ResponseCode |
| 6 | Hệ thống xác thực chữ ký HMAC-SHA512 của callback |
| 7a | Nếu hợp lệ và ResponseCode = '00': cập nhật Trang_thai = 'success', cộng dồn So_tien vào chiến dịch |
| 7b | Nếu không hợp lệ hoặc ResponseCode ≠ '00': cập nhật Trang_thai = 'failed', ghi log |

### 7.6 Lịch sử phiên bản tài liệu

| Phiên bản | Ngày | Mô tả thay đổi | Tác giả |
|---|---|---|---|
| 1.0 | 01/06/2026 | Phiên bản đầy đủ chính thức theo chuẩn IEEE 830 | Nhóm phát triển PETJAM |
| 1.2 | 10/06/2026 | ① Xóa Module M3 – AI phân loại spam. ② Tái cấu trúc luồng nhận nuôi M2 thành 2 giai đoạn: thêm bảng interview_slots, tách FR-008 thành FR-009/010/011 mới. ③ Thêm Module M5 – Chatbox hỗ trợ với Groq API. ④ Cập nhật môi trường chạy sang PHP 8.x + Laravel 10/11. ⑤ Loại bỏ vai trò tình nguyện viên, hệ thống chỉ còn 2 vai trò: Admin và User. | Nhóm phát triển PETJAM |
