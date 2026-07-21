<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('admin.staff.index') }}" class="hover:text-sidebar-blue transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Quay lại
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-bold">Chi tiết Nhân Viên</span>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 mb-1">Hồ sơ Nhân Viên</h2>
                <p class="text-sm text-slate-500">Xem thông tin chi tiết và quyền hạn thực tế của nhân viên.</p>
            </div>
            <div class="flex items-center gap-3">
                @can('staff.edit')
                <a href="{{ route('admin.staff.edit', $staff->Ma_nguoi_dung) }}" class="bg-teal-600 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-teal-700 hover:shadow-md transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    Chỉnh sửa & Phân quyền
                </a>
                @endcan
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl shadow overflow-hidden">
            <div class="p-6 md:p-8 border-b border-slate-100 flex flex-col md:flex-row gap-6 items-center md:items-start text-center md:text-left">
                <div class="w-24 h-24 rounded-full bg-slate-200 shrink-0 overflow-hidden shadow-sm">
                    <img src="{{ $staff->Anh_dai_dien ?? 'https://ui-avatars.com/api/?name='.urlencode($staff->Ho_ten).'&size=256' }}" alt="Avatar" class="w-full h-full object-cover">
                </div>
                <div class="flex-1 space-y-2">
                    <div class="flex flex-col md:flex-row md:items-center gap-3">
                        <h3 class="text-2xl font-bold text-slate-900">{{ $staff->Ho_ten }}</h3>
                        <div class="flex gap-2 justify-center md:justify-start">
                            @if($staff->Trang_thai === 'hoat_dong')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">Hoạt động</span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200">Bị khóa</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap items-center gap-4 text-sm text-slate-600 justify-center md:justify-start">
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            {{ $staff->Email }}
                        </div>
                        @if($staff->So_dien_thoai)
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            {{ $staff->So_dien_thoai }}
                        </div>
                        @endif
                    </div>
                    
                    <div class="pt-3">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Vai trò hiện tại</p>
                        <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                            @foreach($staff->roles as $role)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold 
                                    {{ $role->name === 'admin' ? 'bg-red-50 text-red-700 border border-red-200' : 'bg-blue-50 text-blue-700 border border-blue-200' }}">
                                    {{ ucfirst($role->name) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-8 bg-slate-50">
                <div class="flex items-center justify-between mb-6">
                    <h4 class="text-lg font-bold text-slate-900">Quyền Hạn Thực Tế</h4>
                    @if($staff->hasRole('admin'))
                        <span class="text-xs font-semibold px-2 py-1 bg-red-100 text-red-700 rounded border border-red-200">Admin Bypass (Toàn quyền)</span>
                    @endif
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($allPermissions as $module => $modulePermissions)
                    <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-sm">
                        <h5 class="font-bold text-slate-800 mb-3 capitalize border-b border-slate-100 pb-2">
                            {{ config("permissions.modules.$module", ucfirst($module)) }}
                        </h5>
                        <ul class="space-y-2.5">
                            @foreach($modulePermissions as $permission)
                                @php
                                    // If they are admin, they effectively have everything via Gate. 
                                    // Here we show what they technically hold in DB/Cache, or we can just show everything checked if admin.
                                    $hasPerm = $staff->hasRole('admin') || in_array($permission->name, $effectivePermissions);
                                @endphp
                                <li class="flex items-center gap-2.5 text-sm {{ $hasPerm ? 'text-teal-700 font-medium' : 'text-slate-400' }}">
                                    @if($hasPerm)
                                        <svg class="w-4 h-4 shrink-0 text-teal-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    @else
                                        <svg class="w-4 h-4 shrink-0 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"></path></svg>
                                    @endif
                                    @php $action = str_replace($module.'.', '', $permission->name); @endphp
                                    {{ config("permissions.actions.$action", ucfirst(str_replace('_', ' ', $action))) }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
