<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdoptionAnswer;
use App\Models\AdoptionApplication;
use App\Models\AdoptionQuestion;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\MailService;

class AdoptionApplicationController extends Controller
{
    /**
     * Form gửi đơn nhận nuôi
     */
    public function create($petId)
    {
        $pet = Pet::findOrFail($petId);

        // Kiểm tra pet còn sẵn sàng không
        if ($pet->Trang_thai !== 'san_sang') {
            return redirect()
                ->route('frontend.adoptions.show', $petId)
                ->with('error', "Rất tiếc! Bé {$pet->Ten} hiện không còn sẵn sàng nhận nuôi.");
        }

        // Kiểm tra user đã có đơn chờ duyệt chưa
        $existingApplication = AdoptionApplication::where('Ma_nguoi_dung', Auth::id())
            ->where('Ma_thu_cung', $petId)
            ->whereIn('Trang_thai', ['pending', 'pre_approved'])
            ->first();

        if ($existingApplication) {
            return redirect()
                ->route('frontend.adoptions.show', $petId)
                ->with('warning', "Bạn đã gửi đơn nhận nuôi bé {$pet->Ten} rồi. Vui lòng chờ xét duyệt.");
        }

        // Kiểm tra giới hạn số lượng đơn nhận nuôi của user (tối đa 3 đơn đang xử lý hoặc đã duyệt)
        $activeApplicationsCount = AdoptionApplication::where('Ma_nguoi_dung', Auth::id())
            ->whereIn('Trang_thai', ['pending', 'pre_approved', 'approved'])
            ->count();
            
        if ($activeApplicationsCount >= 3) {
            return redirect()
                ->route('frontend.adoptions.show', $petId)
                ->with('error', "Bạn đã đạt giới hạn (tối đa 3 đơn nhận nuôi đang xử lý hoặc đã duyệt). Vui lòng hoàn tất các đơn hiện tại trước khi nhận nuôi thêm.");
        }

        // Load câu hỏi từ DB
        $questions = AdoptionQuestion::where('Hoat_dong', true)
            ->orderBy('Thu_tu')
            ->get();

        return view('frontend.adoptions.create', compact('pet', 'questions'));
    }

