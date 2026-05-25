# Hướng Dẫn Thiết Kế Tối Giản Cao Cấp (Minimalist UI Guidelines)

Tài liệu này được thiết kế để làm tài liệu học tập, đúc kết các quy tắc giao diện cao cấp kiểu **Premium Utilitarian Minimalism & Editorial UI** được áp dụng trực tiếp vào giao diện quản lý tài khoản của **PetAdoption**.

---

## 1. Bản Chất Của Minimalist UI Cao Cấp

Thiết kế tối giản cao cấp **không phải** là sự nghèo nàn về giao diện hay việc bỏ trống màn hình một cách lười biếng. Đó là nghệ thuật **sử dụng khoảng trắng (whitespace) có chủ đích, thiết lập độ tương phản chữ cực lớn (typographic contrast), sử dụng đường kẻ tinh tế và phân bổ màu sắc cực kỳ tiết kiệm**.

```
+-------------------------------------------------------+
|  [HỒ SƠ CÁ NHÂN] (Instrument Serif - Cỡ chữ lớn)      |
|  [01] THÔNG TIN  (Monospace - Chữ nhỏ, chữ in hoa)    |
|                                                       |
|  Đường kẻ phân cách mảnh (1px solid #EAEAEA)          |
|  Màu nền: Bone/Off-white nhẹ nhàng (#FBFBFA)          |
|  Điểm nhấn: Tag phấn nhạt (Pale Pastel)               |
+-------------------------------------------------------+
```

---

## 2. Hệ Thống Token Thiết Kế Áp Dụng Trong Dự Án

### 2.1. Phối Màu (Washed-out Pastels + Warm Monochrome)
Màu sắc được coi là tài nguyên quý hiếm, chỉ sử dụng để nhấn mạnh trạng thái hoặc tạo điểm nhấn nghệ thuật:

*   **Màu nền canvas (Body background):** `#FBFBFA` (Trắng xương ấm). Tránh màu trắng tinh khiết chói mắt hoặc xám tối công nghiệp.
*   **Màu nền bề mặt (Card surfaces):** `#FFFFFF` (Trắng) với đường viền mảnh `border-[#EAEAEA]`.
*   **Màu chữ chính:** `#18181B` (Zinc-900 - không dùng màu đen tuyệt đối `#000000` để giảm mỏi mắt, tăng độ sang trọng).
*   **Màu phấn nhạt (Spot Pastels) cho các trạng thái:**
    *   **Thành công (Pale Green):** Nền `#EDF3EC` | Chữ `#346538` (Dùng cho thông báo "Đã Lưu").
    *   **Cảnh báo/Nguy hiểm (Pale Red):** Nền `#FDEBEC` | Chữ `#9F2F2D` (Dùng cho vùng hủy tài khoản).
    *   **Lưu ý (Pale Yellow):** Nền `#FBF3DB` | Chữ `#956400` (Dùng cho thông tin chưa xác thực email).

### 2.2. Hệ Thống Typography (Độ Tương Phản Tòa Soạn)
Dự án nhập và cấu hình 3 bộ font chữ chuyên biệt để tạo nhịp điệu đọc:

1.  **Editorial Serif (`Instrument Serif`):** Dùng cho tiêu đề lớn (`H1`, `H2`). 
    *   *Thuộc tính CSS:* `font-family: 'Instrument Serif', serif; letter-spacing: -0.02em; line-height: 1.1; font-weight: 500`.
    *   *Hiệu quả:* Mang lại cảm giác cổ điển, uy tín giống tạp chí giấy cao cấp.
2.  **Modern Sans (`Geist` / `Instrument Sans`):** Dùng cho giao diện, nút bấm, biểu mẫu.
    *   *Thuộc tính CSS:* `font-family: 'Geist', sans-serif; letter-spacing: -0.01em`.
    *   *Hiệu quả:* Gọn gàng, dễ đọc trên mọi màn hình.
3.  **Keystroke Mono (`Geist Mono`):** Dùng cho nhãn phụ, chỉ số thứ tự, nút tắt `<kbd>`.
    *   *Thuộc tính CSS:* `font-family: 'Geist Mono', monospace; font-size: 0.75rem`.
    *   *Hiệu quả:* Tạo điểm nhấn kỹ thuật chính xác, đậm tính công nghệ tối giản.

---

## 3. Các Quy Tắc Vi Cấu Trúc (Micro-UX Rules)

*   **Cấm Đổ Bóng Nặng:** Tuyệt đối không dùng các lớp `shadow-md` hay `shadow-lg` mặc định của Tailwind. Các khối hộp phải phẳng hoàn toàn, được phân cách bằng đường viền siêu mảnh `border border-gray-100` hoặc chỉ đổ bóng mờ dưới 4% độ mờ (`shadow-sm`).
*   **Cấm Bo Góc Tròn Trĩnh (Pill shape):** Các thẻ và nút hành động lớn phải có góc bo sắc gọn, phạm vi tối đa là `rounded-[6px]` hoặc `rounded-lg` (8px). Không dùng `rounded-full` ngoại trừ các nhãn tag trạng thái siêu nhỏ.
*   **Nghệ Thuật Trực Quan Nét Đơn (Line-art illustration):** Để làm nổi bật thương hiệu **PetAdoption**, chúng ta sử dụng bản vẽ SVG vẽ nét đơn liền mạch (continuous line-art) tối giản của chó/mèo đè nhẹ lên một hình oval màu phấn nhạt lệch tâm. Đây là thủ pháp thiết kế hiện đại, tránh việc sử dụng các hình ảnh stock màu mè rẻ tiền làm loãng giao diện tối giản.
