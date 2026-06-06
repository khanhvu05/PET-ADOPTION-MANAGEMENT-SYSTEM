<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\DonationCampaign;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    /**
     * Danh sách chiến dịch ủng hộ đang hoạt động
     */
    public function index()
    {
        $campaigns = DonationCampaign::where('Trang_thai', 'active')
            ->orderByDesc('Ngay_bat_dau')
            ->get()
            ->map(function ($campaign) {
                // Tính % hoàn thành
                $campaign->progress = $campaign->So_tien_muc_tieu > 0
                    ? min(100, round(($campaign->So_tien_hien_tai / $campaign->So_tien_muc_tieu) * 100, 1))
                    : 0;
                return $campaign;
            });

        return view('frontend.donations.index', compact('campaigns'));
    }

    /**
     * Form ủng hộ
     */
    public function process(Request $request, $campaignId = null)
    {
        $campaign = null;

        if ($campaignId) {
            $campaign = DonationCampaign::findOrFail($campaignId);

            // Kiểm tra campaign còn active không
            if ($campaign->Trang_thai !== 'active') {
                return redirect()
                    ->route('frontend.donations.index')
                    ->with('warning', 'Chiến dịch này đã kết thúc. Vui lòng chọn chiến dịch khác.');
            }
        }

        $campaigns = DonationCampaign::where('Trang_thai', 'active')->orderByDesc('Ngay_bat_dau')->get();

        return view('frontend.donations.process', compact('campaign', 'campaigns'));
    }

    /**
     * Xử lý ủng hộ - tạo record và redirect sang VNPAY
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'So_tien'        => 'required|integer|min:10000',
            'Ten_nguoi_ung_ho' => 'required_unless:An_danh,1|nullable|string|max:100',
            'An_danh'        => 'boolean',
            'Loi_nhan'       => 'nullable|string|max:200',
            'Ma_chien_dich'  => 'nullable|exists:donation_campaigns,Ma_chien_dich',
        ], [
            'So_tien.required'   => 'Vui lòng nhập số tiền ủng hộ.',
            'So_tien.min'        => 'Số tiền ủng hộ tối thiểu là 10,000đ.',
            'So_tien.integer'    => 'Số tiền phải là số nguyên.',
            'Ten_nguoi_ung_ho.required_unless' => 'Vui lòng nhập tên của bạn.',
        ]);

        // Kiểm tra campaign không bị closed khi submit
        if (!empty($validated['Ma_chien_dich'])) {
            $campaign = DonationCampaign::find($validated['Ma_chien_dich']);
            if (!$campaign || $campaign->Trang_thai !== 'active') {
                return back()->with('error', 'Chiến dịch này đã kết thúc. Vui lòng chọn chiến dịch khác.');
            }
        }

        $anDanh = $request->boolean('An_danh');
        $tenNguoiUngHo = $anDanh ? 'Ẩn danh' : ($validated['Ten_nguoi_ung_ho'] ?? (Auth::user()?->Ho_ten ?? 'Khách'));

        // Tạo mã giao dịch duy nhất
        $maGiaoDich = 'PJM' . strtoupper(Str::random(10)) . time();

        // Tạo donation với trạng thái pending
        $donation = Donation::create([
            'Ma_nguoi_dung'          => Auth::id(),
            'Ma_chien_dich'          => $validated['Ma_chien_dich'] ?? null,
            'Ten_nguoi_ung_ho'       => $tenNguoiUngHo,
            'An_danh'                => $anDanh,
            'So_tien'                => $validated['So_tien'],
            'Loi_nhan'               => $validated['Loi_nhan'] ?? null,
            'Ma_giao_dich_he_thong'  => $maGiaoDich,
            'Trang_thai'             => 'pending',
        ]);

        // Tạo URL thanh toán VNPAY
        $vnpayUrl = $this->createVNPayUrl($donation);

        return redirect($vnpayUrl);
    }

    /**
     * Xử lý callback từ VNPAY
     */
    public function vnpayReturn(Request $request)
    {
        $params = $request->all();

        // Xác minh chữ ký VNPAY
        if (!$this->verifyVNPaySignature($params)) {
            return redirect()
                ->route('frontend.donations.index')
                ->with('error', 'Giao dịch không hợp lệ.');
        }

        $maGiaoDich = $params['vnp_TxnRef'] ?? null;
        $donation = Donation::where('Ma_giao_dich_he_thong', $maGiaoDich)->first();

        if (!$donation) {
            return redirect()->route('frontend.donations.index')->with('error', 'Không tìm thấy giao dịch.');
        }

        $responseCode = $params['vnp_ResponseCode'] ?? '99';

        if ($responseCode === '00') {
            // Thanh toán thành công
            $donation->update([
                'Trang_thai'         => 'success',
                'Ma_giao_dich_vnpay' => $params['vnp_TransactionNo'] ?? null,
                'Ma_phan_hoi_vnpay'  => $responseCode,
                'Ma_ngan_hang'       => $params['vnp_BankCode'] ?? null,
                'Thoi_diem_thanh_toan' => now(),
            ]);

            // Cộng tiền vào chiến dịch
            if ($donation->Ma_chien_dich) {
                DonationCampaign::where('Ma_chien_dich', $donation->Ma_chien_dich)
                    ->increment('So_tien_hien_tai', $donation->So_tien);
            }

            // Gửi email cảm ơn nếu user có email
            $donation->load('nguoiDung');
            if ($donation->nguoiDung && $donation->nguoiDung->email) {
                $mailService = app(MailService::class);
                $subject = 'Cảm ơn bạn đã đóng góp cho PetJam';
                $formattedAmount = number_format($donation->So_tien, 0, ',', '.') . 'đ';
                
                $body = "<h2>Xin chào {$donation->Ten_nguoi_ung_ho},</h2>";
                $body .= "<p>PetJam xin chân thành cảm ơn bạn đã đóng góp số tiền <strong>{$formattedAmount}</strong>.</p>";
                $body .= "<p>Mã giao dịch của bạn là: <strong>{$donation->Ma_giao_dich_he_thong}</strong>.</p>";
                if ($donation->Ma_chien_dich) {
                    $campaignName = $donation->chienDich->Ten_chien_dich ?? 'Quỹ chung';
                    $body .= "<p>Đóng góp của bạn đã được ghi nhận vào chiến dịch: <strong>{$campaignName}</strong>.</p>";
                }
                $body .= "<p>Sự ủng hộ của bạn sẽ giúp chúng tôi mang lại cuộc sống tốt đẹp hơn cho các bé thú cưng.</p>";
                $body .= "<br><p>Trân trọng,<br>PetJam Team</p>";

                $mailService->send($donation->nguoiDung->email, $subject, $body);
            }

            return redirect()
                ->route('frontend.donations.index')
                ->with('success', 'Cảm ơn bạn đã ủng hộ! Giao dịch của bạn đã được ghi nhận thành công.');
        } else {
            // Thanh toán thất bại
            $donation->update([
                'Trang_thai'         => 'failed',
                'Ma_phan_hoi_vnpay'  => $responseCode,
            ]);

            return redirect()
                ->route('frontend.donations.index')
                ->with('error', 'Giao dịch thất bại. Vui lòng thử lại.');
        }
    }

    /**
     * Tạo URL thanh toán VNPAY
     */
    private function createVNPayUrl(Donation $donation): string
    {
        $vnpUrl = config('services.vnpay.url');
        $vnpTmnCode = config('services.vnpay.tmn_code');
        $vnpHashSecret = config('services.vnpay.hash_secret');
        $vnpReturnUrl = config('services.vnpay.return_url');

        $inputData = [
            'vnp_Version'    => '2.1.0',
            'vnp_TmnCode'    => $vnpTmnCode,
            'vnp_Amount'     => $donation->So_tien * 100, // VNPAY tính theo đơn vị 100
            'vnp_Command'    => 'pay',
            'vnp_CreateDate' => now()->format('YmdHis'),
            'vnp_CurrCode'   => 'VND',
            'vnp_IpAddr'     => request()->ip(),
            'vnp_Locale'     => 'vn',
            'vnp_OrderInfo'  => 'PetJam - Ung ho quy: ' . $donation->Ma_giao_dich_he_thong,
            'vnp_OrderType'  => 'other',
            'vnp_ReturnUrl'  => $vnpReturnUrl,
            'vnp_TxnRef'     => $donation->Ma_giao_dich_he_thong,
        ];

        ksort($inputData);
        $query = http_build_query($inputData);
        $vnpSecureHash = hash_hmac('sha512', $query, $vnpHashSecret);

        return $vnpUrl . '?' . $query . '&vnp_SecureHash=' . $vnpSecureHash;
    }

    /**
     * Xác minh chữ ký từ VNPAY callback
     */
    private function verifyVNPaySignature(array $params): bool
    {
        $vnpHashSecret = config('services.vnpay.hash_secret');
        $vnpSecureHash = $params['vnp_SecureHash'] ?? '';

        unset($params['vnp_SecureHash'], $params['vnp_SecureHashType']);
        ksort($params);
        $query = http_build_query($params);
        $expectedHash = hash_hmac('sha512', $query, $vnpHashSecret);

        return hash_equals($expectedHash, $vnpSecureHash);
    }
}
