# Quy Tắc Và Hướng Dẫn Sử Dụng Cloudinary Trong Dự Án

Tài liệu này tổng hợp các quy tắc, quy trình cấu hình và hướng dẫn sử dụng thư viện Cloudinary trong dự án `Pet_Adoption_Management_System`. Mọi thành viên trong team khi làm việc với tính năng upload ảnh/media cần tuân thủ theo các quy tắc dưới đây.

---

## 1. Cấu hình môi trường (Setup)

### 1.1. Cài đặt thư viện
Chắc chắn rằng thư viện Cloudinary dành cho Laravel đã được cài đặt:
```bash
composer require cloudinary-labs/cloudinary-laravel
```

### 1.2. Biến môi trường (.env)
Mỗi thành viên khi pull code về cần đảm bảo thêm cấu hình sau vào file `.env` cá nhân:
```env
CLOUDINARY_URL=cloudinary://API_KEY:API_SECRET@CLOUD_NAME
```
*(Tham khảo thông tin `API_KEY`, `API_SECRET`, và `CLOUD_NAME` từ trưởng nhóm hoặc Cloudinary Dashboard)*

**Lưu ý:** Tuyệt đối không commit file `.env` chứa Key thật lên Github để tránh lộ thông tin bảo mật.

---

## 2. Quy tắc Code (Coding Conventions)

### 2.1. Upload ảnh
Nên sử dụng Facade `Cloudinary` để việc gọi code ngắn gọn và nhất quán:

```php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

public function store(Request $request)
{
    // 1. Validate dữ liệu đầu vào (Luôn phải validate đuôi file và dung lượng)
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
    ]);

    // 2. Xử lý upload
    if ($request->hasFile('image')) {
        try {
            $file = $request->file('image');
            
            // Sử dụng Storage facade để đẩy lên Cloudinary
            // Tham số đầu là đường dẫn folder trên Cloudinary (VD: pet_adoption/pets)
            $path = Storage::disk('cloudinary')->put('pet_adoption/pets', $file);
            
            // 3. Lấy URL an toàn (HTTPS) để lưu vào database
            $imageUrl = Storage::disk('cloudinary')->url($path);
            
            // Lưu $imageUrl vào DB...
        } catch (\Exception $e) {
            // Xử lý lỗi nếu upload thất bại (VD: mất mạng, sai key)
            return back()->withError('Lỗi upload ảnh: ' . $e->getMessage());
        }
    }
}
```

### 2.2. Xóa ảnh (Cập nhật hoặc Xóa dữ liệu)
Để tiết kiệm dung lượng lưu trữ trên Cloudinary, **bắt buộc** phải xóa ảnh cũ trên Cloudinary trước khi cập nhật ảnh mới hoặc khi xóa một bản ghi (Pet, User, v.v.).

Để làm được điều này, database của bạn nên lưu thêm trường `image_public_id` bên cạnh trường `image_url`.

```php
use Illuminate\Support\Facades\Storage;

public function destroy($id)
{
    $pet = Pet::findOrFail($id);
    
    // Nếu pet có đường dẫn ảnh, tiến hành lấy public_id và xóa
    if ($pet->image_url) {
        // Có thể lấy public_id từ database hoặc dùng cách cơ bản:
        // Cấu trúc path được trả về lúc upload nằm trong DB. Ví dụ: 'pet_adoption/pets/xxxxxx'
        Storage::disk('cloudinary')->delete($pet->image_path);
    }
    
    $pet->delete();
}
```

---

## 3. Các Best Practices Khác

1. **Phân chia thư mục rõ ràng:** Trên Cloudinary, không vứt tất cả ảnh vào thư mục gốc. Sử dụng tham số `'folder'` để phân chia hợp lý (ví dụ: `pet_adoption/avatars`, `pet_adoption/posts`).
2. **Optimize ảnh (Tùy chọn):** Cloudinary tự động hỗ trợ nén và tối ưu ảnh. Tuy nhiên, nếu bạn muốn can thiệp, hãy tìm hiểu tham số transformation (ví dụ resize ảnh trước khi lưu) để tránh người dùng upload ảnh quá nặng (như ảnh 10MB) làm tốn băng thông.
3. **Môi trường Test:** Trong quá trình viết Test (PHPUnit/Pest), hãy mock (giả mạo) Cloudinary facade hoặc không gọi thực thi hàm upload thực tế để tránh làm rác tài khoản và chậm quá trình test.
