<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Quản Lý
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-bold">Quyên Góp</span>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Header & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 mb-1">Quản Lý Quyên Góp</h2>
                <p class="text-sm text-slate-500">Theo dõi và quản lý các khoản quyên góp ủng hộ cho thú cưng.</p>
            </div>
                @can('donations.export')
                <button type="button" onclick="exportExcel()" class="bg-white border border-slate-200 text-slate-700 px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-slate-50 hover:shadow-md transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path></svg>
                    Xuất Excel
                </button>
                @endcan
                <script>
                    function exportExcel() {
                        const form = document.getElementById('filter-form');
                        const formData = new FormData(form);
                        formData.append('export', 'excel');
                        const params = new URLSearchParams(formData);
                        window.location.href = window.location.pathname + '?' + params.toString();
                    }
                </script>
            </div>
        </div>

        <!-- Metrics Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
            
            <!-- Card 1: Tổng Quyên Góp -->
            <x-admin.kpi-card 
                title="Tổng Quyên Góp" 
                value="{{ $stats['total_amount']['value'] }}" 
                percent="{{ $stats['total_amount']['percent'] }}" 
            />

            <!-- Card 2: Số Giao Dịch -->
            <x-admin.kpi-card 
                title="Số Giao Dịch" 
                value="{{ $stats['total_tx']['value'] }}" 
                percent="{{ $stats['total_tx']['percent'] }}" 
            />

            <!-- Card 3: Đã Xác Nhận -->
            <x-admin.kpi-card 
                title="Thành Công" 
                value="{{ $stats['success']['value'] }}" 
                percent="{{ $stats['success']['percent'] }}" 
            />

            <!-- Card 4: Chờ Xác Nhận -->
            <x-admin.kpi-card 
                title="Chờ Xác Nhận" 
                value="{{ $stats['pending']['value'] }}" 
                percent="{{ $stats['pending']['percent'] }}" 
            />

            <!-- Card 5: Hoàn/Đã Hủy -->
            <x-admin.kpi-card 
                title="Hoàn/Đã Hủy" 
                value="{{ $stats['failed']['value'] }}" 
                percent="{{ $stats['failed']['percent'] }}" 
            />

        </div>

        <!-- Filter & Table Card -->
        <div class="bg-white border border-slate-200 rounded-xl shadow flex flex-col mb-10 w-full overflow-hidden">
            
            <!-- Filters Section -->
            <form id="filter-form" x-data="{
                submit() {
                    // Xóa parameter 'export' nếu có trước khi submit để tránh lỗi luôn tải file
                    const url = new URL(window.location.href);
                    url.searchParams.delete('export');
                    this.$el.action = url.pathname;
                    this.$el.submit();
                }
            }" action="{{ route('admin.donations.index') }}" method="GET" class="p-6 pb-4 border-b border-slate-100">
                <div class="flex flex-wrap gap-4 items-end">
                    <!-- Search -->
                    <div class="w-full sm:w-64">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input @input.debounce.500ms="submit()" type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm giao dịch, email..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-[#41859c] focus:ring-1 focus:ring-[#41859c] transition-colors shadow-sm">
                        </div>
                    </div>

                    <!-- Date Range Filter -->
                    <div class="w-full sm:w-64">
                        <div class="relative">
                            <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <input type="text" id="date_range" name="date_range" value="{{ request('date_range') }}" placeholder="Thời gian (Từ - Đến)" class="w-full pl-4 pr-10 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-[#41859c] focus:ring-1 focus:ring-[#41859c] transition-colors shadow-sm" x-init="
                                flatpickr($el, {
                                    mode: 'range',
                                    dateFormat: 'd/m/Y',
                                    onChange: function(selectedDates, dateStr, instance) {
                                        if (selectedDates.length === 2 || selectedDates.length === 0) {
                                            submit();
                                        }
                                    }
                                });
                            ">
                        </div>
                    </div>

                    <!-- Dropdowns -->
                    <div class="w-full sm:w-64 relative" x-data="{ 
                        open: false, 
                        value: '{{ request('method', 'all') }}', 
                        options: {'all': 'Tất cả phương thức', 'VNPAYQR': 'Quét mã QR (VNPAYQR)', 'VNBANK': 'Thẻ ATM / VNBANK', 'INTCARD': 'Thẻ Quốc Tế'} 
                    }">
                        <input type="hidden" name="method" x-model="value" id="method-filter-input">
                        <button type="button" @click="open = !open" @click.away="open = false" class="w-full h-[42px] px-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-700 focus:outline-none focus:border-[#41859c] focus:ring-1 focus:ring-[#41859c] shadow-sm flex items-center justify-between transition-colors hover:bg-slate-100">
                            <span class="truncate" x-text="options[value]"></span>
                            <svg class="w-4 h-4 ml-2 shrink-0 text-slate-400 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute left-0 top-full mt-2 w-max min-w-full max-h-60 overflow-y-auto custom-scrollbar bg-white rounded-xl shadow-lg border border-slate-100 py-1.5 z-50">
                            <template x-for="(text, val) in options" :key="val">
                                <button type="button" @click="value = val; open = false; setTimeout(() => { document.getElementById('method-filter-input').dispatchEvent(new Event('change', { bubbles: true })); submit(); }, 50);" class="w-full text-left px-4 py-2 text-sm transition-colors flex items-center justify-between gap-4" :class="{'bg-[#41859c]/10 text-[#41859c] font-semibold': value === val, 'text-slate-600 hover:bg-slate-50 hover:text-slate-900': value !== val}">
                                    <span class="whitespace-nowrap" x-text="text"></span>
                                    <svg x-show="value === val" class="w-4 h-4 text-[#41859c]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-3 ml-auto">

                        <a href="{{ route('admin.donations.index') }}" class="px-5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-100 hover:shadow-sm transition-all flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            Làm mới
                        </a>
                    </div>
                </div>
            </form>

            <div id="donation-table-container" class="relative">
                <!-- Loading Overlay -->
                <style>
                    @keyframes forceSpin { 100% { transform: rotate(360deg); } }
                </style>
                <div id="table-loading-overlay" class="absolute inset-0 z-50 flex items-center justify-center hidden rounded-b-xl" style="background-color: rgba(255,255,255,0.6); backdrop-filter: blur(2px);">
                    <svg class="h-8 w-8 text-[#41859c]" style="animation: forceSpin 1s linear infinite;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="bg-[#f8fafc]">
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Mã GD</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Người Ủng Hộ</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Số Tiền</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Phương Thức</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Mục Đích</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Thời Gian</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($donations as $donation)
                        <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <span class="font-medium text-slate-900">#{{ substr($donation->Ma_ung_ho, 0, 8) }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex flex-col">
                                    <span class="font-semibold text-slate-900">
                                        {{ $donation->An_danh ? 'Nhà hảo tâm ẩn danh' : ($donation->Ten_nguoi_ung_ho ?? ($donation->nguoiDung->Ho_ten ?? 'Chưa cập nhật')) }}
                                    </span>
                                    @if(!$donation->An_danh && isset($donation->nguoiDung->Email))
                                    <span class="text-xs text-slate-500 mt-0.5">{{ $donation->nguoiDung->Email }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 px-6 font-semibold text-slate-900">{{ number_format($donation->So_tien, 0, ',', '.') }}đ</td>
                            <td class="py-4 px-6 text-slate-600">{{ $donation->Ma_ngan_hang ?? 'Chưa rõ' }}</td>
                            <td class="py-4 px-6 text-slate-600">{{ $donation->Loi_nhan ?? 'Không có lời nhắn' }}</td>
                            <td class="py-4 px-6 text-slate-600">
                                <div class="flex flex-col">
                                    <span>{{ $donation->Ngay_tao->format('d/m/Y') }}</span>
                                    <span class="text-xs text-slate-400 mt-0.5">{{ $donation->Ngay_tao->format('H:i') }}</span>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-500">
                                Không tìm thấy dữ liệu quyên góp nào phù hợp.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $donations->links('admin.pagination.custom') }}
            </div>

            </div> <!-- End donation-table-container -->

        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if(typeof window.initAjaxTable === 'function') {
                window.initAjaxTable('donation-table-container', 'filter-form');
            }
        });
    </script>
    @endpush
</x-admin-layout>
