<x-admin-layout>
    <x-slot name="header">
        <a href="#" class="text-slate-500 hover:text-slate-700 transition-colors flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Quản Lý
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-900 font-bold">Lịch phỏng vấn</span>
    </x-slot>

    <div class="max-w-[1600px] mx-auto h-[calc(100vh-100px)] flex flex-col" x-data="interviewManager()">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6 shrink-0">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Quản lý Lịch phỏng vấn</h2>
                <p class="text-sm text-slate-500 mt-1">Thiết lập các khung giờ phỏng vấn để người nhận nuôi có thể đặt lịch</p>
            </div>
            <button x-data @click="$dispatch('open-modal', 'add-slot-modal')" class="bg-teal-600 text-white px-4 py-2.5 rounded-lg text-sm font-semibold hover:bg-teal-700 transition-colors shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Thêm slot mới
            </button>
        </div>

        <!-- Filters Bar -->
        <form method="GET" action="{{ route('admin.interview_schedules.index') }}" x-data="{ submit() { this.$el.submit() } }" class="flex gap-4 mb-6 shrink-0">
            <div class="relative w-72">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400 z-10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <input type="text" name="dateRange" class="w-full bg-white border border-slate-200 rounded-lg text-sm text-slate-600 py-2.5 pl-10 pr-4 shadow-sm focus:border-teal-500 focus:ring-teal-500" placeholder="Chọn khoảng ngày phỏng vấn" value="{{ request('dateRange') }}" x-init="flatpickr($el, { mode: 'range', dateFormat: 'Y-m-d', altInput: true, altFormat: 'd/m/Y', locale: 'vn', onChange: function(selectedDates) { if(selectedDates.length === 2) $el.closest('form').submit(); }, onClose: function(selectedDates) { if(selectedDates.length === 1) $el.closest('form').submit(); } })">
            </div>
            
            @if(request('dateRange'))
                <a href="{{ route('admin.interview_schedules.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-sm font-medium transition-colors">Xóa bộ lọc</a>
            @endif
        </form>

        <!-- Main Layout: Master-Detail -->
        <div class="flex gap-6 flex-1 min-h-0">
            <!-- Left Column: Master List -->
            <div class="w-[300px] shrink-0 flex flex-col gap-4">
                <div class="flex-1 overflow-y-auto space-y-4" id="slot-list-container" style="padding-right: 4px;">
                    @forelse($slots as $date => $daySlots)
                        @foreach($daySlots as $slot)
                            @php
                                $parsedDate = \Carbon\Carbon::parse($date);
                                $percent = $slot->So_luong_toi_da > 0 ? ($slot->So_luong_hien_tai / $slot->So_luong_toi_da) * 100 : 0;
                                $progressColor = $percent >= 100 ? 'bg-teal-500' : 'bg-teal-500';
                            @endphp
                            <div @click="loadSlotDetails('{{ $slot->Ma_slot }}')" 
                                 :class="{'border-teal-500 bg-teal-50/50 ring-1 ring-teal-500 shadow': activeSlot === '{{ $slot->Ma_slot }}', 'border-slate-200 hover:border-teal-300 hover:bg-slate-50 bg-white shadow-sm': activeSlot !== '{{ $slot->Ma_slot }}'}"
                                 class="border rounded-lg p-3 cursor-pointer transition-all flex flex-col relative overflow-hidden group">
                                
                                <div class="flex gap-3">
                                    <div class="w-10 h-10 shrink-0 rounded-lg bg-teal-100 flex flex-col items-center justify-center text-teal-700 font-bold">
                                        <span class="text-[9px] leading-none uppercase mb-0.5">{{ $parsedDate->locale('vi')->translatedFormat('D') }}</span>
                                        <span class="text-base leading-none">{{ $parsedDate->format('d') }}</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex justify-between items-start mb-1">
                                            <div class="font-bold text-slate-800 truncate text-[13px]">Ngày {{ $parsedDate->format('d/m/Y') }}</div>
                                            <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </div>
                                        <div class="text-[11px] text-slate-500 mb-2 truncate">
                                            PETJAM HN • {{ \Carbon\Carbon::parse($slot->Gio_bat_dau)->format('H:i') }} - {{ \Carbon\Carbon::parse($slot->Gio_ket_thuc)->format('H:i') }}
                                        </div>
                                        
                                        <div class="w-full flex items-center gap-2">
                                            <div class="h-1.5 flex-1 bg-slate-100 rounded-full overflow-hidden">
                                                <div class="h-full {{ $progressColor }} rounded-full" style="width: {{ $percent }}%"></div>
                                            </div>
                                            <div class="text-[10px] text-slate-500 font-medium whitespace-nowrap">
                                                {{ $slot->So_luong_hien_tai }}/{{ $slot->So_luong_toi_da }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @empty
                        <div class="text-center py-8 text-slate-500 bg-white rounded-xl border border-slate-200 shadow-sm">
                            <p class="text-sm">Chưa có slot phỏng vấn nào.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($slotsPaginated->hasPages())
                <div class="mt-4 shrink-0">
                    {{ $slotsPaginated->links('admin.pagination.simple') }}
                </div>
                @endif
            </div>

            <!-- Right Column: Detail View -->
            <div class="flex-1 flex flex-col min-h-0 min-w-0 relative">
                <!-- Loading Overlay -->
                <div x-show="loading" class="absolute inset-0 bg-white/50 backdrop-blur-sm z-20 flex items-center justify-center rounded-xl">
                    <svg class="animate-spin h-8 w-8 text-teal-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                </div>

                <!-- Content Container -->
                <div id="slot-details-container" class="h-full" x-html="detailHtml">
                    <div x-show="!activeSlot" class="bg-white rounded-[12px] border border-slate-200 shadow-sm h-full flex flex-col items-center justify-center text-slate-400 p-8 text-center">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-700 mb-2">Chọn một slot phỏng vấn</h3>
                        <p class="text-sm max-w-sm">Vui lòng chọn một slot phỏng vấn từ danh sách bên trái để xem chi tiết danh sách ứng viên và thực hiện cập nhật kết quả.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modals -->
        @include('admin.interview_schedules.partials.add-application-modal')

        <!-- Add Slot Modal (Keep old modal logic here, but wrapped in blade component) -->
        <x-modal name="add-slot-modal" focusable maxWidth="md">
            <form @submit.prevent="submitForm" class="p-6" x-data="addSlotForm()">
                <!-- content remains unchanged... -->
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center text-teal-700 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">Thêm Slot Mới</h2>
                        <p class="text-xs text-slate-500">Thiết lập thời gian phỏng vấn</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <x-input-label for="Ngay" value="Ngày phỏng vấn" />
                        <x-text-input id="Ngay" class="block mt-1 w-full" type="date" x-model="Ngay" @input="NgayError = ''"
                                      x-bind:class="NgayError ? 'border-red-300 focus:border-red-500 focus:ring-red-500 text-red-900 bg-red-50' : 'border-slate-200 focus:border-teal-500 focus:ring-teal-500 text-slate-900 focus:bg-white'" />
                        <template x-if="NgayError">
                            <p class="text-[11px] text-red-500 mt-1.5 font-medium" x-text="NgayError"></p>
                        </template>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center justify-between pt-2">
                            <h3 class="text-sm font-semibold text-slate-700">Các khung giờ</h3>
                            <button type="button" @click="slots.push({ id: Date.now(), start: '', end: '', max: 1, errors: {} })" class="text-xs text-teal-600 hover:text-teal-700 font-bold flex items-center gap-1 bg-teal-50 hover:bg-teal-100 px-3 py-1.5 rounded-lg transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                                Thêm giờ
                            </button>
                        </div>
                        
                        <div class="space-y-4 mt-2">
                            <template x-for="(slot, index) in slots" :key="slot.id">
                                <div class="p-4 bg-white border border-slate-200 rounded-xl shadow-sm group hover:border-teal-200 transition-colors">
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider" x-text="'Ca ' + (index + 1)"></span>
                                        <button type="button" x-show="slots.length > 1" @click="slots.splice(index, 1)" class="text-slate-400 hover:text-red-500 hover:bg-red-50 rounded p-1 transition-colors" title="Xóa ca này">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                    
                                    <div class="flex flex-col sm:flex-row gap-4 items-start">
                                        <div class="flex-1 w-full">
                                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Bắt đầu</label>
                                            <input type="time" :name="`slots[${index}][Gio_bat_dau]`" x-model="slot.start" @input="slot.errors.start = ''"
                                                   class="w-full px-3 py-2 bg-slate-50 border rounded-lg text-sm transition-colors shadow-sm focus:outline-none focus:ring-1"
                                                   :class="slot.errors?.start ? 'border-red-300 focus:border-red-500 focus:ring-red-500 text-red-900 bg-red-50' : 'border-slate-200 focus:border-teal-500 focus:ring-teal-500 text-slate-900 focus:bg-white'">
                                            <template x-if="slot.errors?.start">
                                                <p class="text-[11px] text-red-500 mt-1.5 font-medium" x-text="slot.errors.start"></p>
                                            </template>
                                        </div>
                                        <div class="flex-1 w-full">
                                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Kết thúc</label>
                                            <input type="time" :name="`slots[${index}][Gio_ket_thuc]`" x-model="slot.end" @input="slot.errors.end = ''"
                                                   class="w-full px-3 py-2 bg-slate-50 border rounded-lg text-sm transition-colors shadow-sm focus:outline-none focus:ring-1"
                                                   :class="slot.errors?.end ? 'border-red-300 focus:border-red-500 focus:ring-red-500 text-red-900 bg-red-50' : 'border-slate-200 focus:border-teal-500 focus:ring-teal-500 text-slate-900 focus:bg-white'">
                                            <template x-if="slot.errors?.end">
                                                <p class="text-[11px] text-red-500 mt-1.5 font-medium" x-text="slot.errors.end"></p>
                                            </template>
                                        </div>
                                        <div class="flex-1 w-full">
                                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Sức chứa</label>
                                            <input type="number" min="1" :name="`slots[${index}][So_luong_toi_da]`" x-model="slot.max" @input="slot.errors.max = ''"
                                                   class="w-full px-3 py-2 bg-slate-50 border rounded-lg text-sm transition-colors shadow-sm focus:outline-none focus:ring-1 text-center"
                                                   :class="slot.errors?.max ? 'border-red-300 focus:border-red-500 focus:ring-red-500 text-red-900 bg-red-50' : 'border-slate-200 focus:border-teal-500 focus:ring-teal-500 text-slate-900 focus:bg-white'">
                                            <template x-if="slot.errors?.max">
                                                <p class="text-[11px] text-red-500 mt-1.5 font-medium" x-text="slot.errors.max"></p>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2.5 text-sm font-semibold rounded-xl transition-colors bg-slate-100 text-slate-600 hover:bg-slate-200">
                        Hủy
                    </button>
                    <button type="submit" class="px-4 py-2.5 text-sm font-semibold rounded-xl transition-colors shadow-sm flex items-center gap-2 bg-teal-600 text-white hover:bg-teal-700" :disabled="isSubmitting">
                        <span x-text="isSubmitting ? 'Đang lưu...' : 'Lưu Slot'"></span>
                    </button>
                </div>
            </form>
        </x-modal>

    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('interviewManager', () => ({
                activeSlot: null,
                loading: false,
                detailHtml: '',

                init() {
                    window.addEventListener('reload-active-slot', () => {
                        if (this.activeSlot) {
                            const slotId = this.activeSlot;
                            this.activeSlot = null;
                            this.loadSlotDetails(slotId);
                        } else {
                            window.location.reload();
                        }
                    });
                },

                async loadSlotDetails(id) {
                    if (this.activeSlot === id) return; // Đang chọn rồi
                    
                    this.activeSlot = id;
                    this.loading = true;
                    this.detailHtml = '';

                    try {
                        const res = await fetch(`/quan-tri/lich-phong-van/${id}/details?t=${Date.now()}`);
                        if (!res.ok) throw new Error('Network response was not ok');
                        const data = await res.json();
                        this.detailHtml = data.html;
                    } catch (error) {
                        window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'error', message: 'Không thể tải chi tiết.' }}));
                    } finally {
                        this.loading = false;
                    }
                }
            }));

            // Logic to update result (used globally in slot-details html)
            window.updateResult = async (scheduleId, result) => {
                let reason = '';
                if (result === 'tu_choi') {
                    const { value: text } = await Swal.fire({
                        title: 'Lý do không đạt',
                        input: 'textarea',
                        inputPlaceholder: 'Nhập lý do ứng viên không đạt phỏng vấn...',
                        showCancelButton: true,
                        confirmButtonText: 'Xác nhận',
                        cancelButtonText: 'Hủy',
                        inputValidator: (value) => {
                            if (!value) {
                                return 'Bạn cần nhập lý do!'
                            }
                        },
                        customClass: {
                            confirmButton: 'bg-red-600 hover:bg-red-700 text-white font-semibold rounded-[10px] px-6 py-2.5 transition-colors shadow-sm',
                            cancelButton: 'bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-[10px] px-6 py-2.5 transition-colors shadow-sm'
                        }
                    });
                    if (text) {
                        reason = text;
                    } else {
                        return; // Cancelled
                    }
                } else if (result === 'dat') {
                    const confirm = await Swal.fire({
                        title: 'Xác nhận',
                        text: 'Bạn đánh giá ứng viên này Đạt phỏng vấn? Đơn sẽ chuyển sang trạng thái PV thành công.',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Đồng ý',
                        cancelButtonText: 'Hủy',
                        customClass: {
                            confirmButton: 'bg-green-600 hover:bg-green-700 text-white font-semibold rounded-[10px] px-6 py-2.5 transition-colors shadow-sm',
                            cancelButton: 'bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-[10px] px-6 py-2.5 transition-colors shadow-sm'
                        }
                    });
                    if (!confirm.isConfirmed) return;
                }

                try {
                    const response = await fetch(`/quan-tri/lich-phong-van/update-result/${scheduleId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ result, reason })
                    });
                    
                    const data = await response.json();
                    
                    if (response.ok) {
                        window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'success', message: data.message }}));
                        // Trigger reload via Alpine component event
                        window.dispatchEvent(new CustomEvent('reload-active-slot'));
                    } else {
                        window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'error', message: data.message || 'Lỗi!' }}));
                    }
                } catch(error) {
                    console.error(error);
                    window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'error', message: 'Lỗi máy chủ!' }}));
                }
            };

            Alpine.data('addSlotForm', () => ({
                Ngay: '',
                NgayError: '',
                slots: [{ id: Date.now(), start: '', end: '', max: 1, errors: {} }],
                isSubmitting: false,

                init() {
                    window.addEventListener('open-modal', (event) => {
                        if (event.detail === 'add-slot-modal') {
                            this.NgayError = '';
                            this.slots.forEach(s => s.errors = {});
                        }
                    });
                },

                async submitForm() {
                    this.isSubmitting = true;
                    this.NgayError = '';
                    this.slots.forEach(s => s.errors = {});

                    try {
                        const response = await fetch('{{ route('admin.interview_schedules.store') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                Ngay: this.Ngay,
                                slots: this.slots.map(s => ({
                                    Gio_bat_dau: s.start,
                                    Gio_ket_thuc: s.end,
                                    So_luong_toi_da: s.max
                                }))
                            })
                        });

                        if (response.ok) {
                            sessionStorage.setItem('toastMessage', 'Đã thêm các slot phỏng vấn mới thành công!');
                            window.location.reload();
                        } else if (response.status === 422) {
                            const data = await response.json();
                            const errors = data.errors;
                            
                            if (errors['Ngay']) this.NgayError = errors['Ngay'][0];
                            
                            this.slots.forEach((slot, index) => {
                                if (errors[`slots.${index}.Gio_bat_dau`]) slot.errors.start = errors[`slots.${index}.Gio_bat_dau`][0];
                                if (errors[`slots.${index}.Gio_ket_thuc`]) slot.errors.end = errors[`slots.${index}.Gio_ket_thuc`][0];
                                if (errors[`slots.${index}.So_luong_toi_da`]) slot.errors.max = errors[`slots.${index}.So_luong_toi_da`][0];
                            });
                        } else {
                            window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'error', message: 'Có lỗi xảy ra, vui lòng thử lại sau.' }}));
                        }
                    } catch (error) {
                        window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'error', message: 'Lỗi kết nối máy chủ.' }}));
                    } finally {
                        this.isSubmitting = false;
                    }
                }
            }));
            
            // Notification toast check
            const msg = sessionStorage.getItem('toastMessage');
            if (msg) {
                setTimeout(() => { window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'success', message: msg }})); }, 100);
                sessionStorage.removeItem('toastMessage');
            }
        });

        // ============================================================
        // Vanilla JS Dropdown for slot-details (injected via x-html)
        // Alpine.js directives don't work inside x-html injected content
        // ============================================================
        function toggleSlotDropdown(btn) {
            const menu = btn.nextElementSibling;
            const isHidden = menu.classList.contains('hidden');
            closeAllSlotDropdowns();
            if (isHidden) {
                menu.classList.remove('hidden');
            }
        }

        function closeAllSlotDropdowns() {
            document.querySelectorAll('.slot-dropdown').forEach(d => d.classList.add('hidden'));
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.slot-dropdown') && !e.target.closest('button[onclick*="toggleSlotDropdown"]')) {
                closeAllSlotDropdowns();
            }
        });
    </script>
</x-admin-layout>
