# Nhật Ký Xử Lý Lỗi & Bài Học Thực Nghiệm (Post-Mortem & Error Log)

File này dùng để ghi chép toàn bộ các lỗi (bugs), sự cố phát sinh trong quá trình thiết kế, lập trình và chạy thử nghiệm tính năng **Quản lý tài khoản & Phân quyền (RBAC)** của **PetAdoption**, tuân thủ nghiêm ngặt **Quy tắc số 13 (The Post-Mortem Rule)**.

---

## Danh Sách Lỗi & Cách Khắc Phục

*Chưa ghi nhận lỗi nào phát sinh. Nhật ký sẽ được cập nhật tự động ngay khi có sự cố kỹ thuật xảy ra trong quá trình triển khai.*

---

## Mẫu Ghi Nhận Lỗi Tiêu Chuẩn (Dùng để tham khảo)

```markdown
### [MÃ SỐ LỖI] - [MÔ TẢ NGẮN GỌN VỀ BỆNH CỦA BUG]

*   **Môi trường xảy ra:** (Ví dụ: Trình duyệt Chrome, Lệnh compile Vite, hay Runtime PHP)
*   **Chi tiết thông báo lỗi:**
    ```text
    [Dán thông báo Exception hoặc mã lỗi Terminal tại đây]
    ```
*   **Nguyên nhân gốc rễ (Root Cause):**
    [Phân tích tại sao lỗi xảy ra, tại sao đoạn code cũ hoạt động sai...]
*   **Giải pháp xử lý (Resolution):**
    [Giải pháp sửa đổi, đính kèm đoạn code diff hoặc các lệnh sửa lỗi đã chạy]
*   **Bài học rút ra (Lessons Learned):**
    [Hành động cụ thể/quy tắc mới để đảm bảo bản thân và đồng đội không bao giờ lặp lại lỗi này ở các chức năng khác]
```
