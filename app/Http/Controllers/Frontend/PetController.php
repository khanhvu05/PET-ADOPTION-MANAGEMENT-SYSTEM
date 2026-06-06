<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Danh sách thú cưng sẵn sàng nhận nuôi
     */
    public function index(Request $request)
    {
        $query = Pet::where('Trang_thai', 'san_sang');

        // Sắp xếp
        $sort = $request->input('sap_xep', 'moi_nhat');
        if ($sort === 'cu_nhat') {
            $query->orderBy('Ngay_tao', 'asc');
        } else {
            $query->orderByDesc('Noi_bat')->orderByDesc('Ngay_tao');
        }

        // Filter theo loài
        if ($request->filled('loai') && in_array($request->loai, ['cho', 'meo', 'khac'])) {
            $query->where('Loai', $request->loai);
        }

        // Filter theo nhóm tuổi
        if ($request->filled('nhom_tuoi') && in_array($request->nhom_tuoi, ['so_sinh', 'nho', 'truong_thanh', 'gia'])) {
            $query->where('Nhom_tuoi', $request->nhom_tuoi);
        }

        // Filter kích thước theo Cân nặng
        if ($request->filled('kich_thuoc')) {
            $size = $request->kich_thuoc;
            if ($size === 'nho') {
                $query->where('Can_nang', '<', 5);
            } elseif ($size === 'trung_binh') {
                $query->whereBetween('Can_nang', [5, 15]);
            } elseif ($size === 'lon') {
                $query->where('Can_nang', '>', 15);
            }
        }

        // Filter theo giới tính
        if ($request->filled('gioi_tinh') && in_array($request->gioi_tinh, ['duc', 'cai'])) {
            $query->where('Gioi_tinh', $request->gioi_tinh);
        }

        // Tình trạng sức khỏe
        if ($request->boolean('da_tiem_phong')) {
            $query->where('Da_tiem_phong', 1);
        }

        if ($request->boolean('da_triet_san')) {
            $query->where('Da_triet_san', 1);
        }

        // Search theo tên
        if ($request->filled('search')) {
            $query->where('Ten', 'like', '%' . $request->search . '%');
        }

        $pets = $query->paginate(8)->onEachSide(1)->withQueryString();

        return view('frontend.adoptions.index', compact('pets'));
    }

    /**
     * Chi tiết một thú cưng
     */
    public function show($id)
    {
        $pet = Pet::with(['nguoiPhuTrach', 'lichSuTiemChung'])
            ->findOrFail($id);

        // Kiểm tra xem user đã có đơn chờ duyệt cho bé này chưa
        $existingApplication = null;
        if (auth()->check()) {
            $existingApplication = $pet->donNhanNuoi()
                ->where('Ma_nguoi_dung', auth()->id())
                ->whereIn('Trang_thai', ['pending', 'pre_approved'])
                ->first();
        }

        return view('frontend.adoptions.show', compact('pet', 'existingApplication'));
    }
}
