@extends('layouts.frontend')

@section('title', 'Hồ sơ cá nhân')

@section('content')
<div class="pt-28 pb-20 px-4 md:px-6 lg:px-16 max-w-7xl mx-auto min-h-screen">
    <!-- Breadcrumb & Header -->
    <div class="mb-10">
        <nav class="text-sm font-medium text-slate-500 mb-3 flex items-center gap-2">
            <a href="/" class="hover:text-primary transition-colors">Trang chủ</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-slate-800">Hồ sơ cá nhân</span>
        </nav>
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Hồ sơ cá nhân</h1>
        <p class="mt-2 text-slate-600">Cập nhật thông tin tài khoản của bạn, thay đổi mật khẩu bảo mật và quản lý quyền hạn thành viên.</p>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Left Column (Sidebar) -->
        <div class="lg:col-span-4 lg:sticky lg:top-32 self-start space-y-6 hidden lg:block">
            <!-- Custom Navigation -->
            <nav class="space-y-1 text-sm border-l-2 border-slate-100 pl-4 py-2 font-medium">
                <a href="#info" class="flex items-center py-2 text-slate-500 hover:text-primary transition-colors">
                    <span class="text-slate-400 w-8 font-bold text-xs tracking-wider">[01]</span>
                    <span>Thông tin cá nhân</span>
                </a>
                <a href="#security" class="flex items-center py-2 text-slate-500 hover:text-primary transition-colors">
                    <span class="text-slate-400 w-8 font-bold text-xs tracking-wider">[02]</span>
                    <span>Bảo mật mật khẩu</span>
                </a>
                <a href="#danger" class="flex items-center py-2 text-slate-500 hover:text-red-500 transition-colors">
                    <span class="text-slate-400 w-8 font-bold text-xs tracking-wider">[03]</span>
                    <span>Khu vực rủi ro</span>
                </a>
            </nav>
        </div>

        <!-- Right Column (Cards) -->
        <div class="lg:col-span-8 space-y-6">
            <!-- Section 01: Profile Info -->
            <div id="info" class="scroll-mt-32 p-6 sm:p-8 bg-white border border-slate-200 rounded-2xl shadow-sm">
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Section 02: Update Password -->
            <div id="security" class="scroll-mt-32 p-6 sm:p-8 bg-white border border-slate-200 rounded-2xl shadow-sm">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Section 03: Delete User Account -->
            <div id="danger" class="scroll-mt-32 p-6 sm:p-8 bg-red-50/30 border border-red-100 rounded-2xl shadow-sm">
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
