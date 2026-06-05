# CHƯƠNG 3: THIẾT KẾ CƠ SỞ DỮ LIỆU

## 1. Thiết kế mức khái niệm

### 1.1. Các thực thể

Hệ thống gồm 6 module với các thực thể chính như sau:

**Module M1 – Quản lý hồ sơ thú cưng:**
- Thú cưng
- Ca cứu hộ
- Lịch sử tiêm chủng

**Module M2 – Nhận nuôi:**
- Đơn xin nhận nuôi
- Slot lịch phỏng vấn (interview_slots)
- Lịch phỏng vấn (interview_schedules)
- Câu hỏi khảo sát (adoption_questions)
- Câu trả lời khảo sát (adoption_answers)

**Module M3 – Quản lý ủng hộ:**
- Chiến dịch gây quỹ
- Giao dịch ủng hộ

**Module M4 – Người dùng & Phân quyền:**
- Người dùng
- Hồ sơ người nhận nuôi
- Vai trò
- Quyền hạn
- Phân công vai trò
- Phân công quyền
- Nhật ký hoạt động
- Đặt lại mật khẩu

**Module M5 – Chatbox hỗ trợ:**
- Không có thực thể CSDL riêng – dữ liệu lưu trong `database.json` (`weeklyTokenLimit`, `userTokenUsage`)

---

### 1.2. Xác định thuộc tính của từng thực thể

**Module M1 – Quản lý hồ sơ thú cưng:**

- **Thú cưng** ( Ma_thu_cung, Ma_hien_thi, Ten, Loai, Giong, Nhom_tuoi, Can_nang, Gioi_tinh, Da_tiem_phong, Da_triet_san, Trang_thai, Vi_tri, Than_thien_nguoi, Than_thien_cho, Than_thien_meo, Che_do_an_dac_biet, Ngay_tiep_nhan, Phi_nhan_nuoi, Noi_bat, Mo_ta, Nguoi_phu_trach, Ngay_tao, Ngay_cap_nhat, Anh_dai_dien )
- **Ca cứu hộ** ( Ma_ca_cuu_ho, Ma_thu_cung, Ngay_cuu_ho, Dia_diem_cuu_ho, Loai_cuu_ho, Nguoi_bao_cao, Nguoi_thuc_hien, Chi_phi_cuu_ho, Trang_thai_ca, Ghi_chu, Ngay_tao )
- **Lịch sử tiêm chủng** ( Ma_lan_tiem, Ma_thu_cung, Ten_vac_xin, Ngay_tiem, Ngay_tiem_nhac_tiep, Nguoi_thuc_hien, Ten_noi_tiem, Chi_phi )

**Module M2 – Nhận nuôi:**

- **Đơn xin nhận nuôi** ( Ma_don, Ma_nguoi_dung, Ma_thu_cung, Ho_ten, So_dien_thoai, Dia_chi, Nghe_nghiep, Loai_nha_o, Kinh_nghiem, Ly_do_nhan_nuoi, Cam_ket, Trang_thai, Ghi_chu_admin, Ngay_tao, Ngay_cap_nhat )
- **Slot lịch phỏng vấn** ( Ma_slot, Ngay, Gio_bat_dau, Gio_ket_thuc, So_luong_toi_da, So_luong_hien_tai, Nhan_vien_xu_ly, Trang_thai, Ngay_tao )
- **Lịch phỏng vấn** ( Ma_lich, Ma_don, Ma_slot, Loai_lich, Thoi_gian_du_kien, Thoi_gian_xac_nhan, Nhan_vien_xu_ly, Trang_thai, Email_da_gui, Ghi_chu, Ngay_tao, Ngay_cap_nhat )
- **Câu hỏi khảo sát** ( Ma_cau_hoi, Ma_hien_thi, Noi_dung, Loai_cau_tra_loi, Cac_lua_chon, Bat_buoc, Thu_tu, Hoat_dong, Ngay_tao )
- **Câu trả lời khảo sát** ( Ma_tra_loi, Ma_don, Ma_cau_hoi, Noi_dung_tra_loi, Lua_chon_da_chon, Ngay_tao )

**Module M3 – Quản lý ủng hộ:**

- **Chiến dịch gây quỹ** ( Ma_chien_dich, Tieu_de, Mo_ta, Anh_dai_dien, So_tien_muc_tieu, So_tien_hien_tai, Ngay_bat_dau, Ngay_ket_thuc, Trang_thai, Ngay_tao, Ngay_cap_nhat )
- **Giao dịch ủng hộ** ( Ma_ung_ho, Ma_nguoi_dung, Ma_chien_dich, Ten_nguoi_ung_ho, An_danh, So_tien, Loi_nhan, Ma_giao_dich_he_thong, Ma_giao_dich_vnpay, Ma_phan_hoi_vnpay, Ma_ngan_hang, Trang_thai, Thoi_diem_thanh_toan, Ngay_tao, Ngay_cap_nhat )

**Module M4 – Người dùng & Phân quyền:**

- **Người dùng** ( Ma_nguoi_dung, Ho_ten, Email, So_dien_thoai, Mat_khau_hash, Ngay_sinh, Loai_tai_khoan, Trang_thai, Nguon_dang_ky, Ngay_tao, Email_da_xac_thuc, Anh_dai_dien )
- **Hồ sơ người nhận nuôi** ( Ma_nguoi_dung, Loai_nha_o, Co_kinh_nghiem, Dia_chi, Thanh_pho )
- **Vai trò** ( Ma_vai_tro, Ten_vai_tro, Mo_ta, La_vai_tro_he_thong )
- **Quyền hạn** ( Ma_quyen, Tai_nguyen, Hanh_dong, Mo_ta )
- **Phân công vai trò** ( Ma_nguoi_dung, Ma_vai_tro, Nguoi_cap, Thoi_diem_cap, Ngay_het_han )
- **Phân công quyền** ( Ma_vai_tro, Ma_quyen, Nguoi_cau_hinh, Thoi_diem_cap )
- **Nhật ký hoạt động** ( Ma_nhat_ky, Ma_nguoi_dung, Tai_nguyen, Hanh_dong, Chi_tiet, Dia_chi_ip, Thoi_diem )
- **Đặt lại mật khẩu** ( Ma_token, Ma_nguoi_dung, Token, Ngay_het_han, Da_su_dung, Ngay_tao )

