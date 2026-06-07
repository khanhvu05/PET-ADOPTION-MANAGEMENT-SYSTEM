<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonationCampaign;
use App\Models\Donation;
use App\Models\CampaignActivity;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DonationCampaignController extends Controller
{
    public function __construct(protected CloudinaryService $cloudinary) {}
    public function index(Request $request)
    {
        // Thống kê tổng quan
        $totalCampaigns = DonationCampaign::count();
        $totalTarget = DonationCampaign::sum('So_tien_muc_tieu');
        $totalRaised = DonationCampaign::sum('So_tien_hien_tai');
        $finishedCampaigns = DonationCampaign::where('Trang_thai', 'closed')
            ->orWhere('Ngay_ket_thuc', '<', \Carbon\Carbon::today())
            ->count();
        // Cập nhật lấy dữ liệu thật thay vì mock
        $totalDonors = Donation::where('Trang_thai', 'success')->count();

        // Query danh sách
        $campaignsQuery = DonationCampaign::orderBy('Trang_thai', 'asc') // active lên trước
            ->orderBy('Ngay_bat_dau', 'desc');
            
        // Tìm kiếm theo tiêu đề (không dấu)
        if ($request->filled('search')) {
            $search = $request->search;
            $campaignsQuery->where(function($q) use ($search) {
                $q->whereRaw('Tieu_de COLLATE utf8mb4_unicode_ci LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('Mo_ta COLLATE utf8mb4_unicode_ci LIKE ?', ["%{$search}%"]);
            });
        }

        // Lọc theo trạng thái
        if ($request->filled('status') && $request->status !== 'all') {
            $campaignsQuery->where('Trang_thai', $request->status);
        }

        // Lọc theo khoảng thời gian (Date Range)
        if ($request->filled('date_range')) {
            $dates = explode(' to ', $request->date_range);
            if (count($dates) === 2) {
                try {
                    $fromDate = \Carbon\Carbon::createFromFormat('d/m/Y', trim($dates[0]))->startOfDay();
                    $toDate = \Carbon\Carbon::createFromFormat('d/m/Y', trim($dates[1]))->endOfDay();
                    $campaignsQuery->where(function($q) use ($fromDate, $toDate) {
                        $q->whereBetween('Ngay_bat_dau', [$fromDate, $toDate])
                          ->orWhereBetween('Ngay_ket_thuc', [$fromDate, $toDate]);
                    });
                } catch (\Exception $e) {
                    // Bỏ qua nếu format sai
                }
            }
        }

        if ($request->input('export') === 'excel') {
            return $this->exportExcel($campaignsQuery);
        }

        $perPage = $request->input('per_page', 10);
        $campaigns = $campaignsQuery->paginate($perPage)->withQueryString();

        return view('admin.donation_campaigns.index', compact(
            'campaigns', 
            'totalCampaigns', 
            'totalTarget', 
            'totalRaised', 
            'finishedCampaigns',
            'totalDonors'
        ));
    }

    /**
     * Xuất dữ liệu ra file CSV
     */
    private function exportExcel($query)
    {
        $campaigns = $query->get();
        $filename = "DS_ChienDich_" . now()->format('Ymd_His') . ".xlsx";

        $writer = \Spatie\SimpleExcel\SimpleExcelWriter::streamDownload($filename);

        foreach ($campaigns as $campaign) {
            $writer->addRow([
                'Mã Chiến Dịch' => $campaign->Ma_chien_dich,
                'Tiêu Đề' => $campaign->Tieu_de,
                'Số Tiền Mục Tiêu' => $campaign->So_tien_muc_tieu,
                'Số Tiền Hiện Tại' => $campaign->So_tien_hien_tai,
                'Ngày Bắt Đầu' => $campaign->Ngay_bat_dau ? $campaign->Ngay_bat_dau->format('d/m/Y') : '',
                'Ngày Kết Thúc' => $campaign->Ngay_ket_thuc ? $campaign->Ngay_ket_thuc->format('d/m/Y') : '',
                'Trạng Thái' => $campaign->Trang_thai,
                'Ngày Tạo' => $campaign->Ngay_tao ? $campaign->Ngay_tao->format('d/m/Y H:i:s') : ''
            ]);
        }

        return $writer->toBrowser();
    }

    public function create()
    {
        return view('admin.donation_campaigns.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Tieu_de' => 'required|string|max:200',
            'Mo_ta' => 'nullable|string',
            'Anh_dai_dien' => 'nullable|string|max:255',
            'anh_dai_dien_upload' => 'nullable|image|max:5120', // 5MB max
            'So_tien_muc_tieu' => 'nullable|integer|min:0',
            'Ngay_bat_dau' => 'required|date',
            'Ngay_ket_thuc' => 'nullable|date|after_or_equal:Ngay_bat_dau',
        ]);

        $validated['Trang_thai'] = 'active';
        $validated['So_tien_hien_tai'] = 0;

        // Upload ảnh đại diện lên Cloudinary
        if ($request->hasFile('anh_dai_dien_upload')) {
            $uploaded = $this->cloudinary->uploadImage($request->file('anh_dai_dien_upload'), 'petjam/campaigns');
            if ($uploaded) {
                $validated['Anh_dai_dien'] = $uploaded['url'];
            }
        }

        unset($validated['anh_dai_dien_upload']);

        DonationCampaign::create($validated);

        // Ghi log tạo chiến dịch
        CampaignActivity::create([
            'campaign_id' => $validated['Ma_chien_dich'],
            'user_id' => auth()->id(),
            'action' => 'Tạo chiến dịch',
            'description' => 'Chiến dịch được tạo mới',
        ]);

        return redirect()->route('admin.donation_campaigns.index')
            ->with('success', 'Đã thêm chiến dịch gây quỹ mới thành công!');
    }

    public function show($id)
    {
        $campaign = DonationCampaign::findOrFail($id);
        return view('admin.donation_campaigns.form', compact('campaign'));
    }

    public function edit($id)
    {
        $campaign = DonationCampaign::findOrFail($id);
        
        $donorsCount = Donation::where('Ma_chien_dich', $campaign->Ma_chien_dich)
            ->where('Trang_thai', 'success')
            ->count();
            
        $activities = CampaignActivity::with('user')
            ->where('campaign_id', $campaign->Ma_chien_dich)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.donation_campaigns.form', compact('campaign', 'donorsCount', 'activities'));
    }

    public function update(Request $request, $id)
    {
        $campaign = DonationCampaign::findOrFail($id);
        
        $validated = $request->validate([
            'Tieu_de' => 'required|string|max:200',
            'Mo_ta' => 'nullable|string',
            'Anh_dai_dien' => 'nullable|string|max:255',
            'anh_dai_dien_upload' => 'nullable|image|max:5120',
            'So_tien_muc_tieu' => 'nullable|integer|min:0',
            'Ngay_bat_dau' => 'required|date',
            'Ngay_ket_thuc' => 'nullable|date|after_or_equal:Ngay_bat_dau',
        ]);

        // Upload ảnh đại diện
        if ($request->hasFile('anh_dai_dien_upload')) {
            if ($campaign->Anh_dai_dien) {
                $publicId = $this->cloudinary->extractPublicId($campaign->Anh_dai_dien);
                if ($publicId) $this->cloudinary->deleteImage($publicId);
            }
            $uploaded = $this->cloudinary->uploadImage($request->file('anh_dai_dien_upload'), 'petjam/campaigns');
            if ($uploaded) {
                $validated['Anh_dai_dien'] = $uploaded['url'];
            }
        }

        unset($validated['anh_dai_dien_upload']);

        $campaign->update($validated);

        // Ghi log cập nhật chiến dịch
        CampaignActivity::create([
            'campaign_id' => $campaign->Ma_chien_dich,
            'user_id' => auth()->id(),
            'action' => 'Cập nhật thông tin',
            'description' => 'Chỉnh sửa thông tin chiến dịch',
        ]);

        return redirect()->route('admin.donation_campaigns.index')
            ->with('success', 'Đã cập nhật chiến dịch thành công!');
    }

    public function destroy($id)
    {
        abort(403, 'Không được phép xóa chiến dịch theo nghiệp vụ.');
    }

    public function close($id)
    {
        $campaign = DonationCampaign::findOrFail($id);
        $campaign->update(['Trang_thai' => 'closed']);

        // Ghi log đóng chiến dịch
        CampaignActivity::create([
            'campaign_id' => $campaign->Ma_chien_dich,
            'user_id' => auth()->id(),
            'action' => 'Đóng chiến dịch',
            'description' => 'Ngừng tiếp nhận quyên góp',
        ]);

        return redirect()->route('admin.donation_campaigns.index')
            ->with('success', 'Đã đóng chiến dịch!');
    }
}
