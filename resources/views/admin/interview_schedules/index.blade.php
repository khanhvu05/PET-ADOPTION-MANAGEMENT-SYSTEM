<x-admin-layout>
    <x-slot name="header">
        Lịch phỏng vấn
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6" x-data="{ slotToHide: null, slotToDelete: null }">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Quản lý Lịch phỏng vấn</h2>
                <p class="text-sm text-slate-500 mt-1">Thiết lập các khung giờ phỏng vấn để người nhận nuôi có thể đặt lịch</p>
            </div>
            <button x-data @click="$dispatch('open-modal', 'add-slot-modal')" class="bg-teal-600 text-white px-4 py-2.5 rounded-[10px] text-sm font-semibold hover:bg-teal-700 transition-colors shadow-sm flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Thêm slot mới
            </button>
        </div>



        <!-- Timeline / Day Cards -->
        <div class="space-y-6">
            @forelse($slots as $date => $daySlots)
                <div class="bg-white rounded-[12px] border border-slate-200 shadow-sm">
                    <div class="bg-slate-50/80 px-5 py-3 border-b border-slate-200 flex items-center gap-3" style="border-top-left-radius: 12px; border-top-right-radius: 12px;">
                        @php
                            $parsedDate = \Carbon\Carbon::parse($date);
                        @endphp
                        <div class="w-11 h-11 rounded-[10px] bg-teal-100 flex flex-col items-center justify-center text-teal-800">
                            <span class="text-[10px] font-bold uppercase leading-none">{{ $parsedDate->locale('vi')->translatedFormat('D') }}</span>
                            <span class="text-lg font-black leading-none mt-0.5">{{ $parsedDate->format('d') }}</span>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-800">Ngày {{ $parsedDate->format('d/m/Y') }}</h3>
                            <p class="text-xs text-slate-500">{{ $daySlots->count() }} slot phỏng vấn</p>
                        </div>
                    </div>
                    
                    <div class="p-5 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        @foreach($daySlots as $slot)
                            <div x-data="{ slotHidden: false }" x-show="!slotHidden" x-transition
                                 x-on:slot-deleted.window="if($event.detail == '{{ $slot->Ma_slot }}') slotHidden = true"
                                 x-on:slot-restored.window="if($event.detail == '{{ $slot->Ma_slot }}') slotHidden = false"
                                 class="border {{ $slot->Trang_thai === 'huy' ? 'border-red-100 bg-red-50/30' : 'border-slate-200 bg-white' }} rounded-[10px] p-4 flex flex-col shadow-sm transition-shadow hover:shadow-md relative group">
                                
                                @if($slot->Trang_thai === 'huy')
                                    <div class="absolute inset-0 bg-white/50 backdrop-blur-[1px] z-10 flex flex-col items-center justify-center rounded-[10px]">
                                        <span class="bg-red-100 text-red-600 px-3 py-1 rounded-[6px] text-xs font-bold border border-red-200">Đã Hủy/Ẩn</span>
                                    </div>
                                @endif

                                <div class="flex justify-between items-start mb-3">
                                    <div class="flex items-center gap-2 text-teal-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="text-sm font-bold">{{ \Carbon\Carbon::parse($slot->Gio_bat_dau)->format('H:i') }} - {{ \Carbon\Carbon::parse($slot->Gio_ket_thuc)->format('H:i') }}</span>
                                    </div>
                                    
                                    <!-- Dropdown Menu -->
                                    <div class="relative" x-data="{ menuOpen: false }">
                                        <button @click="menuOpen = !menuOpen" @click.away="menuOpen = false" class="text-slate-400 hover:text-slate-600 p-1 rounded-full hover:bg-slate-100 transition-colors z-20 relative">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                        </button>
                                        
                                        <div x-show="menuOpen" x-transition class="absolute right-0 mt-1 bg-white border border-slate-200 shadow-lg py-1 z-30" style="min-width: 140px; display: flex; flex-direction: column; border-radius: 8px;">
                                            @if($slot->Trang_thai !== 'huy')
                                                <button @click="slotToHide = '{{ $slot->Ma_slot }}'; $dispatch('open-modal', 'hide-slot-modal'); menuOpen = false" class="text-sm text-slate-700 hover:bg-slate-50 transition-colors" style="width: 100%; text-align: left; padding: 8px 16px; white-space: nowrap;">Ẩn Slot</button>
                                            @endif
                                            <button @click="slotToDelete = { id: '{{ $slot->Ma_slot }}', count: {{ $slot->So_luong_hien_tai }} }; $dispatch('open-modal', 'delete-slot-modal'); menuOpen = false" class="text-sm transition-colors font-medium hover:bg-red-50" style="width: 100%; text-align: left; padding: 8px 16px; white-space: nowrap; color: #dc2626;">Xóa Slot</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-auto">
                                    <div class="flex justify-between items-center text-xs text-slate-500 mb-1.5 font-medium">
                                        <span>Đã đăng ký</span>
                                        <span class="{{ $slot->So_luong_hien_tai >= $slot->So_luong_toi_da ? 'text-red-600 font-bold' : 'text-teal-600' }}">
                                            {{ $slot->So_luong_hien_tai }} / {{ $slot->So_luong_toi_da }}
                                        </span>
                                    </div>
                                    <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                                        @php
                                            $percent = $slot->So_luong_toi_da > 0 ? ($slot->So_luong_hien_tai / $slot->So_luong_toi_da) * 100 : 0;
                                            $progressColor = $percent >= 100 ? 'bg-red-500' : 'bg-teal-500';
                                        @endphp
                                        <div class="h-full {{ $progressColor }} rounded-full" style="width: {{ $percent }}%"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="bg-white border border-dashed border-slate-300 rounded-[12px] p-12 text-center flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-800 mb-1">Chưa có slot phỏng vấn nào</h3>
                    <p class="text-sm text-slate-500 max-w-sm mx-auto">Bạn chưa tạo slot phỏng vấn nào trong tương lai. Nhấn "Thêm slot mới" để bắt đầu thiết lập lịch.</p>
                </div>
            @endforelse
        </div>

        <!-- Add Slot Modal -->
        <x-modal name="add-slot-modal" focusable maxWidth="md">
            <form @submit.prevent="submitForm" class="p-6" x-data="addSlotForm()">
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
                    <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2.5 text-sm font-semibold rounded-xl transition-colors" style="background-color: #f1f5f9; color: #475569; border: none;">
                        Hủy
                    </button>
                    <button type="submit" class="px-4 py-2.5 text-sm font-semibold rounded-xl transition-colors shadow-sm flex items-center gap-2" :disabled="isSubmitting" style="background-color: #0d9488; color: white; border: none;">
                        <svg x-show="isSubmitting" class="animate-spin -ml-1 mr-1 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        <span x-text="isSubmitting ? 'Đang lưu...' : 'Lưu Slot'"></span>
                    </button>
                </div>
            </form>
        </x-modal>

        <!-- Hide Slot Modal -->
        <x-modal name="hide-slot-modal" focusable maxWidth="sm">
            <form method="POST" :action="`/admin/interview_schedules/${slotToHide}/hide`" class="p-6 text-center">
                @csrf
                @method('PUT')
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                </div>
                <h2 class="text-lg font-bold text-slate-800 mb-2">Bạn có chắc muốn ẩn slot này?</h2>
                <p class="text-sm text-slate-500 mb-6">Slot sẽ không hiển thị với người dùng nữa, nhưng vẫn được lưu trên hệ thống.</p>
                <div class="flex justify-center gap-3">
                    <button type="button" x-on:click="$dispatch('close')" class="px-5 py-2.5 text-sm font-semibold rounded-xl transition-colors" style="background-color: #f1f5f9; color: #475569; border: none;">
                        Hủy
                    </button>
                    <button type="submit" class="px-5 py-2.5 text-sm font-semibold rounded-xl transition-colors shadow-sm" style="background-color: #ea580c; color: white; border: none;">
                        Xác nhận Ẩn
                    </button>
                </div>
            </form>
        </x-modal>

        <!-- Delete Slot Modal -->
        <x-modal name="delete-slot-modal" focusable maxWidth="sm">
            <form @submit.prevent="confirmDelete" class="p-6 text-center" x-data="deleteSlotForm()">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </div>
                <h2 class="text-lg font-bold text-slate-800 mb-2">Xác nhận Xóa Slot?</h2>
                <div x-show="slotToDelete?.count > 0" class="mb-4 text-left bg-red-50 text-red-700 p-3 rounded-[8px] border border-red-100 text-sm">
                    <strong>⚠️ Cảnh báo quan trọng:</strong> Hiện đang có <span x-text="slotToDelete?.count" class="font-bold"></span> người đăng ký phỏng vấn vào slot này. 
                    Việc xóa sẽ hủy lịch của họ và hệ thống sẽ tự động thông báo qua Email.
                </div>
                <p x-show="!slotToDelete?.count || slotToDelete?.count === 0" class="text-sm text-slate-500 mb-6">Bạn có chắc chắn muốn xóa slot phỏng vấn này không? Hành động này không thể hoàn tác.</p>
                <div class="flex justify-center gap-3">
                    <button type="button" x-on:click="$dispatch('close')" class="px-5 py-2.5 text-sm font-semibold rounded-xl transition-colors" style="background-color: #f1f5f9; color: #475569; border: none;">
                        Hủy
                    </button>
                    <button type="submit" class="px-5 py-2.5 text-sm font-semibold rounded-xl transition-colors shadow-sm" style="background-color: #dc2626; color: white; border: none;">
                        Xác nhận Xóa
                    </button>
                </div>
            </form>
        </x-modal>

    </div>

    <!-- Error Handling for Modals and Toast from sessionStorage -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if ($errors->any())
                window.dispatchEvent(new CustomEvent('open-modal', { detail: 'add-slot-modal' }));
            @endif

            const msg = sessionStorage.getItem('toastMessage');
            if (msg) {
                setTimeout(() => { window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'success', message: msg }})); }, 100);
                sessionStorage.removeItem('toastMessage');
            }

            window.addEventListener('undo-action', (e) => {
                const slotId = e.detail;
                if (window.deleteTimers && window.deleteTimers[slotId]) {
                    clearTimeout(window.deleteTimers[slotId]);
                    delete window.deleteTimers[slotId];
                    window.dispatchEvent(new CustomEvent('slot-restored', { detail: slotId }));
                    window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'success', message: 'Đã hoàn tác xóa slot thành công.' }}));
                }
            });
        });

        document.addEventListener('alpine:init', () => {
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
                        console.error('Error:', error);
                        window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'error', message: 'Lỗi kết nối máy chủ.' }}));
                    } finally {
                        this.isSubmitting = false;
                    }
                }
            }));

            Alpine.data('deleteSlotForm', () => ({
                confirmDelete() {
                    const slot = this.slotToDelete;
                    if (!slot) return;
                    
                    const slotId = slot.id;
                    this.$dispatch('close');
                    this.$dispatch('slot-deleted', slotId);
                    
                    this.$dispatch('notify', { 
                        type: 'warning', 
                        message: 'Đã xóa slot phỏng vấn.',
                        undoable: true,
                        slotId: slotId 
                    });

                    window.deleteTimers = window.deleteTimers || {};
                    window.deleteTimers[slotId] = setTimeout(async () => {
                        try {
                            const response = await fetch(`/admin/interview_schedules/${slotId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Accept': 'application/json'
                                }
                            });
                            // If successful, the item is permanently deleted on the server
                            // We don't need to do anything since it's already hidden
                        } catch (error) {
                            console.error('Delete error', error);
                            window.dispatchEvent(new CustomEvent('slot-restored', { detail: slotId }));
                            window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'error', message: 'Lỗi máy chủ: Không thể xóa slot.' }}));
                        }
                        delete window.deleteTimers[slotId];
                    }, 5000);
                }
            }));
        });
    </script>
</x-admin-layout>
