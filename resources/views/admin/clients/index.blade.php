<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-sidebar-blue transition-colors flex items-center gap-1.5 text-slate-500">
            <i data-lucide="home" class="w-4 h-4"></i>
            Quản Lý
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-bold">Khách Hàng</span>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Header & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 mb-1">Quản Lý Khách Hàng</h2>
                <p class="text-sm text-slate-500">Danh sách người dùng đăng ký nhận nuôi và quyên góp.</p>
            </div>
            <div class="flex items-center gap-3">
                {{-- 
                @can('clients.export')
                <a href="{{ route('admin.clients.export', request()->all()) }}" class="bg-white border border-slate-200 text-slate-700 px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-slate-50 hover:shadow-md transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Xuất Excel
                </a>
                @endcan
                --}}
            </div>
        </div>

        <!-- Metrics Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
            <x-admin.kpi-card title="Tổng Khách Hàng" value="{{ $totalClients }}" percent="0" />
            <x-admin.kpi-card title="Đang hoạt động" value="{{ $activeClients }}" percent="0" />
            <x-admin.kpi-card title="Bị khóa" value="{{ $lockedClients }}" percent="0" />
        </div>

        <!-- Filter & Table Card -->
        <div class="bg-white border border-slate-200 rounded-xl shadow flex flex-col mb-10 w-full overflow-hidden">
            
            <form id="filter-form" method="GET" action="{{ route('admin.clients.index') }}" class="p-6 pb-4 border-b border-slate-100">
                <div class="flex flex-wrap gap-4 items-end">
                    <div class="w-72">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm tên, email, SĐT..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 transition-colors shadow-sm">
                        </div>
                    </div>

                    <div class="w-40 relative" x-data="{ open: false, value: '{{ request('status', 'all') }}', options: {'all': 'Tất cả', 'hoat_dong': 'Hoạt động', 'bi_khoa': 'Bị khóa'} }">
                        <label class="block text-[11px] font-bold text-slate-500 mb-1.5 ml-1">Trạng thái</label>
                        <input type="hidden" name="status" x-model="value" id="status-filter-input">
                        <button type="button" @click="open = !open" @click.away="open = false" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm shadow-sm text-slate-700 flex items-center justify-between">
                            <span x-text="options[value]"></span>
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" class="absolute left-0 top-full mt-2 w-full bg-white rounded-xl shadow-lg border border-slate-100 py-1.5 z-50 overflow-hidden">
                            <template x-for="(text, val) in options" :key="val">
                                <button type="button" @click="value = val; open = false; setTimeout(() => { document.getElementById('status-filter-input').dispatchEvent(new Event('change', { bubbles: true })); }, 50);" class="w-full text-left px-4 py-2.5 text-sm" :class="{'bg-teal-50/50 text-teal-700 font-semibold': value === val, 'text-slate-600': value !== val}">
                                    <span x-text="text"></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 ml-auto">
                        <button type="submit" class="px-5 py-2.5 bg-teal-600 text-white rounded-xl text-sm font-semibold hover:bg-teal-700 transition-all shadow-sm">Lọc</button>
                        <a href="{{ route('admin.clients.index') }}" class="px-5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-100 transition-all flex items-center gap-2">Làm mới</a>
                    </div>
                </div>
            </form>

            <div id="clients-table-container" class="relative">
                <div class="overflow-x-auto min-h-[280px] pb-4">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-[#f8fafc]">
                                <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Khách Hàng</th>
                                <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Liên Hệ</th>
                                <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Ngày Đăng Ký</th>
                                <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Trạng Thái</th>
                                <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100 text-center">Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @foreach($clients as $client)
                            <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-slate-200 shrink-0 overflow-hidden">
                                            <img src="{{ $client->Anh_dai_dien ?? 'https://ui-avatars.com/api/?name='.urlencode($client->Ho_ten) }}" alt="Avatar" class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-slate-900">{{ $client->Ho_ten }}</span>
                                            <span class="text-xs text-slate-500 mt-0.5">{{ $client->Email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-slate-600">{{ $client->So_dien_thoai ?? '---' }}</td>
                                <td class="py-4 px-6 text-slate-600">{{ $client->Ngay_tao ? $client->Ngay_tao->format('d/m/Y H:i') : '---' }}</td>
                                <td class="py-4 px-6">
                                    @if($client->Trang_thai === 'hoat_dong')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">Hoạt động</span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200">Bị khóa</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 relative" x-data="{ open: false, dropUp: false }">
                                    <div class="flex items-center justify-center">
                                        @can('clients.toggle_status')
                                        <form method="POST" action="{{ route('admin.clients.toggle_status', $client->Ma_nguoi_dung) }}" onsubmit="confirmToggleStatus(event, this, '{{ $client->Trang_thai === 'hoat_dong' ? 'khóa' : 'mở khóa' }}')" class="block">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="px-3 py-1.5 rounded text-xs font-semibold {{ $client->Trang_thai === 'hoat_dong' ? 'bg-amber-100 text-amber-700 hover:bg-amber-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }} transition-colors">
                                                {{ $client->Trang_thai === 'hoat_dong' ? 'Khóa TK' : 'Mở khóa' }}
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-5 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-slate-500">
                        Hiển thị {{ $clients->firstItem() ?? 0 }} đến {{ $clients->lastItem() ?? 0 }} của {{ $clients->total() }} kết quả
                    </div>
                    <div>
                        {{ $clients->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmToggleStatus(event, form, actionName) {
            event.preventDefault();
            let isLock = actionName === 'khóa';
            
            let customConfig = {...window.swalConfig};
            if(isLock) {
                customConfig.customClass = { ...window.swalConfig.customClass, confirmButton: 'bg-amber-500 hover:bg-amber-600 text-white font-semibold rounded-[10px] px-6 py-2.5 transition-colors shadow-sm' };
            } else {
                customConfig.customClass = { ...window.swalConfig.customClass, confirmButton: 'bg-green-600 hover:bg-green-700 text-white font-semibold rounded-[10px] px-6 py-2.5 transition-colors shadow-sm' };
            }

            Swal.fire({
                ...customConfig,
                title: (isLock ? 'Khóa' : 'Mở khóa') + ' tài khoản?',
                text: `Bạn có chắc chắn muốn ${actionName} tài khoản này?`,
                icon: isLock ? 'warning' : 'question',
                showCancelButton: true,
                confirmButtonText: 'Có, ' + actionName,
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
    @endpush
</x-admin-layout>