**Module M5 – Chatbox hỗ trợ:**

Không có thực thể CSDL riêng. Dữ liệu lưu trong `database.json` với hai trường: `weeklyTokenLimit` (NUMBER) và `userTokenUsage` (ARRAY gồm các bản ghi `{ userId, tokens, timestamp }`).

---

### 1.3. Xác định các quan hệ giữa các thực thể

**Module M1 – Quản lý hồ sơ thú cưng:**
- Thú cưng `<Có>` Ca cứu hộ (1:N)
- Thú cưng `<Có>` Lịch sử tiêm chủng (1:N)
- Người dùng `<Phụ trách>` Thú cưng (1:N)
- Người dùng `<Thực hiện>` Ca cứu hộ (1:N)
- Người dùng `<Thực hiện>` Lịch sử tiêm chủng (1:N)

**Module M2 – Nhận nuôi:**
- Người dùng `<Nộp>` Đơn xin nhận nuôi (1:N)
- Thú cưng `<Nhận>` Đơn xin nhận nuôi (1:N)
- Đơn xin nhận nuôi `<Có>` Lịch phỏng vấn (1:0..1)
- Người dùng (Admin) `<Tạo>` Slot lịch phỏng vấn (1:N)
- Slot lịch phỏng vấn `<Chứa>` Lịch phỏng vấn (1:N)
- Người dùng `<Xử lý>` Lịch phỏng vấn (1:N)
- Câu hỏi khảo sát `<Có>` Câu trả lời khảo sát (1:N)
- Đơn xin nhận nuôi `<Có>` Câu trả lời khảo sát (1:N)

**Module M3 – Quản lý ủng hộ:**
- Chiến dịch gây quỹ `<Có>` Giao dịch ủng hộ (1:N)
- Người dùng `<Thực hiện>` Giao dịch ủng hộ (1:N)

**Module M4 – Người dùng & Phân quyền:**
- Người dùng `<Có>` Hồ sơ người nhận nuôi (1:0..1)
- Người dùng `<Được gán>` Vai trò (N:N) (Nguoi_cap, Thoi_diem_cap, Ngay_het_han)
- Vai trò `<Có>` Quyền hạn (N:N) (Nguoi_cau_hinh, Thoi_diem_cap)
- Người dùng `<Ghi nhận>` Nhật ký hoạt động (1:N)
- Người dùng `<Yêu cầu>` Đặt lại mật khẩu (1:N)

**Module M5 – Chatbox hỗ trợ:**

Không có quan hệ bảng mới. Module sử dụng `userId` từ bảng `users` để tra cứu và ghi nhận token usage trong `database.json`.

---

### 1.4. Sơ đồ ERD

*[Sơ đồ ERD sẽ được bổ sung sau]*

---

## 2. Thiết kế mức logic

### 2.1. Chuẩn hóa cơ sở dữ liệu về chuẩn 3NF

Danh sách các phụ thuộc hàm đã được xác định và chuẩn hóa:

**Module M1 – Thú cưng:**
- Ma_thu_cung → Ma_hien_thi, Ten, Loai, Giong, Nhom_tuoi, Can_nang, Gioi_tinh, Da_tiem_phong, Da_triet_san, Trang_thai, Vi_tri, Than_thien_nguoi, Than_thien_cho, Than_thien_meo, Che_do_an_dac_biet, Ngay_tiep_nhan, Phi_nhan_nuoi, Noi_bat, Mo_ta, Nguoi_phu_trach, Ngay_tao, Ngay_cap_nhat, Anh_dai_dien
- Ma_ca_cuu_ho → Ma_thu_cung, Ngay_cuu_ho, Dia_diem_cuu_ho, Loai_cuu_ho, Nguoi_bao_cao, Nguoi_thuc_hien, Chi_phi_cuu_ho, Trang_thai_ca, Ghi_chu, Ngay_tao
- Ma_lan_tiem → Ma_thu_cung, Ten_vac_xin, Ngay_tiem, Ngay_tiem_nhac_tiep, Nguoi_thuc_hien, Ten_noi_tiem, Chi_phi

**Module M2 – Nhận nuôi:**
- Ma_don → Ma_nguoi_dung, Ma_thu_cung, Ho_ten, So_dien_thoai, Dia_chi, Nghe_nghiep, Loai_nha_o, Kinh_nghiem, Ly_do_nhan_nuoi, Cam_ket, Trang_thai, Ghi_chu_admin, Ngay_tao, Ngay_cap_nhat
- Ma_slot → Ngay, Gio_bat_dau, Gio_ket_thuc, So_luong_toi_da, So_luong_hien_tai, Nhan_vien_xu_ly, Trang_thai, Ngay_tao *(THÊM MỚI v1.2)*
- Ma_lich → Ma_don, Ma_slot, Loai_lich, Thoi_gian_du_kien, Thoi_gian_xac_nhan, Nhan_vien_xu_ly, Trang_thai, Email_da_gui, Ghi_chu, Ngay_tao, Ngay_cap_nhat
- Ma_cau_hoi → Ma_hien_thi, Noi_dung, Loai_cau_tra_loi, Cac_lua_chon, Bat_buoc, Thu_tu, Hoat_dong, Ngay_tao *(THÊM MỚI v1.3)*
- Ma_tra_loi → Ma_don, Ma_cau_hoi, Noi_dung_tra_loi, Lua_chon_da_chon, Ngay_tao *(THÊM MỚI v1.3)*

