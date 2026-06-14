<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InterviewSlot;
use App\Models\InterviewSchedule;
use App\Models\AdoptionApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class InterviewScheduleController extends Controller
{
    public function index(Request $request)
    {
        $query = InterviewSlot::query();

        // 1. Date Range Filter
        if ($request->filled('dateRange')) {
            $dates = explode(' to ', $request->dateRange);
            if (count($dates) == 2) {
                try {
                    $start = Carbon::createFromFormat('Y-m-d', trim($dates[0]))->startOfDay();
                    $end = Carbon::createFromFormat('Y-m-d', trim($dates[1]))->endOfDay();
                    $query->whereBetween('Ngay', [$start, $end]);
                } catch (\Exception $e) {}
            } elseif (count($dates) == 1) {
                try {
                    $date = Carbon::createFromFormat('Y-m-d', trim($dates[0]))->startOfDay();
                    $query->whereDate('Ngay', $date);
                } catch (\Exception $e) {}
            }
        } else {
            // Default show from today onwards
            $query->where('Ngay', '>=', Carbon::today());
        }

        // Pagination
        $slotsPaginated = $query->orderBy('Ngay')->orderBy('Gio_bat_dau')->paginate(4)->withQueryString();

        $slots = $slotsPaginated->groupBy(function($slot) {
            return Carbon::parse($slot->Ngay)->format('Y-m-d');
        });

        $pendingApplications = AdoptionApplication::with(['nguoiDung', 'thuCung'])
            ->whereIn('Trang_thai', ['cho_phong_van'])
            ->get();

        // Get all upcoming slots for the dropdown in modal
        $allUpcomingSlots = InterviewSlot::whereDate('Ngay', '>=', now())
            ->orderBy('Ngay')
            ->orderBy('Gio_bat_dau')
            ->get();

        return response()->view('admin.interview_schedules.index', compact('slots', 'slotsPaginated', 'pendingApplications', 'allUpcomingSlots'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Ngay' => 'required|date|after_or_equal:today',
            'slots' => 'required|array|min:1',
            'slots.*.Gio_bat_dau' => 'required|date_format:H:i',
            'slots.*.Gio_ket_thuc' => 'required|date_format:H:i|after:slots.*.Gio_bat_dau',
            'slots.*.So_luong_toi_da' => 'required|integer|min:1',
        ], [
            'Ngay.required' => 'Vui lòng chọn ngày phỏng vấn.',
            'Ngay.after_or_equal' => 'Ngày phỏng vấn phải từ hôm nay trở đi.',
            'slots.*.Gio_bat_dau.required' => 'Vui lòng nhập giờ bắt đầu.',
            'slots.*.Gio_ket_thuc.required' => 'Vui lòng nhập giờ kết thúc.',
            'slots.*.Gio_ket_thuc.after' => 'Giờ kết thúc phải sau giờ bắt đầu.',
            'slots.*.So_luong_toi_da.required' => 'Vui lòng nhập sức chứa.',
            'slots.*.So_luong_toi_da.min' => 'Sức chứa tối thiểu là 1.',
        ]);

        $existingSlots = InterviewSlot::where('Ngay', $validated['Ngay'])->where('Trang_thai', '!=', 'huy')->get();
        $newSlots = $validated['slots'];

        foreach ($newSlots as $index => $newSlot) {
            $newStart = Carbon::parse($newSlot['Gio_bat_dau'])->format('H:i:s');
            $newEnd = Carbon::parse($newSlot['Gio_ket_thuc'])->format('H:i:s');

            foreach ($existingSlots as $existingSlot) {
                $existStart = Carbon::parse($existingSlot->Gio_bat_dau)->format('H:i:s');
                $existEnd = Carbon::parse($existingSlot->Gio_ket_thuc)->format('H:i:s');

                if ($newStart < $existEnd && $newEnd > $existStart) {
                    return response()->json([
                        'errors' => [
                            "slots.$index.Gio_bat_dau" => ["Ca này bị trùng lặp thời gian với một ca đã có."],
                            "slots.$index.Gio_ket_thuc" => ["Ca này bị trùng lặp thời gian với một ca đã có."],
                        ]
                    ], 422);
                }
            }

            foreach ($newSlots as $innerIndex => $innerSlot) {
                if ($index === $innerIndex) continue;
                $innerStart = Carbon::parse($innerSlot['Gio_bat_dau'])->format('H:i:s');
                $innerEnd = Carbon::parse($innerSlot['Gio_ket_thuc'])->format('H:i:s');

                if ($newStart < $innerEnd && $newEnd > $innerStart) {
                    return response()->json([
                        'errors' => [
                            "slots.$index.Gio_bat_dau" => ["Ca này bị trùng với ca " . ($innerIndex + 1) . " vừa nhập."],
                            "slots.$index.Gio_ket_thuc" => ["Ca này bị trùng với ca " . ($innerIndex + 1) . " vừa nhập."],
                        ]
                    ], 422);
                }
            }
        }

        foreach ($validated['slots'] as $slot) {
            InterviewSlot::create([
                'Ngay' => $validated['Ngay'],
                'Gio_bat_dau' => $slot['Gio_bat_dau'],
                'Gio_ket_thuc' => $slot['Gio_ket_thuc'],
                'So_luong_toi_da' => $slot['So_luong_toi_da'],
                'Trang_thai' => 'mo',
                'So_luong_hien_tai' => 0,
                'Nhan_vien_xu_ly' => auth()->id() ?? null,
            ]);
        }

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Đã thêm các slot phỏng vấn mới thành công!']);
        }

        return redirect()->route('admin.interview_schedules.index')
            ->with('success', 'Đã thêm các slot phỏng vấn mới thành công!');
    }

    public function destroy($id)
    {
        $slot = InterviewSlot::findOrFail($id);
        
        // UC09: Cảnh báo nếu đã có người đặt (So_luong_hien_tai > 0)
        // Việc hiển thị cảnh báo (Confirm Modal) sẽ được xử lý ở Frontend bằng JS trước khi gọi API xóa.
        // Tại Backend, nếu xóa slot có người đặt thì tự động gửi email (sẽ xử lý sau nếu có logic gửi email)
        
        $slot->delete();

        return redirect()->route('admin.interview_schedules.index')
            ->with('success', 'Đã xóa slot phỏng vấn thành công!');
    }

    public function hide($id)
    {
        $slot = InterviewSlot::findOrFail($id);
        $slot->update(['Trang_thai' => 'huy']); // Ẩn hoặc Hủy

        return redirect()->route('admin.interview_schedules.index')
            ->with('success', 'Đã chuyển trạng thái slot thành Ẩn/Hủy!');
    }

    public function showDetails($id)
    {
        $slot = InterviewSlot::with(['schedules.donNhanNuoi.thuCung', 'schedules.donNhanNuoi.nguoiDung'])->findOrFail($id);
        
        $scheduled = $slot->schedules->filter(function($s) {
            return in_array($s->Ket_qua_phong_van, [null, '']) && in_array($s->Trang_thai, ['cho_xac_nhan_don', 'cho_duyet', 'da_xac_nhan', 'da_doi_lich', 'cho_phong_van']);
        });

        $history = $slot->schedules->filter(function($s) {
            return in_array($s->Ket_qua_phong_van, ['dat', 'tu_choi', 'vang_mat']);
        });

        $pending = AdoptionApplication::with(['nguoiDung', 'thuCung'])
            ->whereIn('Trang_thai', ['cho_xac_nhan_don', 'cho_phong_van'])
            ->whereNull('interview_slot_id')
            ->get();

        $html = view('admin.interview_schedules.partials.slot-details', compact('slot', 'scheduled', 'history', 'pending'))->render();

        return response()->json([
            'html' => $html
        ]);
    }

    public function updateResult(Request $request, $schedule_id)
    {
        $request->validate([
            'result' => 'required|in:dat,tu_choi,vang_mat'
        ]);

        $schedule = InterviewSchedule::with(['donNhanNuoi.nguoiDung', 'donNhanNuoi.thuCung'])->findOrFail($schedule_id);
        $schedule->update(['Ket_qua_phong_van' => $request->result]);

        $application = $schedule->donNhanNuoi;

        if ($application) {
            if ($request->result === 'dat') {
                $application->update(['Trang_thai' => 'da_duyet']);
                try {
                    if ($application->nguoiDung && $application->nguoiDung->Email) {
                        \Illuminate\Support\Facades\Mail::to($application->nguoiDung->Email)
                            ->send(new \App\Mail\InterviewPassedEmail($application));
                    }
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::warning('Không gửi được email interview passed: ' . $e->getMessage());
                }
            } else {
                // tu_choi hoặc vang_mat
                $ghiChu = $request->result === 'vang_mat' ? 'Bạn đã vắng mặt trong buổi phỏng vấn mà không báo trước.' : 'Rất tiếc bạn chưa phù hợp qua vòng phỏng vấn.';
                $application->update([
                    'Trang_thai' => 'tu_choi',
                    'Ghi_chu_admin' => $ghiChu
                ]);
                try {
                    if ($application->nguoiDung && $application->nguoiDung->Email) {
                        \Illuminate\Support\Facades\Mail::to($application->nguoiDung->Email)
                            ->send(new \App\Mail\ApplicationRejectedEmail($application, $ghiChu));
                    }
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::warning('Không gửi được email application rejected: ' . $e->getMessage());
                }
            }
        }

        return response()->json(['success' => true, 'message' => 'Cập nhật kết quả thành công.']);
    }

    public function addApplication(Request $request, $id)
    {
        $request->validate([
            'application_id' => 'required|exists:adoption_applications,Ma_don'
        ]);

        $slot = InterviewSlot::findOrFail($id);
        $application = AdoptionApplication::findOrFail($request->application_id);

        if ($slot->So_luong_hien_tai >= $slot->So_luong_toi_da) {
            return response()->json(['success' => false, 'message' => 'Slot này đã đầy, không thể thêm!'], 400);
        }

        // Tạo hoặc update schedule cho application này
        $schedule = InterviewSchedule::firstOrNew(['Ma_don' => $application->Ma_don]);
        
        // Nếu đã có slot cũ, giảm số lượng hiện tại của slot cũ đi 1
        if ($schedule->exists && $schedule->Ma_slot && $schedule->Ma_slot != $slot->Ma_slot) {
            $oldSlot = InterviewSlot::find($schedule->Ma_slot);
            if ($oldSlot && $oldSlot->So_luong_hien_tai > 0) {
                $oldSlot->decrement('So_luong_hien_tai');
            }
        }

        $schedule->Ma_slot = $slot->Ma_slot;
        $schedule->Trang_thai = 'da_doi_lich'; // Có thể là da_xac_nhan hoặc da_doi_lich tuỳ yêu cầu
        $schedule->save();

        $application->update([
            'Trang_thai' => 'cho_phong_van',
            'interview_slot_id' => $slot->Ma_slot
        ]);

        // Tăng số lượng hiện tại của slot mới
        $slot->increment('So_luong_hien_tai');

        return response()->json(['success' => true, 'message' => 'Cập nhật/Thêm hồ sơ vào lịch thành công!']);
    }
}
