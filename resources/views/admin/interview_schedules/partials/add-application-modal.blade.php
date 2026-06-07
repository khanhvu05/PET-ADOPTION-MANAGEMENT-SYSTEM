<x-modal name="add-application-modal" focusable maxWidth="md">
    <form @submit.prevent="submitAddApplication" class="p-6" x-data="addApplicationForm()">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center text-teal-700 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            </div>
            <div>
                <h2 class="text-lg font-bold text-slate-800">Thêm hồ sơ / Đổi lịch</h2>
                <p class="text-xs text-slate-500">Chọn hồ sơ và chọn lịch phỏng vấn</p>
            </div>
        </div>

        <!-- Lưu slot ID mặc định truyền vào từ nút bấm -->
        <input type="hidden" id="modal-slot-id" x-model="defaultSlotId">

        <div class="space-y-4">
            <!-- 1. Chọn hồ sơ (Searchable with TomSelect) -->
            <div wire:ignore>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Chọn hồ sơ</label>
                <select id="application-select" x-ref="appSelect" x-model="applicationId" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm transition-colors focus:border-teal-500 focus:ring-teal-500" placeholder="-- Gõ tên hoặc SĐT để tìm --">
                    <option value="">-- Chọn hồ sơ ứng viên --</option>
                    @foreach($pendingApplications as $app)
                        <option value="{{ $app->Ma_don }}">
                            {{ $app->Ho_ten }} - {{ $app->So_dien_thoai }} (Thú cưng: {{ $app->thuCung->Ten_thu_cung ?? 'Không rõ' }})
                        </option>
                    @endforeach
                </select>
                <template x-if="errors.applicationId">
                    <p class="text-xs text-red-500 mt-1.5 font-medium" x-text="errors.applicationId"></p>
                </template>
            </div>

            <!-- 2. Chọn Ngày -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Ngày phỏng vấn</label>
                <select x-model="selectedDate" @change="updateSlotsForDate()" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm transition-colors focus:border-teal-500 focus:ring-teal-500">
                    <option value="">-- Chọn ngày --</option>
                    <template x-for="date in availableDates" :key="date">
                        <option :value="date" x-text="formatDate(date)"></option>
                    </template>
                </select>
                <template x-if="errors.selectedDate">
                    <p class="text-xs text-red-500 mt-1.5 font-medium" x-text="errors.selectedDate"></p>
                </template>
            </div>

            <!-- 3. Chọn Ca (Slots) -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Ca phỏng vấn</label>
                <select x-model="slotId" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm transition-colors focus:border-teal-500 focus:ring-teal-500" :disabled="!selectedDate || availableSlots.length === 0">
                    <option value="">-- Chọn ca phỏng vấn --</option>
                    <template x-for="slot in availableSlots" :key="slot.Ma_slot">
                        <option :value="slot.Ma_slot" x-text="formatTime(slot.Gio_bat_dau) + ' - ' + formatTime(slot.Gio_ket_thuc)"></option>
                    </template>
                </select>
                <template x-if="errors.slotId">
                    <p class="text-xs text-red-500 mt-1.5 font-medium" x-text="errors.slotId"></p>
                </template>
                <template x-if="selectedDate && availableSlots.length === 0">
                    <p class="text-xs text-orange-500 mt-1.5 font-medium">Không có ca phỏng vấn nào trong ngày này.</p>
                </template>
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-3">
            <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2.5 text-sm font-semibold rounded-xl transition-colors bg-slate-100 text-slate-600 hover:bg-slate-200">
                Hủy
            </button>
            <button type="submit" class="px-4 py-2.5 text-sm font-semibold rounded-xl transition-colors shadow-sm flex items-center gap-2 bg-teal-600 text-white hover:bg-teal-700" :disabled="isSubmitting || !applicationId || !slotId">
                <span x-text="isSubmitting ? 'Đang thêm...' : 'Xác nhận'"></span>
            </button>
        </div>
    </form>
</x-modal>

<!-- Dữ liệu slots từ Controller -->
<script>
    window.allUpcomingSlots = @json($allUpcomingSlots ?? []);