**Module M3 – Quản lý ủng hộ:**
- Ma_chien_dich → Tieu_de, Mo_ta, Anh_dai_dien, So_tien_muc_tieu, So_tien_hien_tai, Ngay_bat_dau, Ngay_ket_thuc, Trang_thai, Ngay_tao, Ngay_cap_nhat
- Ma_ung_ho → Ma_nguoi_dung, Ma_chien_dich, Ten_nguoi_ung_ho, An_danh, So_tien, Loi_nhan, Ma_giao_dich_he_thong, Ma_giao_dich_vnpay, Ma_phan_hoi_vnpay, Ma_ngan_hang, Trang_thai, Thoi_diem_thanh_toan, Ngay_tao, Ngay_cap_nhat

**Module M4 – Người dùng & Phân quyền:**
- Ma_nguoi_dung → Ho_ten, Email, So_dien_thoai, Mat_khau_hash, Ngay_sinh, Loai_tai_khoan, Trang_thai, Nguon_dang_ky, Ngay_tao, Email_da_xac_thuc, Anh_dai_dien
- Ma_nguoi_dung → Loai_nha_o, Co_kinh_nghiem, Dia_chi, Thanh_pho *(bảng Hồ sơ người nhận nuôi)*
- Ma_vai_tro → Ten_vai_tro, Mo_ta, La_vai_tro_he_thong
- Ma_quyen → Tai_nguyen, Hanh_dong, Mo_ta
- (Ma_nguoi_dung, Ma_vai_tro) → Nguoi_cap, Thoi_diem_cap, Ngay_het_han
- (Ma_vai_tro, Ma_quyen) → Nguoi_cau_hinh, Thoi_diem_cap
- Ma_nhat_ky → Ma_nguoi_dung, Tai_nguyen, Hanh_dong, Chi_tiet, Dia_chi_ip, Thoi_diem
- Ma_token → Ma_nguoi_dung, Token, Ngay_het_han, Da_su_dung, Ngay_tao

---

### 2.2. Danh sách các bảng trong cơ sở dữ liệu

**Module M1 – Quản lý hồ sơ thú cưng:**
- **Thú cưng** ( Ma_thu_cung, Ma_hien_thi, Ten, Loai, Giong, Nhom_tuoi, Can_nang, Gioi_tinh, Da_tiem_phong, Da_triet_san, Trang_thai, Vi_tri, Than_thien_nguoi, Than_thien_cho, Than_thien_meo, Che_do_an_dac_biet, Ngay_tiep_nhan, Phi_nhan_nuoi, Noi_bat, Mo_ta, Nguoi_phu_trach, Ngay_tao, Ngay_cap_nhat, Anh_dai_dien )
- **Ca cứu hộ** ( Ma_ca_cuu_ho, Ma_thu_cung, Ngay_cuu_ho, Dia_diem_cuu_ho, Loai_cuu_ho, Nguoi_bao_cao, Nguoi_thuc_hien, Chi_phi_cuu_ho, Trang_thai_ca, Ghi_chu, Ngay_tao )
- **Lịch sử tiêm chủng** ( Ma_lan_tiem, Ma_thu_cung, Ten_vac_xin, Ngay_tiem, Ngay_tiem_nhac_tiep, Nguoi_thuc_hien, Ten_noi_tiem, Chi_phi )

**Module M2 – Nhận nuôi:**
- **Đơn xin nhận nuôi** ( Ma_don, Ma_nguoi_dung, Ma_thu_cung, Ho_ten, So_dien_thoai, Dia_chi, Nghe_nghiep, Loai_nha_o, Kinh_nghiem, Ly_do_nhan_nuoi, Cam_ket, Trang_thai, Ghi_chu_admin, Ngay_tao, Ngay_cap_nhat )
- **Slot lịch phỏng vấn** ( Ma_slot, Ngay, Gio_bat_dau, Gio_ket_thuc, So_luong_toi_da, So_luong_hien_tai, Nhan_vien_xu_ly, Trang_thai, Ngay_tao )
- **Lịch phỏng vấn** ( Ma_lich, Ma_don, Ma_slot, Loai_lich, Thoi_gian_du_kien, Thoi_gian_xac_nhan, Nhan_vien_xu_ly, Trang_thai, Email_da_gui, Ghi_chu, Ngay_tao, Ngay_cap_nhat )
- **Câu hỏi khảo sát** ( Ma_cau_hoi, Ma_hien_thi, Noi_dung, Loai_cau_tra_loi, Cac_lua_chon, Bat_buoc, Thu_tu, Hoat_dong, Ngay_tao )
- **Câu trả lời khảo sát** ( Ma_tra_loi, Ma_don, Ma_cau_hoi, Noi_dung_tra_loi, Lua_chon_da_chon, Ngay_tao )

**Module M3 – Quản lý ủng hộ:**
- **Chiến dịch gây quỹ** ( Ma_chien_dich, Tieu_de, Mo_ta, Anh_dai_dien, So_tien_muc_tieu, So_tien_hien_tai, Ngay_bat_dau, Ngay_ket_thuc, Trang_thai, Ngay_tao, Ngay_cap_nhat )
- **Giao dịch ủng hộ** ( Ma_ung_ho, Ma_nguoi_dung, Ma_chien_dich, Ten_nguoi_ung_ho, An_danh, So_tien, Loi_nhan, Ma_giao_dich_he_thong, Ma_giao_dich_vnpay, Ma_phan_hoi_vnpay, Ma_ngan_hang, Trang_thai, Thoi_diem_thanh_toan, Ngay_tao, Ngay_cap_nhat )

**Module M4 – Người dùng & Phân quyền:**
- **Người dùng** ( Ma_nguoi_dung, Ho_ten, Email, So_dien_thoai, Mat_khau_hash, Ngay_sinh, Loai_tai_khoan, Trang_thai, Nguon_dang_ky, Ngay_tao, Email_da_xac_thuc, Anh_dai_dien )
- **Hồ sơ người nhận nuôi** ( Ma_nguoi_dung, Loai_nha_o, Co_kinh_nghiem, Dia_chi, Thanh_pho )
- **Vai trò** ( Ma_vai_tro, Ten_vai_tro, Mo_ta, La_vai_tro_he_thong )
- **Quyền hạn** ( Ma_quyen, Tai_nguyen, Hanh_dong, Mo_ta )
- **Phân công vai trò** ( Ma_nguoi_dung, Ma_vai_tro, Nguoi_cap, Thoi_diem_cap, Ngay_het_han )
- **Phân công quyền** ( Ma_vai_tro, Ma_quyen, Nguoi_cau_hinh, Thoi_diem_cap )
- **Nhật ký hoạt động** ( Ma_nhat_ky, Ma_nguoi_dung, Tai_nguyen, Hanh_dong, Chi_tiet, Dia_chi_ip, Thoi_diem )
- **Đặt lại mật khẩu** ( Ma_token, Ma_nguoi_dung, Token, Ngay_het_han, Da_su_dung, Ngay_tao )

