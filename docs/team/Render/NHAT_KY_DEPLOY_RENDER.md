# Nhật Ký & Tiến Độ Triển Khai (Deploy) Lên Render

Tài liệu này dùng để theo dõi (track) tiến độ triển khai dự án Laravel lên Render. Quá trình chia làm 3 bước thực hành rõ ràng.

## 🟢 Bước 1: Chuẩn bị cấu hình Docker (Tại máy Local)
- [x] Tạo file `Dockerfile` chuẩn cho Laravel 12 (Sử dụng PHP 8.2 + Apache).
- [x] Tạo file `.dockerignore` để loại bỏ các file không cần thiết khi đưa lên Cloud.
- [x] Kiểm tra lại `.gitignore` để đảm bảo không đẩy file `.env` lên GitHub.

## 🟢 Bước 2: Chuẩn bị Database MySQL bên ngoài
Do Render không cấp MySQL miễn phí, chúng ta cần một Database bên thứ 3.
- [x] Đăng ký tài khoản trên **Aiven.io** (hoặc Clever Cloud / TiDB).
- [x] Tạo một dịch vụ MySQL miễn phí.
- [x] Lấy các thông số kết nối: `Host`, `Port`, `User`, `Password`, `Database Name`.

## 🟢 Bước 3: Đưa code lên GitHub và kết nối Render
- [ ] Commit toàn bộ code mới (chứa Dockerfile) lên GitHub.
- [ ] Truy cập Render.com, tạo **New Web Service** kết nối với kho GitHub.
- [ ] Cấu hình các **Biến môi trường (Environment Variables)** (APP_KEY, DB_HOST, DB_PASSWORD...).
- [ ] Đợi Render build thành công và truy cập link website thực tế!

---
*Cập nhật lần cuối: 2026-05-25*
