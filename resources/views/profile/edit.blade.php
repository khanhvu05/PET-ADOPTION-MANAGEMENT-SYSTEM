<x-admin-layout>
    <x-slot name="header">
        <!-- Breadcrumbs -->
        <span class="text-slate-500">Quản Lý</span>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-orange-brand">Hồ sơ cá nhân</span>
    </x-slot>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 max-w-7xl mx-auto py-8">
        <!-- Left Column (Sidebar) -->
        <div class="lg:col-span-4 lg:sticky lg:top-8 self-start space-y-6">
            <!-- Header -->
            <div>
                <span class="text-[11px] font-bold uppercase tracking-widest text-slate-400 block mb-2">[ THIẾT LẬP TÀI KHOẢN ]</span>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">
                    Hồ sơ cá nhân
                </h1>
                <p class="mt-3 text-sm text-slate-500 leading-relaxed">
                    Cập nhật thông tin tài khoản của bạn, thay đổi mật khẩu bảo mật và quản lý quyền hạn thành viên trong hệ thống PetAdoption.
                </p>
            </div>

            <!-- Custom Navigation -->
            <nav class="space-y-1 text-sm border-l-2 border-slate-100 pl-4 py-2 font-medium">
                <a href="#info" class="flex items-center py-2 text-slate-500 hover:text-orange-brand transition-colors">
                    <span class="text-slate-400 w-8 font-bold text-xs tracking-wider">[01]</span>
                    <span>Thông tin cá nhân</span>
                </a>
                <a href="#security" class="flex items-center py-2 text-slate-500 hover:text-orange-brand transition-colors">
                    <span class="text-slate-400 w-8 font-bold text-xs tracking-wider">[02]</span>
                    <span>Bảo mật mật khẩu</span>
                </a>
                <a href="#danger" class="flex items-center py-2 text-slate-500 hover:text-red-500 transition-colors">
                    <span class="text-slate-400 w-8 font-bold text-xs tracking-wider">[03]</span>
                    <span>Khu vực rủi ro</span>
                </a>
                @if ($user->isAdmin())
                    <a href="#roles" class="flex items-center py-2 text-slate-500 hover:text-orange-brand transition-colors border-t border-slate-100 mt-2 pt-2">
                        <span class="text-slate-400 w-8 font-bold text-xs tracking-wider text-orange-brand">[04]</span>
                        <span class="font-bold text-orange-brand">Quản lý vai trò (Admin)</span>
                    </a>
                @endif
            </nav>
        </div>

        <!-- Right Column (Cards) -->
        <div class="lg:col-span-8 space-y-6">
            <!-- Section 01: Profile Info -->
            <div id="info" class="scroll-mt-24 p-6 sm:p-8 bg-white border border-slate-200 rounded-xl shadow-sm">
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Section 02: Update Password -->
            <div id="security" class="scroll-mt-24 p-6 sm:p-8 bg-white border border-slate-200 rounded-xl shadow-sm">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Section 03: Delete User Account -->
            <div id="danger" class="scroll-mt-24 p-6 sm:p-8 bg-red-50/30 border border-red-100 rounded-xl shadow-sm">
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <!-- Section 04: Admin RBAC controls (rendered only if Auth::user()->isAdmin()) -->
            @if ($user->isAdmin())
                <div id="roles" class="scroll-mt-24 p-6 sm:p-8 bg-white border border-slate-200 rounded-xl shadow-sm">
                    <div class="max-w-full">
                        @include('profile.partials.manage-roles-form')
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