**Module M5 – Chatbox hỗ trợ:**

Không có bảng CSDL riêng. Module sử dụng `database.json` với 2 trường: `weeklyTokenLimit` và `userTokenUsage`.

---

### 2.3. Lược đồ quan hệ

*[Lược đồ quan hệ sẽ được bổ sung sau]*

---

## 3. Thiết kế mức vật lý

### 3.1. Module M1 – Quản lý hồ sơ thú cưng

#### a) Bảng Thú cưng (`pets`)

| Tên trường | Kiểu dữ liệu | Ràng buộc | Ghi chú |
|---|---|---|---|
| Ma_thu_cung | VARCHAR(36) | PRIMARY KEY | UUID, hệ thống sinh tự động |
| Ma_hien_thi | VARCHAR(20) | UNIQUE, NOT NULL | Mã hiển thị (1, 2, 3, …) |
| Ten | VARCHAR(100) | NOT NULL | Tên thú cưng |
| Loai | VARCHAR(20) | CHECK IN ('cho','meo','khac') | Loài động vật |
| Giong | VARCHAR(100) | — | Giống (Poodle, Munchkin, …) |
| Nhom_tuoi | VARCHAR(20) | CHECK IN ('so_sinh','nho','truong_thanh','gia') | Nhóm tuổi |
| Can_nang | DECIMAL(5,2) | — | Cân nặng (kg) |
| Gioi_tinh | VARCHAR(20) | CHECK IN ('duc','cai','chua_xac_dinh') | Giới tính |
| Da_tiem_phong | BOOLEAN | DEFAULT FALSE | Dẫn xuất từ Lịch sử tiêm chủng |
| Da_triet_san | BOOLEAN | DEFAULT FALSE | Đã triệt sản hay chưa |
| Trang_thai | VARCHAR(30) | CHECK IN (...), NOT NULL | dang_cuu_ho \| chua_san_sang \| san_sang \| da_nhan_nuoi \| da_mat |
| Vi_tri | VARCHAR(20) | CHECK IN ('noi_tru','phong_kham') | Vị trí hiện tại của bé |
| Than_thien_nguoi | BOOLEAN | DEFAULT NULL | Thân thiện với người |
| Than_thien_cho | BOOLEAN | DEFAULT NULL | Thân thiện với chó |
| Than_thien_meo | BOOLEAN | DEFAULT NULL | Thân thiện với mèo |
| Che_do_an_dac_biet | TEXT | — | Chế độ ăn đặc biệt (nếu có) |
| Ngay_tiep_nhan | DATE | NOT NULL | Ngày tiếp nhận vào trung tâm |
| Phi_nhan_nuoi | DECIMAL(12,2) | DEFAULT 0 | = Chi_phi_cuu_ho + Tổng chi phí tiêm chủng |
| Noi_bat | BOOLEAN | DEFAULT FALSE | Hiển thị nổi bật trang chủ |
| Mo_ta | TEXT | — | Mô tả tính cách, đặc điểm |
| Nguoi_phu_trach | VARCHAR(36) | FK → users(Ma_nguoi_dung) | Nhân viên / tình nguyện viên phụ trách |
| Ngay_tao | TIMESTAMPTZ | DEFAULT NOW() | Timestamp tạo bản ghi |
| Ngay_cap_nhat | TIMESTAMPTZ | DEFAULT NOW() | Timestamp cập nhật gần nhất |
| Anh_dai_dien | VARCHAR(255) | — | URL ảnh đại diện, lưu từ bộ nhớ |

#### b) Bảng Ca cứu hộ (`rescue_cases`)

| Tên trường | Kiểu dữ liệu | Ràng buộc | Ghi chú |
|---|---|---|---|
| Ma_ca_cuu_ho | VARCHAR(36) | PRIMARY KEY | UUID ca cứu hộ |
| Ma_thu_cung | VARCHAR(36) | FK → pets, NOT NULL | Thú cưng được cứu hộ |
| Ngay_cuu_ho | DATE | NOT NULL | Ngày thực hiện cứu hộ |
| Dia_diem_cuu_ho | TEXT | — | Địa điểm cứu hộ |
| Loai_cuu_ho | VARCHAR(30) | CHECK IN ('lang_thang','lac_duong','bi_bo_roi','bi_nguoc_dai') | Loại tình huống cứu hộ |
| Nguoi_bao_cao | VARCHAR(200) | — | Tên / thông tin người báo cáo |
| Nguoi_thuc_hien | VARCHAR(36) | FK → users | Tình nguyện viên thực hiện |
| Chi_phi_cuu_ho | DECIMAL(12,2) | DEFAULT 0 | Chi phí ca cứu hộ (VND), cộng vào phí nhận nuôi |
| Trang_thai_ca | VARCHAR(20) | CHECK IN ('dang_xu_ly','dang_dieu_tri','on_dinh','da_dong') | Trạng thái xử lý ca |
| Ghi_chu | TEXT | — | Ghi chú tình trạng khi tiếp nhận |
| Ngay_tao | TIMESTAMPTZ | DEFAULT NOW() | Timestamp tạo bản ghi |

#### c) Bảng Lịch sử tiêm chủng (`vaccination_history`)