</script>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('addApplicationForm', () => ({
        defaultSlotId: '',
        applicationId: '',
        slotId: '',
        selectedDate: '',
        
        allSlots: window.allUpcomingSlots || [],
        availableDates: [],
        availableSlots: [],
        
        errors: {},
        isSubmitting: false,
        tomSelectInstance: null,

        init() {
            // Helper function to get local YYYY-MM-DD from UTC date string
            this.getLocalYMD = (dateString) => {
                const d = new Date(dateString);
                const year = d.getFullYear();
                const month = String(d.getMonth() + 1).padStart(2, '0');
                const day = String(d.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            };

            // Extract unique dates from all slots
            const dates = new Set(this.allSlots.map(s => this.getLocalYMD(s.Ngay)));
            this.availableDates = Array.from(dates).sort();

            window.addEventListener('open-modal', (event) => {
                if (event.detail === 'add-application-modal') {
                    this.errors = {};
                    this.applicationId = '';
                    
                    // Lấy slotId truyền vào
                    this.defaultSlotId = document.getElementById('modal-slot-id').value;
                    
                    // Tìm slot này trong allSlots
                    const currentSlot = this.allSlots.find(s => s.Ma_slot == this.defaultSlotId);
                    if (currentSlot) {
                        this.selectedDate = this.getLocalYMD(currentSlot.Ngay);
                        this.updateSlotsForDate();
                        this.slotId = this.defaultSlotId;
                    } else {
                        this.selectedDate = '';
                        this.slotId = '';
                        this.updateSlotsForDate();
                    }

                    // Khởi tạo TomSelect nếu chưa có
                    this.$nextTick(() => {
                        if (!this.tomSelectInstance && this.$refs.appSelect) {
                            this.tomSelectInstance = new TomSelect(this.$refs.appSelect, {
                                create: false,
                                sortField: {
                                    field: "text",
                                    direction: "asc"
                                },
                                placeholder: '-- Gõ tên hoặc SĐT để tìm --'
                            });
                        } else if (this.tomSelectInstance) {
                            this.tomSelectInstance.clear();
                        }
                    });
                }
            });
        },

        updateSlotsForDate() {
            if (!this.selectedDate) {
                this.availableSlots = [];
                this.slotId = '';
                return;
            }
            this.availableSlots = this.allSlots.filter(s => this.getLocalYMD(s.Ngay) === this.selectedDate);
            // Nếu slotId đang chọn không nằm trong ngày mới, thì reset
            if (!this.availableSlots.some(s => s.Ma_slot == this.slotId)) {
                this.slotId = '';
            }
        },

        formatDate(dateStr) {
            if (!dateStr) return '';
            const [y, m, d] = dateStr.split('-');
            return `${d}/${m}/${y}`;
        },

        formatTime(timeStr) {
            if (!timeStr) return '';
            return timeStr.substring(0, 5); // '09:00:00' -> '09:00'
        },

        async submitAddApplication() {
            this.errors = {};
            if (!this.applicationId) this.errors.applicationId = 'Vui lòng chọn hồ sơ.';
            if (!this.selectedDate) this.errors.selectedDate = 'Vui lòng chọn ngày phỏng vấn.';
            if (!this.slotId) this.errors.slotId = 'Vui lòng chọn ca phỏng vấn.';
            
            if (Object.keys(this.errors).length > 0) return;

            this.isSubmitting = true;

            try {
                // Đưa hồ sơ vào slotId MỚI (slotId đang được chọn ở form)
                const response = await fetch(`/quan-tri/lich-phong-van/${this.slotId}/add-application`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ application_id: this.applicationId })
                });

                const data = await response.json();

                if (response.ok) {
                    sessionStorage.setItem('toastMessage', data.message);
                    window.location.reload();
                } else {
                    window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'error', message: data.message || 'Có lỗi xảy ra.' }}));
                }
            } catch (error) {
                window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'error', message: 'Lỗi kết nối máy chủ.' }}));
            } finally {
                this.isSubmitting = false;
            }
        }
    }));
});
</script>
