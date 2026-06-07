<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Tổng Quan
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <a href="#" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">Ủng Hộ</a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-bold">Chiến dịch Gây quỹ</span>
    </x-slot>

    <div class="space-y-6" x-data="{ campaignToClose: null }">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex flex-col">
                <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Quản Lý Chiến Dịch</h2>
                <p class="text-sm font-medium text-slate-500 mt-1">Quản lý và theo dõi các đợt gây quỹ hỗ trợ động vật</p>
            </div>
            
            <div class="flex items-center gap-3">
                <button type="button" onclick="exportExcel()" class="flex items-center justify-center gap-2 h-10 px-4 bg-white border border-slate-200 rounded-xl font-bold text-sm text-slate-700 shadow-sm hover:bg-slate-50 transition-all shrink-0">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path></svg>
                    Xuất Excel
                </button>
                <script>
                    function exportExcel() {
                        const form = document.getElementById('filter-form');
                        const formData = form ? new FormData(form) : new FormData();
                        formData.append('export', 'excel');
                        const params = new URLSearchParams(formData);
                        window.location.href = window.location.pathname + '?' + params.toString();
                    }
                </script>
                
                <a href="{{ route('admin.donation_campaigns.create') }}" class="flex items-center justify-center gap-2 h-10 px-5 bg-teal-600 text-white rounded-xl font-bold text-sm shadow-sm hover:bg-teal-700 transition-all shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    Tạo Chiến Dịch
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 text-emerald-700 px-4 py-3 rounded-xl border border-emerald-100 flex items-center gap-3 shadow-sm">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <p class="text-sm font-bold">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Metrics Cards Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
            
            <x-admin.kpi-card 
                title="Tổng Chiến Dịch" 
                value="{{ number_format($totalCampaigns) }}" 
                percent="12.5" 
            />

            <x-admin.kpi-card 
                title="Tổng Mục Tiêu" 
                value="{{ number_format($totalTarget, 0, ',', '.') }}đ" 
                percent="-4.2" 
            />

            <x-admin.kpi-card 
                title="Đã Gây Quỹ" 
                value="{{ number_format($totalRaised, 0, ',', '.') }}đ" 
                percent="{{ $totalTarget > 0 ? round(($totalRaised / $totalTarget) * 100, 2) : 100 }}" 
                footerText="so với mục tiêu"
            />

            <x-admin.kpi-card 
                title="Nhà Hảo Tâm" 
                value="{{ number_format($totalDonors) }}" 
                percent="-2.1" 
            />

            <x-admin.kpi-card 
                title="Đã Kết Thúc" 
                value="{{ number_format($finishedCampaigns) }}" 
                percent="5.3" 
            />

        </div>

        <!-- Filter & Table Card (Pets Style) -->
        <div class="bg-white border border-slate-200 rounded-xl shadow flex flex-col mb-10 w-full">
            
            <!-- Filters Section -->
            <div class="p-6 pb-4 border-b border-slate-100">
                <form id="filter-form" method="GET" action="{{ route('admin.donation_campaigns.index') }}" class="flex flex-wrap items-end gap-4">
                    <!-- Search Input -->
                    <div class="w-full sm:w-[260px] shrink-0">
                        <div class="relative w-full">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm chiến dịch, mô tả..." class="w-full h-11 pl-4 pr-10 bg-white border border-slate-200 rounded-xl text-sm font-medium focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-900 placeholder-slate-400 transition-all shadow-sm">
                            <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdowns -->
                    <div class="flex flex-wrap sm:flex-nowrap items-end gap-3 flex-1">
                        <!-- Dropdown Trạng thái -->
                        <div class="flex flex-col gap-1.5 flex-1 relative" x-data="{ 
                            open: false, 
                            value: '{{ request('status', '') }}', 
                            options: {'': 'Tất cả trạng thái', 'active': 'Đang hoạt động', 'closed': 'Đã kết thúc'} 
                        }">
                            <label class="text-xs font-bold text-slate-700">Trạng thái</label>
                            <input type="hidden" name="status" x-model="value" id="status-filter-input">
                            <button type="button" @click="open = !open" @click.away="open = false" class="w-full h-11 px-3.5 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 focus:outline-none focus:border-teal-500 shadow-sm flex items-center justify-between transition-colors hover:bg-slate-50">
                                <span class="truncate" x-text="options[value]"></span>
                                <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute left-0 top-[60px] w-full min-w-[180px] max-h-60 overflow-y-auto custom-scrollbar bg-white rounded-xl shadow-lg border border-slate-100 py-1.5 z-50">
                                <template x-for="(text, val) in options" :key="val">
                                    <button type="button" @click="value = val; open = false; setTimeout(() => { document.getElementById('filter-form').dispatchEvent(new Event('submit', { bubbles: true, cancelable: true })); }, 50);" class="w-full text-left px-4 py-2 text-sm transition-colors flex items-center justify-between" :class="{'bg-teal-50 text-teal-600 font-bold': value === val, 'text-slate-600 hover:bg-slate-50 hover:text-slate-900': value !== val}">
                                        <span x-text="text"></span>
                                        <svg x-show="value === val" class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                    </button>
                                </template>
                            </div>
                        </div>

                        <!-- Date Filter (Flatpickr) -->
                        <div class="flex flex-col gap-1.5 flex-[1.5]">
                            <label class="text-xs font-bold text-slate-700">Thời gian</label>
                            <div class="relative">
                                <input type="text" name="date_range" id="campaign_date_range" value="{{ request('date_range') }}" placeholder="Thời gian (Từ - Đến)" class="w-full h-11 px-3.5 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 focus:outline-none focus:border-teal-500 shadow-sm pr-10" x-init="
                                    flatpickr($el, {
                                        mode: 'range',
                                        dateFormat: 'd/m/Y',
                                        onChange: function(selectedDates) {
                                            if (selectedDates.length === 2 || selectedDates.length === 0) {
                                                document.getElementById('filter-form').dispatchEvent(new Event('submit', { bubbles: true, cancelable: true }));
                                            }
                                        }
                                    });
                                ">
                                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Filter Actions -->
                        <div class="flex items-center gap-2 shrink-0">
                            <a href="{{ route('admin.donation_campaigns.index') }}" class="flex items-center justify-center h-11 px-4 bg-white border border-slate-200 rounded-xl text-slate-500 font-bold text-sm shadow-sm hover:bg-slate-50 transition-all" title="Đặt lại">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                Làm mới
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Table Container (Pets Style) -->
            <div id="campaigns-table-container" class="relative min-h-[400px]">
                <!-- Loading Overlay -->
                <div id="table-loading-overlay" class="absolute inset-0 bg-white/50 backdrop-blur-[1px] z-10 hidden flex items-center justify-center">
                    <div class="w-8 h-8 border-4 border-teal-500 border-t-transparent rounded-full animate-spin"></div>
                </div>

                <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full text-left border-collapse min-w-[1000px] whitespace-nowrap">
                    <thead>
                        <tr class="bg-teal-50">
                            <th class="py-3 px-4 w-12 text-center rounded-l-xl">
                                <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-teal-600 focus:ring-teal-600 bg-white shadow-sm cursor-pointer">
                            </th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800">Chiến Dịch</th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800">Thú Cưng</th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800">Mục Tiêu</th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800">Đã Gây Quỹ</th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800 w-32">Tiến Độ</th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800">Kỳ Hạn</th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800 text-center">Trạng Thái</th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800 text-center rounded-r-xl">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($campaigns as $campaign)
                            @php
                                $percent = 0;
                                if($campaign->So_tien_muc_tieu > 0) {
                                    $percent = ($campaign->So_tien_hien_tai / $campaign->So_tien_muc_tieu) * 100;
                                    $percent = min(100, $percent);
                                } elseif($campaign->So_tien_hien_tai > 0) {
                                    $percent = 100;
                                }
                                
                                $isExpired = $campaign->Ngay_ket_thuc && \Carbon\Carbon::parse($campaign->Ngay_ket_thuc)->isPast();
                                $isActive = $campaign->Trang_thai === 'active' && !$isExpired;
                                $isFinished = $campaign->Trang_thai === 'closed' || $isExpired;
                                $isCompleted = $campaign->So_tien_muc_tieu > 0 && $percent >= 100;
                            @endphp
                            <tr class="hover:bg-slate-50 transition-colors border-b border-slate-100 {{ $isFinished ? 'opacity-70' : '' }}">
                                <td class="py-3 px-4 text-center">
                                    <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-teal-600 focus:ring-teal-600 bg-white shadow-sm cursor-pointer">
                                </td>
                                
                                <!-- Cột Chiến dịch -->
                                <td class="py-3 px-4 max-w-xs">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-lg overflow-hidden shrink-0 bg-slate-100 border border-slate-200 relative">
                                            @if($campaign->Anh_dai_dien)
                                                <img src="{{ $campaign->Anh_dai_dien }}" alt="Cover" class="w-full h-full object-cover">
                                            @else
                                                <svg class="w-5 h-5 text-slate-300 absolute inset-0 m-auto" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>
                                            @endif
                                            @if($isActive && $percent > 0 && $percent < 100 && rand(0,1))
                                                <span class="absolute top-0 left-0 bg-emerald-500 text-white text-[7px] font-bold px-1 py-0.5 rounded-br">Nổi bật</span>
                                            @endif
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-bold text-slate-800 line-clamp-1 truncate block w-40" title="{{ $campaign->Tieu_de }}">{{ $campaign->Tieu_de }}</span>
                                            <span class="text-[11px] text-slate-500 line-clamp-1 truncate block w-40 mt-0.5">{{ $campaign->Mo_ta ?: 'Chưa có mô tả...' }}</span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Cột Thú cưng -->
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 shrink-0 border border-slate-200">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a3 3 0 00-2.98 2.684 5.002 5.002 0 00-3.328 3.965C3.308 8.825 3 9.381 3 10c0 1.105.895 2 2 2h10c1.105 0 2-.895 2-2 0-.619-.308-1.175-.692-1.351a5.002 5.002 0 00-3.328-3.965A3 3 0 0010 2zM6 13a1 1 0 00-1 1v1a1 1 0 102 0v-1a1 1 0 00-1-1zm8 0a1 1 0 00-1 1v1a1 1 0 102 0v-1a1 1 0 00-1-1z"></path></svg>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-bold text-slate-800 text-[12px]">-</span>
                                            <span class="text-[10px] text-slate-500">Nhiều thú cưng</span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Cột Mục tiêu -->
                                <td class="py-3 px-4 font-bold text-slate-700">
                                    {{ $campaign->So_tien_muc_tieu ? number_format($campaign->So_tien_muc_tieu, 0, ',', '.') . 'đ' : 'Không giới hạn' }}
                                </td>

                                <!-- Cột Đã gây quỹ -->
                                <td class="py-3 px-4">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-800">{{ number_format($campaign->So_tien_hien_tai, 0, ',', '.') }}đ</span>
                                        @if($campaign->So_tien_muc_tieu > 0)
                                            <span class="text-[11px] font-bold text-emerald-600 mt-0.5">{{ round($percent, 1) }}%</span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Cột Tiến độ -->
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-2">
                                        <div class="h-1.5 w-full bg-slate-200 rounded-full overflow-hidden flex-1">
                                            <div class="h-full {{ $percent >= 100 ? 'bg-emerald-500' : 'bg-teal-500' }} rounded-full" style="width: {{ $percent }}%"></div>
                                        </div>
                                        <span class="text-xs text-slate-500 font-bold w-8 text-right">{{ round($percent, 1) }}%</span>
                                    </div>
                                </td>

                                <!-- Cột Kỳ hạn -->
                                <td class="py-3 px-4">
                                    <div class="flex flex-col text-[12px]">
                                        <span class="text-slate-700">{{ \Carbon\Carbon::parse($campaign->Ngay_bat_dau)->format('d/m/Y') }}</span>
                                        @if($campaign->Ngay_ket_thuc)
                                            <span class="text-slate-400">Đến {{ \Carbon\Carbon::parse($campaign->Ngay_ket_thuc)->format('d/m/Y') }}</span>
                                            @if(!$isExpired)
                                                <span class="text-[10px] font-bold text-orange-500 mt-0.5">Còn {{ round(abs(\Carbon\Carbon::now()->startOfDay()->floatDiffInDays(\Carbon\Carbon::parse($campaign->Ngay_ket_thuc)->startOfDay()))) }} ngày</span>
                                            @else
                                                <span class="text-[10px] font-bold text-red-500 mt-0.5">Đã hết hạn</span>
                                            @endif
                                        @else
                                            <span class="text-slate-400 italic text-[11px] mt-0.5">Vô thời hạn</span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Cột Trạng thái -->
                                <td class="py-3 px-4 text-center">
                                    @if($isFinished)
                                        <span class="inline-flex items-center px-3 py-1 rounded-[10px] text-[11px] font-bold text-slate-700 bg-slate-100 border border-slate-200">
                                            Đã kết thúc
                                        </span>
                                    @elseif($isCompleted)
                                        <span class="inline-flex items-center px-3 py-1 rounded-[10px] text-[11px] font-bold text-blue-700 bg-blue-50 border border-blue-200">
                                            Hoàn thành
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-[10px] text-[11px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200">
                                            Hoạt động
                                        </span>
                                    @endif
                                </td>

                                <!-- Cột Thao tác -->
                                <td class="py-3 px-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.donation_campaigns.edit', $campaign->Ma_chien_dich) }}" class="flex items-center justify-center w-8 h-8 rounded border border-slate-200 text-orange-500 hover:bg-orange-50 transition-colors shadow-sm" title="Chỉnh sửa">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>

                                        @if($isActive)
                                        <button @click="campaignToClose = '{{ $campaign->Ma_chien_dich }}'; $dispatch('open-modal', 'close-campaign-modal')" class="flex items-center justify-center w-8 h-8 rounded border border-slate-200 text-red-500 hover:bg-red-50 transition-colors shadow-sm" title="Đóng chiến dịch">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="py-12 text-center">
                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3 border border-slate-100">
                                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <p class="text-sm font-bold text-slate-600">Chưa có chiến dịch nào</p>
                                    <p class="text-xs text-slate-400 mt-1 font-medium">Hãy tạo chiến dịch mới để bắt đầu gây quỹ.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Bar -->
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $campaigns->links('admin.pagination.custom') }}
            </div>
            </div>

        <!-- Close Campaign Modal -->
        <x-modal name="close-campaign-modal" focusable maxWidth="sm">
            <form method="POST" :action="`/admin/donation_campaigns/${campaignToClose}/close`" class="p-6 text-center">
                @csrf
                @method('PUT')
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                    <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h2 class="text-xl font-bold text-slate-800 tracking-tight mb-2">Đóng Chiến dịch?</h2>
                <p class="text-sm font-medium text-slate-500 mb-6">Chiến dịch này sẽ ngừng nhận quyên góp và chuyển sang trạng thái "Đã đóng".</p>
                <div class="flex justify-center gap-3">
                    <button type="button" x-on:click="$dispatch('close')" class="px-5 py-2.5 text-sm font-bold text-slate-600 bg-white border border-slate-200 hover:bg-slate-50 rounded-xl transition-all shadow-sm">Hủy</button>
                    <button type="submit" class="px-5 py-2.5 text-sm font-bold text-white bg-slate-700 hover:bg-slate-800 rounded-xl transition-all shadow-sm">Xác nhận Đóng</button>
                </div>
            </form>
        </x-modal>
    </div>

    <!-- Init AJAX Table Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof initAjaxTable === 'function') {
                initAjaxTable('campaigns-table-container', 'filter-form');
            }
        });
    </script>
</x-admin-layout>