| Tên trường | Kiểu dữ liệu | Ràng buộc | Ghi chú |
|---|---|---|---|
| Ma_lan_tiem | VARCHAR(36) | PRIMARY KEY | UUID lần tiêm |
| Ma_thu_cung | VARCHAR(36) | FK → pets, NOT NULL | Thú cưng được tiêm |
| Ten_vac_xin | VARCHAR(200) | NOT NULL | Tên vắc-xin (dại, combo, …) |
| Ngay_tiem | DATE | NOT NULL | Ngày tiêm |
| Ngay_tiem_nhac_tiep | DATE | — | Ngày tiêm nhắc tiếp theo |
| Nguoi_thuc_hien | VARCHAR(36) | FK → users | Bác sĩ / nhân viên thực hiện |
| Ten_noi_tiem | VARCHAR(200) | — | Tên phòng khám / nơi tiêm |
| Chi_phi | DECIMAL(12,2) | DEFAULT 0 | Chi phí lần tiêm, cộng vào phí nhận nuôi |

---

### 3.2. Module M2 – Nhận nuôi

#### a) Bảng Đơn xin nhận nuôi (`adoption_applications`)

| Tên trường | Kiểu dữ liệu | Ràng buộc | Ghi chú |
|---|---|---|---|
| Ma_don | VARCHAR(36) | PRIMARY KEY | UUID đơn nhận nuôi |
| Ma_nguoi_dung | VARCHAR(36) | FK → users, NOT NULL | Người nộp đơn |
| Ma_thu_cung | VARCHAR(36) | FK → pets, NOT NULL | Bé muốn nhận nuôi |
| Ho_ten | VARCHAR(100) | NOT NULL | Họ tên người đăng ký |
| So_dien_thoai | VARCHAR(20) | NOT NULL | Số điện thoại liên hệ |
| Dia_chi | TEXT | NOT NULL | Địa chỉ nơi ở |
| Nghe_nghiep | VARCHAR(100) | — | Nghề nghiệp |
| Loai_nha_o | VARCHAR(100) | — | Loại nhà ở (chung cư, nhà riêng, …) |
| Kinh_nghiem | TEXT | — | Kinh nghiệm nuôi thú cưng trước đây |
| Ly_do_nhan_nuoi | TEXT | NOT NULL | Lý do muốn nhận nuôi |
| Cam_ket | BOOLEAN | NOT NULL, DEFAULT FALSE | Xác nhận cam kết |
| Trang_thai | VARCHAR(20) | CHECK IN ('pending','pre_approved','approved','rejected','cancelled'), DEFAULT 'pending' | Trạng thái đơn |
| Ghi_chu_admin | TEXT | — | Ghi chú hoặc lý do từ chối của admin |
| Ngay_tao | TIMESTAMPTZ | DEFAULT NOW() | Timestamp nộp đơn |
| Ngay_cap_nhat | TIMESTAMPTZ | DEFAULT NOW() | Timestamp cập nhật |

> **Lưu ý v1.2:** Đã xóa cột `Thoi_gian_phong_van_mong_muon`; thêm giá trị `'pre_approved'` vào `Trang_thai`.

#### b) Bảng Slot lịch phỏng vấn (`interview_slots`) *(THÊM MỚI v1.2)*

| Tên trường | Kiểu dữ liệu | Ràng buộc | Ghi chú |
|---|---|---|---|
| Ma_slot | VARCHAR(36) | PRIMARY KEY | UUID slot lịch phỏng vấn |
| Ngay | DATE | NOT NULL | Ngày diễn ra slot |
| Gio_bat_dau | TIME | NOT NULL | Giờ bắt đầu |
| Gio_ket_thuc | TIME | NOT NULL | Giờ kết thúc |
| So_luong_toi_da | INT | DEFAULT 1 | Số đơn tối đa / slot |
| So_luong_hien_tai | INT | DEFAULT 0 | Số đơn đã đăng ký |
| Nhan_vien_xu_ly | VARCHAR(36) | FK → users | Nhân viên phụ trách |
| Trang_thai | VARCHAR(20) | CHECK IN ('mo','day','huy') | Trạng thái slot: mở / đầy / hủy |
| Ngay_tao | TIMESTAMPTZ | DEFAULT NOW() | Thời điểm tạo slot |

#### c) Bảng Lịch phỏng vấn (`interview_schedules`) *(CẬP NHẬT v1.2)*

| Tên trường | Kiểu dữ liệu | Ràng buộc | Ghi chú |
|---|---|---|---|
| Ma_lich | VARCHAR(36) | PRIMARY KEY | UUID lịch phỏng vấn |
| Ma_don | VARCHAR(36) | FK → adoption_applications, UNIQUE, NOT NULL | Đơn liên quan (quan hệ 1-1) |
| Ma_slot | VARCHAR(36) | FK → interview_slots, NULLABLE | *(THÊM MỚI)* Liên kết slot cố định; NULL nếu lịch linh hoạt |
| Loai_lich | VARCHAR(20) | CHECK IN ('slot_co_dinh','lich_khac') | *(THÊM MỚI)* Loại lịch: slot cố định hoặc lịch linh hoạt |
| Thoi_gian_du_kien | TIMESTAMPTZ | NULLABLE | Thời gian người dùng đề xuất hoặc slot đã chọn |
| Thoi_gian_xac_nhan | TIMESTAMPTZ | — | Thời gian nhân viên xác nhận hoặc đổi sang |
| Nhan_vien_xu_ly | VARCHAR(36) | FK → users | Nhân viên xử lý lịch |
| Trang_thai | VARCHAR(20) | CHECK IN ('cho_duyet','da_xac_nhan','da_doi_lich','da_huy','cho_xac_nhan_don'), DEFAULT 'cho_duyet' | *(CẬP NHẬT)* Bổ sung trạng thái `'cho_xac_nhan_don'` |
| Email_da_gui | BOOLEAN | DEFAULT FALSE | Email xác nhận đã gửi hay chưa |
| Ghi_chu | TEXT | — | Ghi chú của nhân viên |
| Ngay_tao | TIMESTAMPTZ | DEFAULT NOW() | Timestamp tạo |
| Ngay_cap_nhat | TIMESTAMPTZ | DEFAULT NOW() | Timestamp cập nhật |