    /**
     * Xử lý gửi đơn
     */
    public function store(Request $request, $petId)
    {
        // Validate dữ liệu cơ bản
        $validated = $request->validate([
            'Ho_ten'          => 'required|string|max:100',
            'So_dien_thoai'   => ['required', 'string', 'regex:/^(0|\+84)[0-9]{8,9}$/'],
            'Dia_chi'         => 'required|string|max:500',
            'Nghe_nghiep'     => 'nullable|string|max:100',
            'Loai_nha_o'      => 'nullable|string|max:100',
            'Kinh_nghiem'     => 'nullable|string|max:1000',
            'Ly_do_nhan_nuoi' => 'required|string|min:30|max:2000',
            'Cam_ket'         => 'required|accepted',
            'answers'         => 'nullable|array',
        ], [
            'Ho_ten.required'          => 'Vui lòng nhập họ tên.',
            'So_dien_thoai.required'   => 'Vui lòng nhập số điện thoại.',
            'So_dien_thoai.regex'      => 'Số điện thoại không hợp lệ (định dạng Việt Nam).',
            'Dia_chi.required'         => 'Vui lòng nhập địa chỉ.',
            'Ly_do_nhan_nuoi.required' => 'Vui lòng nhập lý do nhận nuôi.',
            'Ly_do_nhan_nuoi.min'      => 'Lý do nhận nuôi cần ít nhất 30 ký tự.',
            'Cam_ket.required'         => 'Vui lòng xác nhận cam kết.',
            'Cam_ket.accepted'         => 'Bạn cần đồng ý với các điều khoản cam kết.',
        ]);

        // Validate câu trả lời bắt buộc
        $questions = AdoptionQuestion::where('Hoat_dong', true)->where('Bat_buoc', true)->get();
        $answers = $request->input('answers', []);

        foreach ($questions as $question) {
            if (empty($answers[$question->Ma_cau_hoi])) {
                return back()
                    ->withInput()
                    ->withErrors(["answers.{$question->Ma_cau_hoi}" => "Câu hỏi \"{$question->Noi_dung}\" là bắt buộc."]);
            }
        }

        try {
            $application = DB::transaction(function () use ($validated, $petId, $answers) {
                // Kiểm tra pet còn san_sang không (race condition)
                $pet = Pet::where('Ma_thu_cung', $petId)
                    ->lockForUpdate()
                    ->first();

                if (!$pet || $pet->Trang_thai !== 'san_sang') {
                    throw new \Exception("Rất tiếc! Bé thú cưng này không còn sẵn sàng nhận nuôi.");
                }

                // Kiểm tra trùng đơn (race condition)
                $duplicate = AdoptionApplication::where('Ma_nguoi_dung', Auth::id())
                    ->where('Ma_thu_cung', $petId)
                    ->whereIn('Trang_thai', ['pending', 'pre_approved'])
                    ->lockForUpdate()
                    ->first();

                if ($duplicate) {
                    throw new \Exception("Bạn đã có đơn đang chờ duyệt cho bé này rồi.");
                }

                // Kiểm tra giới hạn (tối đa 3 đơn)
                $activeApplicationsCount = AdoptionApplication::where('Ma_nguoi_dung', Auth::id())
                    ->whereIn('Trang_thai', ['pending', 'pre_approved', 'approved'])
                    ->lockForUpdate()
                    ->count();

                if ($activeApplicationsCount >= 3) {
                    throw new \Exception("Bạn đã đạt giới hạn (tối đa 3 đơn nhận nuôi đang xử lý hoặc đã duyệt).");
                }

                // Tạo đơn
                $application = AdoptionApplication::create([
                    'Ma_nguoi_dung'   => Auth::id(),
                    'Ma_thu_cung'     => $petId,
                    'Ho_ten'          => $validated['Ho_ten'],
                    'So_dien_thoai'   => $validated['So_dien_thoai'],
                    'Dia_chi'         => $validated['Dia_chi'],
                    'Nghe_nghiep'     => $validated['Nghe_nghiep'] ?? null,
                    'Loai_nha_o'      => $validated['Loai_nha_o'] ?? null,
                    'Kinh_nghiem'     => $validated['Kinh_nghiem'] ?? null,
                    'Ly_do_nhan_nuoi' => $validated['Ly_do_nhan_nuoi'],
                    'Cam_ket'         => true,
                    'Trang_thai'      => 'pending',
                ]);

                // Lưu câu trả lời
                foreach ($answers as $questionId => $answerText) {
                    if (!empty($answerText)) {
                        AdoptionAnswer::create([
                            'Ma_don'      => $application->Ma_don,
                            'Ma_cau_hoi'  => $questionId,
                            'Noi_dung_tra_loi' => is_array($answerText) ? implode(', ', $answerText) : $answerText,
                        ]);
                    }
                }
                
                return $application;
            });
            
            // Gửi thông báo hệ thống cho Admin
            try {
                $admins = \App\Models\User::where('Vai_tro', 'admin')->get();
                \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\NewAdoptionApplication($application));
            } catch (\Exception $e) {
                \Log::error('Lỗi gửi thông báo cho Admin: ' . $e->getMessage());
            }

            // Gửi email xác nhận đã nhận đơn
            try {
                $user = Auth::user();
                if ($user && $user->email) {
                    // Ensure we have the application with relations for the view
                    $app = AdoptionApplication::with(['thuCung'])->find($application->Ma_don);
                    
                    $mailService = app(MailService::class);
                    $subject = "Xác nhận đã nhận đơn đăng ký nhận nuôi thú cưng";
                    $body = view('emails.partials.application_received', [
                        'user' => $user,
                        'application' => $app
                    ])->render();
                    
                    $mailService->send($user->email, $subject, $body);
                }
            } catch (\Exception $e) {
                \Log::error('Lỗi gửi email xác nhận đã nhận đơn: ' . $e->getMessage());
            }

            return redirect()
                ->route('frontend.user.adoptions.index')
                ->with('success', 'Đơn nhận nuôi của bạn đã được gửi thành công! Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * User hủy đơn của chính mình (chỉ khi pending)
     */
    public function cancel($id)
    {
        $application = AdoptionApplication::where('Ma_don', $id)
            ->where('Ma_nguoi_dung', Auth::id())
            ->firstOrFail();

        if ($application->Trang_thai !== 'pending') {
            return back()->with('error', 'Chỉ có thể hủy đơn đang ở trạng thái "Chờ duyệt".');
        }

        $application->update(['Trang_thai' => 'cancelled']);

        return redirect()
            ->route('frontend.user.adoptions.index')
            ->with('success', 'Đã hủy đơn nhận nuôi thành công.');
    }
}
