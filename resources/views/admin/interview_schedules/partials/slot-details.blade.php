<div class="bg-white rounded-xl border border-slate-200 shadow-sm h-full flex flex-col overflow-hidden">
    @php
        $parsedDate = \Carbon\Carbon::parse($slot->Ngay);
    @endphp
    <!-- Header -->
    <div class="p-6 border-b border-slate-100 flex items-center justify-between shrink-0">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-teal-50 flex flex-col items-center justify-center text-teal-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <h3 class="text-xl font-bold text-slate-800">Ngày {{ $parsedDate->format('d/m/Y') }} ({{ $parsedDate->locale('vi')->translatedFormat('l') }})</h3>
                <div class="flex items-center gap-3 mt-1.5">
                    <span class="text-sm font-medium text-slate-600">{{ \Carbon\Carbon::parse($slot->Gio_bat_dau)->format('H:i') }} - {{ \Carbon\Carbon::parse($slot->Gio_ket_thuc)->format('H:i') }} • PETJAM Hà Nội</span>
                    <span class="px-2.5 py-0.5 rounded-full bg-teal-50 text-teal-700 text-xs font-bold">{{ $slot->So_luong_hien_tai }}/{{ $slot->So_luong_toi_da }} đã đăng ký</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Scrollable Content -->
    <div class="flex-1 overflow-auto p-6 space-y-8 relative">
        <!-- 1. Danh sách hồ sơ phỏng vấn -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-bold text-slate-800">Danh sách hồ sơ phỏng vấn ({{ $scheduled->count() }})</h4>
                <button type="button" onclick="document.getElementById('modal-slot-id').value = '{{ $slot->Ma_slot }}'; window.dispatchEvent(new CustomEvent('open-modal', { detail: 'add-application-modal' }))" class="flex items-center gap-1.5 px-3 py-1.5 border border-teal-200 text-teal-700 bg-teal-50 hover:bg-teal-100 rounded text-sm font-semibold transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Thêm hồ sơ (đổi lịch)
                </button>
            </div>

            <div class="border border-slate-200 rounded-lg overflow-visible">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-semibold text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-4 py-3 text-center w-10">STT</th>
                            <th class="px-4 py-3">HỒ SƠ & THÚ CƯNG</th>
                            <th class="px-4 py-3 min-w-[140px]">NGƯỜI NHẬN NUÔI</th>
                            <th class="px-4 py-3 whitespace-nowrap">THỜI GIAN ĐĂNG KÝ</th>
                            <th class="px-4 py-3 text-center whitespace-nowrap">TRẠNG THÁI</th>
                            <th class="px-4 py-3 text-center whitespace-nowrap w-24">THAO TÁC</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($scheduled as $index => $s)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-4 py-4 text-center font-medium text-slate-500">{{ $index + 1 }}</td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-slate-100 overflow-hidden shrink-0">
                                            @if($s->donNhanNuoi->thuCung && $s->donNhanNuoi->thuCung->anh_url)
                                                <img src="{{ $s->donNhanNuoi->thuCung->anh_url }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-800">{{ $s->donNhanNuoi->thuCung->Ten ?? 'Không rõ' }}</div>
                                            <div class="text-xs text-slate-500">{{ $s->donNhanNuoi->thuCung->Giong ?? 'Giống' }} • {{ $s->donNhanNuoi->thuCung->Tuoi ?? 0 }} tuổi</div>
                                            <div class="text-[10px] text-slate-400 mt-0.5 truncate max-w-[150px]">HS-{{ Carbon\Carbon::parse($s->donNhanNuoi->Ngay_tao)->format('Y') }}-{{ substr($s->donNhanNuoi->Ma_don, 0, 8) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="font-bold text-slate-800">{{ $s->donNhanNuoi->Ho_ten }}</div>
                                    <div class="text-xs text-slate-500">{{ $s->donNhanNuoi->So_dien_thoai }}</div>
                                    <div class="text-xs text-slate-500">{{ $s->donNhanNuoi->nguoiDung->email ?? 'N/A' }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-700 font-medium">{{ Carbon\Carbon::parse($s->donNhanNuoi->Ngay_tao)->format('d/m/Y') }}</div>
                                    <div class="text-xs text-slate-500">{{ Carbon\Carbon::parse($s->donNhanNuoi->Ngay_tao)->format('H:i') }}</div>
                                </td>
                                <td class="px-4 py-4 text-center whitespace-nowrap">
                                    @php
                                        $statusMap = [
                                            'cho_xac_nhan_don' => ['label' => 'Đang xử lý', 'class' => 'bg-amber-50 text-amber-700 border-amber-200'],
                                            'cho_duyet'        => ['label' => 'Chờ duyệt', 'class' => 'bg-slate-100 text-slate-600 border-slate-200'],
                                            'da_xac_nhan'      => ['label' => 'Đã xác nhận', 'class' => 'bg-blue-50 text-blue-700 border-blue-200'],
                                            'cho_phong_van'    => ['label' => 'Đang xử lý', 'class' => 'bg-blue-50 text-blue-700 border-blue-200'],
                                            'da_doi_lich'      => ['label' => 'Đã đổi lịch', 'class' => 'bg-purple-50 text-purple-700 border-purple-200'],
                                        ];
                                        $st = $statusMap[$s->Trang_thai] ?? ['label' => $s->Trang_thai, 'class' => 'bg-slate-100 text-slate-600 border-slate-200'];
                                    @endphp
                                    <span class="inline-flex items-center justify-center min-w-[90px] px-3 py-1.5 rounded-full text-xs font-bold border {{ $st['class'] }}">
                                        {{ $st['label'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-center whitespace-nowrap">
                                    <div class="relative inline-block">
                                        <button
                                            type="button"
                                            onclick="toggleSlotDropdown(this)"
                                            class="p-2 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-100 transition-colors border border-transparent hover:border-slate-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                        </button>
                                        <div class="slot-dropdown hidden absolute right-0 top-full mt-1 w-48 bg-white border border-slate-200 rounded-lg shadow-xl z-[999] py-1">
                                            <a href="{{ route('admin.adoptions.show', $s->donNhanNuoi->Ma_don) }}" class="flex items-center gap-2 w-full text-left px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 font-medium">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                Xem chi tiết
                                            </a>
                                            <div class="h-px bg-slate-100 my-1"></div>
                                            <button
                                                type="button"
                                                onclick="closeAllSlotDropdowns(); updateResult('{{ $s->Ma_lich }}', 'dat')"
                                                class="flex items-center gap-2 w-full text-left px-4 py-2.5 text-sm text-green-600 hover:bg-green-50 font-medium">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Đánh giá Đạt
                                            </button>
                                            <button
                                                type="button"
                                                onclick="closeAllSlotDropdowns(); updateResult('{{ $s->Ma_lich }}', 'tu_choi')"
                                                class="flex items-center gap-2 w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 font-medium">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Đánh giá Không đạt
                                            </button>
                                            <button
                                                type="button"
                                                onclick="closeAllSlotDropdowns(); updateResult('{{ $s->Ma_lich }}', 'vang_mat')"
                                                class="flex items-center gap-2 w-full text-left px-4 py-2.5 text-sm text-slate-500 hover:bg-slate-50 font-medium">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                                Vắng mặt
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-slate-400 text-sm">Chưa có ứng viên nào đặt lịch.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 2. Danh sách chờ -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-bold text-slate-800">Danh sách chờ ({{ $pending->count() }})</h4>
            </div>
            <div class="border border-slate-200 rounded-lg overflow-hidden">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-semibold text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-4 py-3 text-center w-10">STT</th>
                            <th class="px-4 py-3">HỒ SƠ & THÚ CƯNG</th>
                            <th class="px-4 py-3 min-w-[140px]">NGƯỜI NHẬN NUÔI</th>
                            <th class="px-4 py-3 whitespace-nowrap">THỜI GIAN ĐĂNG KÝ</th>
                            <th class="px-4 py-3 text-center whitespace-nowrap">TRẠNG THÁI</th>
                            <th class="px-4 py-3 text-center whitespace-nowrap w-24">THAO TÁC</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($pending as $index => $p)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-4 py-4 text-center font-medium text-slate-500">{{ $index + 1 }}</td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-slate-100 overflow-hidden shrink-0">
                                            @if($p->thuCung && $p->thuCung->anh_url)
                                                <img src="{{ $p->thuCung->anh_url }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-800">{{ $p->thuCung->Ten ?? 'Không rõ' }}</div>
                                            <div class="text-xs text-slate-500">{{ $p->thuCung->Giong ?? 'Giống' }} • {{ $p->thuCung->Tuoi ?? 0 }} tuổi</div>
                                            <div class="text-[10px] text-slate-400 mt-0.5 truncate max-w-[150px]">HS-{{ Carbon\Carbon::parse($p->Ngay_tao)->format('Y') }}-{{ substr($p->Ma_don, 0, 8) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="font-bold text-slate-800">{{ $p->Ho_ten }}</div>
                                    <div class="text-xs text-slate-500">{{ $p->So_dien_thoai }}</div>
                                    <div class="text-xs text-slate-500">{{ $p->nguoiDung->email ?? 'N/A' }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-700 font-medium">{{ Carbon\Carbon::parse($p->Ngay_tao)->format('d/m/Y') }}</div>
                                    <div class="text-xs text-slate-500">{{ Carbon\Carbon::parse($p->Ngay_tao)->format('H:i') }}</div>
                                </td>
                                <td class="px-4 py-4 text-center whitespace-nowrap">
                                    <span class="inline-flex items-center justify-center min-w-[90px] px-3 py-1.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        Chờ xác nhận
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-center whitespace-nowrap">
                                    <div class="relative inline-block">
                                        <button
                                            type="button"
                                            onclick="toggleSlotDropdown(this)"
                                            class="p-2 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-100 transition-colors border border-transparent hover:border-slate-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                        </button>
                                        <div class="slot-dropdown hidden absolute right-0 top-full mt-1 w-48 bg-white border border-slate-200 rounded-lg shadow-xl z-[999] py-1">
                                            <a href="{{ route('admin.adoptions.show', $p->Ma_don) }}" class="flex items-center gap-2 w-full text-left px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 font-medium">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                Xem chi tiết
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-slate-400 text-sm">Không có hồ sơ nào đang chờ.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 3. Lịch sử phỏng vấn -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-bold text-slate-800">Lịch sử phỏng vấn ({{ $history->count() }})</h4>
            </div>

            @if($history->count() > 0)
            <div class="border border-slate-200 rounded-lg overflow-visible mb-8">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-semibold text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-4 py-3 text-center w-10">STT</th>
                            <th class="px-4 py-3">HỒ SƠ & THÚ CƯNG</th>
                            <th class="px-4 py-3 min-w-[140px]">NGƯỜI NHẬN NUÔI</th>
                            <th class="px-4 py-3 text-center whitespace-nowrap">KẾT QUẢ</th>
                            <th class="px-4 py-3 text-center whitespace-nowrap w-24">THAO TÁC</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($history as $index => $h)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-4 py-4 text-center font-medium text-slate-500">{{ $index + 1 }}</td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-slate-100 overflow-hidden shrink-0">
                                            @if($h->donNhanNuoi->thuCung && $h->donNhanNuoi->thuCung->anh_url)
                                                <img src="{{ $h->donNhanNuoi->thuCung->anh_url }}" class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-800">{{ $h->donNhanNuoi->thuCung->Ten ?? 'Không rõ' }}</div>
                                            <div class="text-[10px] text-slate-400 mt-0.5 truncate max-w-[150px]">HS-{{ Carbon\Carbon::parse($h->donNhanNuoi->Ngay_tao)->format('Y') }}-{{ substr($h->donNhanNuoi->Ma_don, 0, 8) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="font-bold text-slate-800">{{ $h->donNhanNuoi->Ho_ten }}</div>
                                    <div class="text-xs text-slate-500">{{ $h->donNhanNuoi->So_dien_thoai }}</div>
                                </td>
                                <td class="px-4 py-4 text-center whitespace-nowrap">
                                    @if($h->Ket_qua_phong_van == 'dat')
                                        <span class="inline-flex items-center justify-center min-w-[90px] px-3 py-1.5 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-200">Đạt</span>
                                    @elseif($h->Ket_qua_phong_van == 'tu_choi')
                                        <span class="inline-flex items-center justify-center min-w-[90px] px-3 py-1.5 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-200">Từ chối</span>
                                    @elseif($h->Ket_qua_phong_van == 'vang_mat')
                                        <span class="inline-flex items-center justify-center min-w-[90px] px-3 py-1.5 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">Vắng mặt</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-center whitespace-nowrap">
                                    <div class="relative inline-block">
                                        <button
                                            type="button"
                                            onclick="toggleSlotDropdown(this)"
                                            class="p-2 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-100 transition-colors border border-transparent hover:border-slate-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                        </button>
                                        <div class="slot-dropdown hidden absolute right-0 top-full mt-1 w-48 bg-white border border-slate-200 rounded-lg shadow-xl z-[999] py-1">
                                            <a href="{{ route('admin.adoptions.show', $h->donNhanNuoi->Ma_don) }}" class="flex items-center gap-2 w-full text-left px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 font-medium">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                Xem chi tiết
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="bg-white border border-slate-200 rounded-lg p-10 flex flex-col items-center justify-center mb-8">
                <img src="{{ asset('assets/images/no-history.png') }}" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMDAgMTAwIj48dGV4dCB5PSI1MCIgZm9udC1zaXplPSI0MCIgeD0iMzAiPvCfkLY8L3RleHQ+PC9zdmc+'" alt="Empty" class="w-32 h-32 opacity-80 mb-4 mix-blend-multiply">
                <h5 class="text-slate-800 font-bold mb-1">Chưa có lịch sử phỏng vấn nào</h5>
                <p class="text-sm text-slate-500">Các hồ sơ sau khi phỏng vấn sẽ hiển thị tại đây.</p>
            </div>
            @endif
        </div>
    </div>
</div>