#### d) Bảng Câu hỏi khảo sát (`adoption_questions`) *[THÊM MỚI v1.3]*

| Tên trường | Kiểu dữ liệu | Ràng buộc | Ghi chú |
|---|---|---|---|
| Ma_cau_hoi | VARCHAR(36) | PRIMARY KEY | UUID câu hỏi |
| Ma_hien_thi | INT | UNIQUE, NOT NULL | Số thứ tự hiển thị (1, 2, 3, ...) |
| Noi_dung | TEXT | NOT NULL | Nội dung câu hỏi |
| Loai_cau_tra_loi | VARCHAR(20) | CHECK IN ('text','single_choice','multi_choice'), NOT NULL | Loại câu trả lời: text tự do \| chọn 1 \| chọn nhiều |
| Cac_lua_chon | JSON | NULLABLE | Mảng JSON các lựa chọn. NULL nếu loại = 'text'. VD: ["Nhà riêng", "Chung cư"] |
| Bat_buoc | BOOLEAN | NOT NULL, DEFAULT TRUE | TRUE = bắt buộc trả lời |
| Thu_tu | INT | NOT NULL, DEFAULT 0 | Thứ tự sắp xếp khi hiển thị form |
| Hoat_dong | BOOLEAN | NOT NULL, DEFAULT TRUE | FALSE = ẩn khỏi form (dev tắt tạm) |
| Ngay_tao | TIMESTAMPTZ | DEFAULT NOW() | Timestamp tạo bản ghi |

> *Ghi chú: Bảng này được dev seed sẵn các câu hỏi khi khởi tạo hệ thống. Không có UI admin để thêm/sửa — muốn thay đổi phải sửa migration/seeder. Cột Hoat_dong = FALSE để tạm ẩn câu hỏi mà không cần xóa dữ liệu lịch sử.*

#### e) Bảng Câu trả lời khảo sát (`adoption_answers`) *[THÊM MỚI v1.3]*

Lưu câu trả lời của người dùng cho từng câu hỏi, gắn với đơn đăng ký cụ thể. Admin xem toàn bộ câu trả lời này khi xét duyệt đơn.

| Tên trường | Kiểu dữ liệu | Ràng buộc | Ghi chú |
|---|---|---|---|
| Ma_tra_loi | VARCHAR(36) | PRIMARY KEY | UUID câu trả lời |
| Ma_don | VARCHAR(36) | FK → adoption_applications, NOT NULL | Đơn đăng ký liên quan |
| Ma_cau_hoi | VARCHAR(36) | FK → adoption_questions, NOT NULL | Câu hỏi liên quan |
| Noi_dung_tra_loi | TEXT | NULLABLE | Nội dung trả lời tự do (dùng khi loại = 'text') |
| Lua_chon_da_chon | JSON | NULLABLE | Mảng JSON các lựa chọn đã chọn. VD: ["Nhà riêng"]. Dùng khi loại = 'single_choice' hoặc 'multi_choice' |
| Ngay_tao | TIMESTAMPTZ | DEFAULT NOW() | Timestamp gửi đơn |

> *Ghi chú: UNIQUE constraint (`Ma_don`, `Ma_cau_hoi`) — mỗi đơn chỉ có 1 câu trả lời cho mỗi câu hỏi. Khi user gửi đơn, hệ thống lưu toàn bộ câu trả lời cùng lúc trong 1 transaction với bản ghi adoption_applications.*

---

### 3.3. Module M3 – Quản lý ủng hộ

#### a) Bảng Chiến dịch gây quỹ (`donation_campaigns`)

| Tên trường | Kiểu dữ liệu | Ràng buộc | Ghi chú |
|---|---|---|---|
| Ma_chien_dich | VARCHAR(36) | PRIMARY KEY | UUID chiến dịch |
| Tieu_de | VARCHAR(200) | NOT NULL | Tên chiến dịch |
| Mo_ta | TEXT | — | Mô tả chi tiết chiến dịch |
| Anh_dai_dien | VARCHAR(255) | — | Đường dẫn ảnh đại diện |
| So_tien_muc_tieu | BIGINT UNSIGNED | — | Số tiền mục tiêu (VND). NULL = không giới hạn |
| So_tien_hien_tai | BIGINT UNSIGNED | NOT NULL, DEFAULT 0 | Tổng tiền đã nhận (cộng dồn từ giao dịch thành công) |
| Ngay_bat_dau | DATE | NOT NULL | Ngày bắt đầu chiến dịch |
| Ngay_ket_thuc | DATE | — | Ngày kết thúc. NULL = không giới hạn thời gian |
| Trang_thai | VARCHAR(20) | CHECK IN ('active','closed'), DEFAULT 'active' | Trạng thái chiến dịch |
| Ngay_tao | TIMESTAMPTZ | DEFAULT NOW() | Timestamp tạo bản ghi |
| Ngay_cap_nhat | TIMESTAMPTZ | DEFAULT NOW() | Timestamp cập nhật |

#### b) Bảng Giao dịch ủng hộ (`donations`)

