<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePetRequest;
use App\Models\AdoptionApplication;
use App\Models\Pet;
use App\Models\User;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetController extends Controller
{
    public function __construct(protected CloudinaryService $cloudinary) {}

    /**
     * Danh sách thú cưng với filter và phân trang
     */
    public function index(Request $request)
    {
        $query = Pet::with('nguoiPhuTrach')->orderByDesc('Ngay_tao');

        // Search theo tên & mã hiển thị
        if ($request->filled('search')) {
            $search = $request->search;
            $cleanSearch = ltrim($search, '#');
            $query->where(function($q) use ($search, $cleanSearch) {
                $q->where('Ten', 'like', '%' . $search . '%')
                  ->orWhere('Ma_hien_thi', 'like', '%' . $cleanSearch . '%');
            });
        }

        // Filter theo loài
        if ($request->filled('loai') && $request->loai !== 'all') {
            $query->where('Loai', $request->loai);
        }

        // Filter theo giống
        if ($request->filled('giong') && $request->giong !== 'all') {
            $query->where('Giong', $request->giong);
        }

        // Filter theo trạng thái
        if ($request->filled('trang_thai') && $request->trang_thai !== 'all') {
            $query->where('Trang_thai', $request->trang_thai);
        }
        
        // Filter theo giới tính
        if ($request->filled('gioi_tinh') && $request->gioi_tinh !== 'all') {
            $query->where('Gioi_tinh', $request->gioi_tinh);
        }

        // Nổi bật
        if ($request->filled('noi_bat')) {
            $query->where('Noi_bat', (bool)$request->noi_bat);
        }

        $perPage = $request->input('per_page', 5);
        $pets = $query->paginate($perPage)->withQueryString();

        // Calculate KPI Stats with Growth
        $now = \Carbon\Carbon::now();
        $endOfLastMonth = $now->copy()->subMonth()->endOfMonth();

        $calcGrowth = function($current, $last) {
            if ($last == 0) return $current > 0 ? 100 : 0;
            return round((($current - $last) / $last) * 100, 1);
        };

        $totalPets = Pet::count();
        $totalPetsLast = Pet::where('Ngay_tao', '<=', $endOfLastMonth)->count();

        $ready = Pet::where('Trang_thai', 'san_sang')->count();
        $readyLast = Pet::where('Trang_thai', 'san_sang')->where('Ngay_tao', '<=', $endOfLastMonth)->count();

        $adopted = Pet::where('Trang_thai', 'da_nhan_nuoi')->count();
        $adoptedLast = Pet::where('Trang_thai', 'da_nhan_nuoi')->where('Ngay_tao', '<=', $endOfLastMonth)->count();

        $rescue = Pet::where('Trang_thai', 'chua_san_sang')->count();
        $rescueLast = Pet::where('Trang_thai', 'chua_san_sang')->where('Ngay_tao', '<=', $endOfLastMonth)->count();

        $unavailable = Pet::whereIn('Trang_thai', ['da_mat'])->count();
        $unavailableLast = Pet::whereIn('Trang_thai', ['da_mat'])->where('Ngay_tao', '<=', $endOfLastMonth)->count();

        $stats = [
            'total'       => ['value' => $totalPets, 'growth' => $calcGrowth($totalPets, $totalPetsLast)],
            'ready'       => ['value' => $ready, 'growth' => $calcGrowth($ready, $readyLast)],
            'adopted'     => ['value' => $adopted, 'growth' => $calcGrowth($adopted, $adoptedLast)],
            'rescue'      => ['value' => $rescue, 'growth' => $calcGrowth($rescue, $rescueLast)],
            'unavailable' => ['value' => $unavailable, 'growth' => $calcGrowth($unavailable, $unavailableLast)],
        ];

    // Unique values for dropdown filters
        $breeds = Pet::select('Giong')->distinct()->whereNotNull('Giong')->pluck('Giong');

        return view('admin.pets.index', compact('pets', 'stats', 'breeds'));
    }

    /**
     * Xuất danh sách thú cưng ra Excel
     */
    public function export(Request $request)
    {
        $query = Pet::with('nguoiPhuTrach')->orderByDesc('Ngay_tao');

        if ($request->filled('search')) {
            $search = $request->search;
            $cleanSearch = ltrim($search, '#');
            $query->where(function($q) use ($search, $cleanSearch) {
                $q->where('Ten', 'like', '%' . $search . '%')
                  ->orWhere('Ma_hien_thi', 'like', '%' . $cleanSearch . '%');
            });
        }
        if ($request->filled('loai') && $request->loai !== 'all') {
            $query->where('Loai', $request->loai);
        }
        if ($request->filled('giong') && $request->giong !== 'all') {
            $query->where('Giong', $request->giong);
        }
        if ($request->filled('trang_thai') && $request->trang_thai !== 'all') {
            $query->where('Trang_thai', $request->trang_thai);
        }
        if ($request->filled('gioi_tinh') && $request->gioi_tinh !== 'all') {
            $query->where('Gioi_tinh', $request->gioi_tinh);
        }

        $pets = $query->get();

        $writer = \Spatie\SimpleExcel\SimpleExcelWriter::streamDownload('Danh_sach_thu_cung.xlsx');

        foreach ($pets as $pet) {
            $writer->addRow([
                'Mã hiển thị' => $pet->Ma_hien_thi,
                'Tên' => $pet->Ten,
                'Loài' => $pet->loai_label,
                'Giống' => $pet->Giong ?? 'Không rõ',
                'Tuổi' => $pet->nhom_tuoi_label,
                'Cân nặng (kg)' => $pet->Can_nang,
                'Giới tính' => $pet->gioi_tinh_label,
                'Vị trí' => $pet->vi_tri_label,
                'Trạng thái' => $pet->trang_thai_label,
                'Ngày tạo' => $pet->Ngay_tao ? $pet->Ngay_tao->format('d/m/Y H:i') : '',
                'Người phụ trách' => $pet->nguoiPhuTrach ? $pet->nguoiPhuTrach->name : '',
                'Đã tiêm phòng' => $pet->Da_tiem_phong ? 'Có' : 'Không',
                'Đã triệt sản' => $pet->Da_triet_san ? 'Có' : 'Không',
            ]);
        }

        return $writer->toBrowser();
    }

    /**
     * Form thêm thú cưng mới
     */
    public function create()
    {
        $staffUsers = User::whereHas('roles', fn($q) => $q->whereIn('name', ['admin', 'staff']))->get();
        return view('admin.pets.create', compact('staffUsers'));
    }

    /**
     * Lưu thú cưng mới
     */
    public function store(StorePetRequest $request)
    {
        $data = $request->validated();

        // Upload ảnh lên Cloudinary
        if ($request->hasFile('anh_upload')) {
            $uploaded = $this->cloudinary->uploadImage($request->file('anh_upload'), 'petjam/pets');
            if (!$uploaded) {
                return back()->withInput()->with('error', 'Upload ảnh thất bại. Vui lòng thử lại.');
            }
            $data['Anh_dai_dien'] = $uploaded['url'];
        }

        // Upload thư viện ảnh phụ
        if ($request->hasFile('thu_vien_anh_upload')) {
            $gallery = [];
            foreach ($request->file('thu_vien_anh_upload') as $file) {
                $uploaded = $this->cloudinary->uploadImage($file, 'petjam/pets/gallery');
                if ($uploaded) {
                    $gallery[] = $uploaded['url'];
                }
            }
            $data['Thu_vien_anh'] = empty($gallery) ? null : $gallery;
        }

        unset($data['anh_upload']);
        unset($data['thu_vien_anh_upload']);

        // Tạo mã hiển thị tự động nếu không có
        if (empty($data['Ma_hien_thi'])) {
            $count = Pet::count() + 1;
            $data['Ma_hien_thi'] = 'PET-' . str_pad($count, 4, '0', STR_PAD_LEFT);
        }

        $pet = Pet::create($data);

        return redirect()
            ->route('admin.pets.show', $pet->Ma_thu_cung)
            ->with('success', "Đã thêm thú cưng «{$pet->Ten}» thành công!");
    }

    /**
     * Chi tiết thú cưng
     */
    public function show($id)
    {
        $pet = Pet::with(['nguoiPhuTrach', 'lichSuTiemChung', 'caCuuHo', 'donNhanNuoi.nguoiDung', 'ghiChu.nguoiDung'])->findOrFail($id);
        return view('admin.pets.show', compact('pet'));
    }

    /**
     * Form chỉnh sửa thú cưng
     */
    public function edit($id)
    {
        $pet = Pet::findOrFail($id);
        $staffUsers = User::whereHas('roles', fn($q) => $q->whereIn('name', ['admin', 'staff']))->get();
        return view('admin.pets.edit', compact('pet', 'staffUsers'));
    }

    /**
     * Cập nhật thú cưng
     */
    public function update(StorePetRequest $request, $id)
    {
        $pet = Pet::findOrFail($id);
        $data = $request->validated();

        // Kiểm tra nếu đổi trạng thái sang 'da_nhan_nuoi'
        // → Tự động rejected các đơn pending/pre_approved còn lại
        $oldTrangThai = $pet->Trang_thai;
        $newTrangThai = $data['Trang_thai'];

        if ($oldTrangThai !== 'da_nhan_nuoi' && $newTrangThai === 'da_nhan_nuoi') {
            DB::transaction(function () use ($pet) {
                AdoptionApplication::where('Ma_thu_cung', $pet->Ma_thu_cung)
                    ->whereIn('Trang_thai', ['pending', 'approved', 'cho_phong_van'])
                    ->update([
                        'Trang_thai'    => 'rejected',
                        'Ghi_chu_admin' => 'Tự động từ chối: Bé đã được nhận nuôi bởi đơn khác.',
                    ]);
            });
        }

        // Upload ảnh mới nếu có
        if ($request->hasFile('anh_upload')) {
            // Xóa ảnh cũ trên Cloudinary nếu có
            if ($pet->Anh_dai_dien) {
                $publicId = $this->cloudinary->extractPublicId($pet->Anh_dai_dien);
                if ($publicId) {
                    $this->cloudinary->deleteImage($publicId);
                }
            }

            $uploaded = $this->cloudinary->uploadImage($request->file('anh_upload'), 'petjam/pets');
            if (!$uploaded) {
                return back()->withInput()->with('error', 'Upload ảnh thất bại. Vui lòng thử lại.');
            }
            $data['Anh_dai_dien'] = $uploaded['url'];
        }

        // Upload thư viện ảnh phụ
        if ($request->hasFile('thu_vien_anh_upload')) {
            // Xóa các ảnh phụ cũ
            if (is_array($pet->Thu_vien_anh)) {
                foreach ($pet->Thu_vien_anh as $url) {
                    $publicId = $this->cloudinary->extractPublicId($url);
                    if ($publicId) {
                        $this->cloudinary->deleteImage($publicId);
                    }
                }
            }

            $gallery = [];
            foreach ($request->file('thu_vien_anh_upload') as $file) {
                $uploaded = $this->cloudinary->uploadImage($file, 'petjam/pets/gallery');
                if ($uploaded) {
                    $gallery[] = $uploaded['url'];
                }
            }
            $data['Thu_vien_anh'] = empty($gallery) ? null : $gallery;
        }

        unset($data['anh_upload']);
        unset($data['thu_vien_anh_upload']);

        $pet->update($data);

        return redirect()
            ->route('admin.pets.show', $pet->Ma_thu_cung)
            ->with('success', "Đã cập nhật thú cưng «{$pet->Ten}» thành công!");
    }

    /**
     * Xóa thú cưng
     */
    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);

        // Kiểm tra còn đơn đang mở không
        $openApplications = AdoptionApplication::where('Ma_thu_cung', $pet->Ma_thu_cung)
            ->whereIn('Trang_thai', ['pending', 'approved', 'cho_phong_van'])
            ->count();

        if ($openApplications > 0) {
            return redirect()
                ->route('admin.pets.index')
                ->with('error', "Không thể xóa «{$pet->Ten}» vì còn {$openApplications} đơn nhận nuôi đang chờ duyệt.");
        }

        // Không cho xóa cứng nếu đã nhận nuôi (chỉ cho ẩn)
        if ($pet->Trang_thai === 'da_nhan_nuoi') {
            return redirect()
                ->route('admin.pets.index')
                ->with('error', "Không thể xóa «{$pet->Ten}» vì bé đã được nhận nuôi. Hãy chuyển sang trạng thái «Đã mất» nếu cần.");
        }

        // Xóa ảnh Cloudinary
        if ($pet->Anh_dai_dien) {
            $publicId = $this->cloudinary->extractPublicId($pet->Anh_dai_dien);
            if ($publicId) {
                $this->cloudinary->deleteImage($publicId);
            }
        }
        if (is_array($pet->Thu_vien_anh)) {
            foreach ($pet->Thu_vien_anh as $url) {
                $publicId = $this->cloudinary->extractPublicId($url);
                if ($publicId) {
                    $this->cloudinary->deleteImage($publicId);
                }
            }
        }

        $petName = $pet->Ten;
        $pet->delete();

        return redirect()
            ->route('admin.pets.index')
            ->with('success', "Đã xóa thú cưng «{$petName}» thành công!");
    }

    /**
     * Thêm ghi chú cho thú cưng
     */
    public function storeNote(Request $request, $id)
    {
        $request->validate([
            'Noi_dung' => 'required|string|max:1000',
        ]);

        $pet = Pet::findOrFail($id);

        $pet->ghiChu()->create([
            'Ma_nguoi_dung' => auth()->user()->Ma_nguoi_dung,
            'Noi_dung' => $request->Noi_dung,
        ]);

        return redirect()
            ->route('admin.pets.show', $pet->Ma_thu_cung)
            ->with('success', 'Đã thêm ghi chú thành công!');
    }

    /**
     * Xóa ghi chú
     */
    public function destroyNote($petId, $noteId)
    {
        $note = \App\Models\PetNote::where('Ma_thu_cung', $petId)
            ->where('Ma_ghi_chu', $noteId)
            ->firstOrFail();

        $note->delete();

        return redirect()
            ->route('admin.pets.show', $petId)
            ->with('success', 'Đã xóa ghi chú!');
    }

    /**
     * Thêm ca cứu hộ cho thú cưng
     */
    public function storeRescue(Request $request, $id)
    {
        $request->validate([
            'Ngay_cuu_ho' => 'required|date',
            'Loai_cuu_ho' => 'required|in:lang_thang,lac_duong,bi_bo_roi,bi_nguoc_dai',
            'Dia_diem_cuu_ho' => 'nullable|string|max:500',
            'Nguoi_bao_cao' => 'nullable|string|max:200',
            'Chi_phi_cuu_ho' => 'nullable|numeric|min:0',
            'Ghi_chu' => 'nullable|string|max:1000',
        ]);

        $pet = Pet::findOrFail($id);

        \App\Models\RescueCase::create([
            'Ma_thu_cung' => $pet->Ma_thu_cung,
            'Ngay_cuu_ho' => $request->Ngay_cuu_ho,
            'Loai_cuu_ho' => $request->Loai_cuu_ho,
            'Dia_diem_cuu_ho' => $request->Dia_diem_cuu_ho,
            'Nguoi_bao_cao' => $request->Nguoi_bao_cao,
            'Nguoi_thuc_hien' => auth()->user()->Ma_nguoi_dung,
            'Chi_phi_cuu_ho' => $request->Chi_phi_cuu_ho ?? 0,
            'Ghi_chu' => $request->Ghi_chu,
        ]);

        return redirect()
            ->route('admin.pets.show', $pet->Ma_thu_cung)
            ->with('success', 'Đã thêm ca cứu hộ thành công!');
    }
}
