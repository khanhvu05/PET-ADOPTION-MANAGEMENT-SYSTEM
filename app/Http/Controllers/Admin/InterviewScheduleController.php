<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InterviewSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class InterviewScheduleController extends Controller
{
    public function index(Request $request)
    {
        // Get slots from today onwards, ordered by Date and Start Time
        $slotsQuery = InterviewSlot::where('Ngay', '>=', Carbon::today())
            ->orderBy('Ngay')
            ->orderBy('Gio_bat_dau');
            
        if ($request->filled('status')) {
            $slotsQuery->where('Trang_thai', $request->status);
        }

        $slots = $slotsQuery->get()->groupBy(function($slot) {
            return Carbon::parse($slot->Ngay)->format('Y-m-d');
        });

        return view('admin.interview_schedules.index', compact('slots'));
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
}