| Tên trường | Kiểu dữ liệu | Ràng buộc | Ghi chú |
|---|---|---|---|
| Ma_ung_ho | VARCHAR(36) | PRIMARY KEY | UUID giao dịch ủng hộ |
| Ma_nguoi_dung | VARCHAR(36) | FK → users, NULLABLE | NULL nếu ẩn danh hoặc chưa đăng nhập |
| Ma_chien_dich | VARCHAR(36) | FK → donation_campaigns, NULLABLE | NULL nếu ủng hộ chung không gắn chiến dịch |
| Ten_nguoi_ung_ho | VARCHAR(100) | NOT NULL | Lưu 'Ẩn danh' nếu An_danh = TRUE |
| An_danh | BOOLEAN | NOT NULL, DEFAULT FALSE | TRUE = ẩn danh, không hiển thị tên thật |
| So_tien | BIGINT UNSIGNED | NOT NULL, CHECK > 0 | Số tiền ủng hộ (VND) |
| Loi_nhan | VARCHAR(200) | — | Lời nhắn từ người ủng hộ |
| Ma_giao_dich_he_thong | VARCHAR(50) | NOT NULL, UNIQUE | vnp_TxnRef, sinh trước khi gọi VNPay API |
| Ma_giao_dich_vnpay | VARCHAR(50) | — | Mã giao dịch VNPay (nhận từ callback) |
| Ma_phan_hoi_vnpay | VARCHAR(10) | — | vnp_ResponseCode (00 = thành công) |
| Ma_ngan_hang | VARCHAR(20) | — | Mã ngân hàng người dùng thanh toán |
| Trang_thai | VARCHAR(20) | CHECK IN ('pending','success','failed','expired'), DEFAULT 'pending' | Trạng thái giao dịch |
| Thoi_diem_thanh_toan | TIMESTAMPTZ | — | Thời điểm thành công (từ VNPay callback) |
| Ngay_tao | TIMESTAMPTZ | DEFAULT NOW() | Timestamp tạo giao dịch |
| Ngay_cap_nhat | TIMESTAMPTZ | DEFAULT NOW() | Timestamp cập nhật |

---

### 3.4. Module M4 – Người dùng & Phân quyền

#### a) Bảng Người dùng (`users`)

| Tên trường | Kiểu dữ liệu | Ràng buộc | Ghi chú |
|---|---|---|---|
| Ma_nguoi_dung | VARCHAR(36) | PRIMARY KEY | UUID người dùng |
| Ho_ten | VARCHAR(200) | NOT NULL | Họ và tên đầy đủ |
| Email | VARCHAR(255) | UNIQUE, NOT NULL | Email đăng nhập |
| So_dien_thoai | VARCHAR(20) | — | Số điện thoại liên hệ |
| Mat_khau_hash | VARCHAR(255) | — | Mật khẩu đã hash (bcrypt, cost factor ≥ 12) |
| Ngay_sinh | DATE | — | Ngày sinh |
| Loai_tai_khoan | VARCHAR(20) | CHECK IN ('ca_nhan','to_chuc') | Loại tài khoản |
| Trang_thai | VARCHAR(20) | CHECK IN ('hoat_dong','khong_hoat_dong','bi_khoa'), DEFAULT 'hoat_dong' | Trạng thái tài khoản |
| Nguon_dang_ky | VARCHAR(30) | CHECK IN ('web','ung_dung','nhan_vien_tao') | Nguồn đăng ký tài khoản |
| Ngay_tao | TIMESTAMPTZ | DEFAULT NOW() | Timestamp tạo tài khoản |
| Email_da_xac_thuc | BOOLEAN | DEFAULT FALSE | Xác thực email qua link |
| Anh_dai_dien | VARCHAR(255) | — | URL ảnh đại diện, lưu từ bộ nhớ |

#### b) Bảng Hồ sơ người nhận nuôi (`adopter_profiles`)

| Tên trường | Kiểu dữ liệu | Ràng buộc | Ghi chú |
|---|---|---|---|
| Ma_nguoi_dung | VARCHAR(36) | PRIMARY KEY, FK → users | Khóa chính kiêm khóa ngoại (quan hệ 1-1) |
| Loai_nha_o | VARCHAR(100) | — | nhà riêng \| chung cư \| thuê trọ |
| Co_kinh_nghiem | BOOLEAN | DEFAULT FALSE | Có kinh nghiệm nuôi thú cưng |
| Dia_chi | TEXT | — | Địa chỉ thường trú |
| Thanh_pho | VARCHAR(100) | — | Thành phố |

#### c) Bảng Vai trò (`roles`)

| Tên trường | Kiểu dữ liệu | Ràng buộc | Ghi chú |
|---|---|---|---|
| Ma_vai_tro | VARCHAR(36) | PRIMARY KEY | UUID vai trò |
| Ten_vai_tro | VARCHAR(50) | UNIQUE, NOT NULL | admin \| user |
| Mo_ta | TEXT | — | Mô tả vai trò trong hệ thống |
| La_vai_tro_he_thong | BOOLEAN | DEFAULT FALSE | TRUE = không cho phép xóa |

#### d) Bảng Quyền hạn (`permissions`)

| Tên trường | Kiểu dữ liệu | Ràng buộc | Ghi chú |
|---|---|---|---|
| Ma_quyen | VARCHAR(36) | PRIMARY KEY | UUID quyền hạn |
| Tai_nguyen | VARCHAR(50) | NOT NULL | thu_cung \| nhan_nuoi \| ung_ho \| nguoi_dung \| bao_cao |
| Hanh_dong | VARCHAR(20) | NOT NULL | tao \| doc \| sua \| xoa \| duyet |
| Mo_ta | TEXT | — | Mô tả quyền (VD: Duyệt đơn nhận nuôi) |

#### e) Bảng Phân công vai trò (`user_roles`)

| Tên trường | Kiểu dữ liệu | Ràng buộc | Ghi chú |
|---|---|---|---|
| Ma_nguoi_dung | VARCHAR(36) | PK (ghép) + FK → users | Phần khóa chính ghép |
| Ma_vai_tro | VARCHAR(36) | PK (ghép) + FK → roles | Phần khóa chính ghép |
| Nguoi_cap | VARCHAR(36) | FK → users | Quản trị viên gán quyền |
| Thoi_diem_cap | TIMESTAMPTZ | DEFAULT NOW() | Thời điểm gán quyền |
| Ngay_het_han | TIMESTAMPTZ | — | Hết hạn (NULL = vĩnh viễn) |

#### f) Bảng Phân công quyền (`role_permissions`)

| Tên trường | Kiểu dữ liệu | Ràng buộc | Ghi chú |
|---|---|---|---|
| Ma_vai_tro | VARCHAR(36) | PK (ghép) + FK → roles | Phần khóa chính ghép |
| Ma_quyen | VARCHAR(36) | PK (ghép) + FK → permissions | Phần khóa chính ghép |
| Nguoi_cau_hinh | VARCHAR(36) | FK → users | Quản trị viên cấu hình |
| Thoi_diem_cap | TIMESTAMPTZ | DEFAULT NOW() | Timestamp gán quyền |

