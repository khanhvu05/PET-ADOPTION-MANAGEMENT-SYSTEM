<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonationCampaign;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DonationCampaignController extends Controller
{
    public function index(Request $request)
    {
        // Thống kê tổng quan
        $totalCampaigns = DonationCampaign::count();
        $totalTarget = DonationCampaign::sum('So_tien_muc_tieu');
        $totalRaised = DonationCampaign::sum('So_tien_hien_tai');
        $finishedCampaigns = DonationCampaign::where('Trang_thai', 'closed')
            ->orWhere('Ngay_ket_thuc', '<', Carbon::today())
            ->count();
        // Cột Nhà hảo tâm sẽ được mock bằng 0 do DB chưa có liên kết, hoặc random nhẹ
        $totalDonors = 0; 

        // Query danh sách
        $campaignsQuery = DonationCampaign::orderBy('Trang_thai', 'asc') // active lên trước
            ->orderBy('Ngay_bat_dau', 'desc');
            
        // Tìm kiếm theo tiêu đề
        if ($request->filled('search')) {
            $campaignsQuery->where('Tieu_de', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $campaignsQuery->where('Trang_thai', $request->status);
        }

        $campaigns = $campaignsQuery->paginate(10)->withQueryString();

        return view('admin.donation_campaigns.index', compact(
            'campaigns', 
            'totalCampaigns', 
            'totalTarget', 
            'totalRaised', 
            'finishedCampaigns',
            'totalDonors'
        ));
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
            'Anh_dai_dien' => 'nullable|url|max:255',
            'So_tien_muc_tieu' => 'nullable|integer|min:0',
            'Ngay_bat_dau' => 'required|date',
            'Ngay_ket_thuc' => 'nullable|date|after_or_equal:Ngay_bat_dau',
        ]);

        $validated['Trang_thai'] = 'active';
        $validated['So_tien_hien_tai'] = 0;

        DonationCampaign::create($validated);

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
        return view('admin.donation_campaigns.form', compact('campaign'));
    }

    public function update(Request $request, $id)
    {
        $campaign = DonationCampaign::findOrFail($id);
        
        $validated = $request->validate([
            'Tieu_de' => 'required|string|max:200',
            'Mo_ta' => 'nullable|string',
            'Anh_dai_dien' => 'nullable|url|max:255',
            'So_tien_muc_tieu' => 'nullable|integer|min:0',
            'Ngay_bat_dau' => 'required|date',
            'Ngay_ket_thuc' => 'nullable|date|after_or_equal:Ngay_bat_dau',
        ]);

        $campaign->update($validated);

        return redirect()->route('admin.donation_campaigns.index')
            ->with('success', 'Đã cập nhật chiến dịch thành công!');
    }

    public function destroy($id)
    {
        $campaign = DonationCampaign::findOrFail($id);
        
        // Cảnh báo nếu chiến dịch đã quyên góp được tiền
        if ($campaign->So_tien_hien_tai > 0) {
            // Tương tự, cảnh báo phía FE. Backend có thể trả lỗi nếu không muốn cho xóa cứng
            // Nhưng hiện tại cho phép xóa cứng hoặc đóng chiến dịch
        }
        
        $campaign->delete();

        return redirect()->route('admin.donation_campaigns.index')
            ->with('success', 'Đã xóa chiến dịch thành công!');
    }

    public function close($id)
    {
        $campaign = DonationCampaign::findOrFail($id);
        $campaign->update(['Trang_thai' => 'closed']);

        return redirect()->route('admin.donation_campaigns.index')
            ->with('success', 'Đã đóng chiến dịch!');
    }
}
