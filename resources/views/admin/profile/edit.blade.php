<x-admin-layout>
    <x-slot name="header">
        <a href="#" class="text-slate-500 hover:text-slate-700 transition-colors flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            Tài Khoản
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-900 font-bold">Hồ Sơ Cá Nhân</span>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 mb-1">Hồ Sơ Cá Nhân</h2>
            <p class="text-sm text-slate-500">Cập nhật thông tin tài khoản và đổi mật khẩu của bạn.</p>
        </div>

        @if(session('status') === 'profile-updated')
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span class="font-medium text-sm">Đã cập nhật thông tin tài khoản thành công.</span>
            </div>
        @endif

        @if(session('status') === 'password-updated')
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span class="font-medium text-sm">Đã đổi mật khẩu thành công.</span>
            </div>
        @endif

        <div class="bg-white border border-slate-200 rounded-xl shadow p-6 lg:p-8">
            <div class="max-w-2xl">
                @include('profile.partials.update-profile-information-form', [
                    'updateRoute' => route('admin.profile.update')
                ])
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl shadow p-6 lg:p-8">
            <div class="max-w-2xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>
</x-admin-layout>