#### g) Bảng Nhật ký hoạt động (`activity_logs`)

| Tên trường | Kiểu dữ liệu | Ràng buộc | Ghi chú |
|---|---|---|---|
| Ma_nhat_ky | VARCHAR(36) | PRIMARY KEY | UUID nhật ký |
| Ma_nguoi_dung | VARCHAR(36) | FK → users, NOT NULL | Người dùng thực hiện thao tác |
| Tai_nguyen | VARCHAR(50) | NOT NULL | Tài nguyên thao tác (thu_cung, nhan_nuoi, …) |
| Hanh_dong | VARCHAR(30) | NOT NULL | Hành động thực hiện (tao, cap_nhat, xoa, …) |
| Chi_tiet | JSON | — | Chi tiết thay đổi (JSON diff hoặc văn bản mô tả) |
| Dia_chi_ip | VARCHAR(45) | — | Địa chỉ IP thực hiện (hỗ trợ IPv6) |
| Thoi_diem | TIMESTAMPTZ | DEFAULT NOW() | Timestamp thực hiện |

#### h) Bảng Đặt lại mật khẩu (`password_reset_tokens`)

| Tên trường | Kiểu dữ liệu | Ràng buộc | Ghi chú |
|---|---|---|---|
| Ma_token | VARCHAR(36) | PRIMARY KEY | UUID token |
| Ma_nguoi_dung | VARCHAR(36) | FK → users, NOT NULL | Người yêu cầu đặt lại mật khẩu |
| Token | VARCHAR(255) | UNIQUE, NOT NULL | Hash token gửi qua email |
| Ngay_het_han | TIMESTAMPTZ | NOT NULL | Thường +15 phút từ lúc tạo |
| Da_su_dung | BOOLEAN | DEFAULT FALSE | Dùng 1 lần rồi vô hiệu |
| Ngay_tao | TIMESTAMPTZ | DEFAULT NOW() | Thời điểm tạo bản ghi |

---

### 3.5. Module M5 – Chatbox hỗ trợ người dùng *(THÊM MỚI v1.2)*

Module M5 không tạo bảng CSDL quan hệ mới. Toàn bộ dữ liệu chatbox và kiểm soát token được lưu trong file `database.json` thông qua hai trường sau:

#### a) Cấu trúc lưu trữ trong `database.json`

| Trường | Kiểu | Mặc định | Mô tả |
|---|---|---|---|
| weeklyTokenLimit | NUMBER | 50000 | Hạn mức token tối đa mỗi tài khoản được dùng trong 7 ngày gần nhất. Admin cấu hình toàn cục qua giao diện. |
| userTokenUsage | ARRAY | [] | Mảng các bản ghi tiêu thụ token. Mỗi phần tử gồm: `{ userId, tokens, timestamp }`. Không giới hạn lịch sử; logic tính tổng sẽ lọc theo 7 ngày gần nhất. |

#### b) Cấu trúc bản ghi `userTokenUsage`

| Tên trường | Kiểu dữ liệu | Ràng buộc | Ví dụ | Ghi chú |
|---|---|---|---|---|
| userId | STRING | NOT NULL | user-001 | ID tài khoản người dùng |
| tokens | NUMBER | NOT NULL, > 0 | 1250 | Số token tiêu thụ trong lần gọi đó |
| timestamp | ISO STRING | NOT NULL | 2026-06-03T10:00:00Z | Thời điểm ghi nhận lượt gọi API |

**Logic tính hạn mức:** Hệ thống lọc toàn bộ bản ghi có `userId` khớp và `timestamp` trong vòng 7 ngày gần nhất, cộng tổng `tokens` và so sánh với `weeklyTokenLimit`. Nếu đã vượt ngưỡng, hệ thống trả về thông báo yêu cầu liên hệ Admin mà không gọi Groq API.

#### c) Không có quan hệ bảng mới

Module M5 không tạo thêm bảng hay quan hệ mới trong ERD. Dữ liệu token usage là append-only log lưu trong mảng JSON, không phải bảng quan hệ có khóa ngoại. Module sử dụng `userId` từ bảng `users` để tra cứu và xác thực người dùng.

---

### 3.6. Danh sách Index

| Bảng | Tên Index | Cột | Mục đích |
|---|---|---|---|
| pets | idx_pets_trang_thai | Trang_thai | Lọc thú cưng theo trạng thái (san_sang, da_nhan_nuoi, …) |
| rescue_cases | idx_rescue_ma_thu_cung | Ma_thu_cung | Tìm tất cả ca cứu hộ của 1 thú cưng |
| vaccination_history | idx_vaccine_ma_thu_cung | Ma_thu_cung | Tìm lịch sử tiêm chủng của 1 thú cưng |
| adoption_applications | idx_adoption_ma_nguoi_dung | Ma_nguoi_dung | Tìm tất cả đơn nhận nuôi của 1 người dùng |
| adoption_applications | idx_adoption_trang_thai | Trang_thai | Lọc đơn theo trạng thái (pending, approved, …) |
| adoption_answers | idx_answers_ma_don | Ma_don | Tìm toàn bộ câu trả lời của 1 đơn [MỚI v1.3] |
| adoption_answers | idx_answers_ma_cau_hoi | Ma_cau_hoi | Thống kê câu trả lời theo từng câu hỏi [MỚI v1.3] |
| interview_schedules | idx_interview_ma_don | Ma_don | Tìm lịch phỏng vấn theo đơn nhận nuôi |
| donations | idx_donations_ma_nguoi_dung | Ma_nguoi_dung | Tìm giao dịch ủng hộ của 1 người dùng |
| donations | idx_donations_ma_chien_dich | Ma_chien_dich | Tìm tất cả giao dịch của 1 chiến dịch |
| activity_logs | idx_logs_ma_nguoi_dung | Ma_nguoi_dung | Lọc nhật ký hoạt động theo người dùng |
| password_reset_tokens | idx_reset_token | Token | Tra cứu token khi người dùng đặt lại mật khẩu |
