<x-admin-layout>
    <x-slot name="header">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-[11px] font-mono uppercase tracking-widest text-zinc-500 dark:text-zinc-400">
            <a href="{{ route('dashboard') }}" class="hover:text-[#18181B] dark:hover:text-zinc-100 transition-colors">Bảng điều khiển</a>
            <span class="text-zinc-300 dark:text-zinc-600">/</span>
            <span class="text-[#18181B] dark:text-zinc-100 font-medium">Hồ sơ cá nhân</span>
        </nav>
    </x-slot>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 max-w-7xl">
        <!-- Left Column (Sticky Sidebar) -->
        <div class="lg:col-span-4 lg:sticky lg:top-8 self-start space-y-8">
            <!-- Editorial Header -->
            <div>
                <span class="font-mono text-xs uppercase tracking-widest text-zinc-400 dark:text-zinc-500 block mb-2">[ Thiết lập tài khoản ]</span>
                <h1 class="font-serif text-5xl lg:text-6xl tracking-tight text-[#18181B] dark:text-zinc-100 leading-none">
                    Hồ sơ cá nhân
                </h1>
                <p class="mt-4 text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed font-sans font-light">
                    Cập nhật thông tin tài khoản của bạn, thay đổi mật khẩu bảo mật và quản lý quyền hạn thành viên trong hệ thống PetAdoption.
                </p>
            </div>

            <!-- Custom Navigation with Monospace Trackers -->
            <nav class="space-y-1 font-mono text-xs border-l border-[#EAEAEA] dark:border-zinc-800 pl-4 py-2">
                <a href="#info" class="group flex items-center py-2 text-zinc-400 hover:text-[#18181B] dark:hover:text-zinc-100 transition duration-150 ease-in-out">
                    <span class="mr-2 text-zinc-400 dark:text-zinc-600 group-hover:text-[#18181B] dark:group-hover:text-zinc-100">[01]</span>
                    <span class="uppercase tracking-widest font-medium">Thông tin cá nhân</span>
                </a>
                <a href="#security" class="group flex items-center py-2 text-zinc-400 hover:text-[#18181B] dark:hover:text-zinc-100 transition duration-150 ease-in-out">
                    <span class="mr-2 text-zinc-400 dark:text-zinc-600 group-hover:text-[#18181B] dark:group-hover:text-zinc-100">[02]</span>
                    <span class="uppercase tracking-widest font-medium">Bảo mật mật khẩu</span>
                </a>
                <a href="#danger" class="group flex items-center py-2 text-zinc-400 hover:text-[#18181B] dark:hover:text-zinc-100 transition duration-150 ease-in-out">
                    <span class="mr-2 text-zinc-400 dark:text-zinc-600 group-hover:text-[#18181B] dark:group-hover:text-zinc-100">[03]</span>
                    <span class="uppercase tracking-widest font-medium">Khu vực rủi ro</span>
                </a>
                @if ($user->isAdmin())
                    <a href="#roles" class="group flex items-center py-2 text-[#9F2F2D] hover:opacity-80 transition duration-150 ease-in-out border-t border-[#F0EFEA] dark:border-zinc-800/60 mt-2 pt-2">
                        <span class="mr-2 font-bold">[04]</span>
                        <span class="uppercase tracking-widest font-bold">Quản lý vai trò (Admin)</span>
                    </a>
                @endif
            </nav>

            <!-- Elegant Inline SVG Art -->
            <div class="hidden lg:block pt-6">
                <div class="relative w-48 h-48">
                    <!-- Background spot circle -->
                    <div class="absolute inset-0 m-4 rounded-full bg-[#EDF3EC] dark:bg-emerald-950/20 translate-x-3 translate-y-3"></div>
                    <!-- Single-stroke style SVG -->
                    <svg class="relative w-full h-full text-zinc-800 dark:text-zinc-200" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M30 75 C30 55, 45 40, 50 40 C55 40, 58 45, 60 50 C62 45, 65 40, 70 40 C80 40, 85 55, 85 75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M42 40 C38 28, 35 22, 30 25 C25 28, 33 37, 42 40 Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M58 40 C62 28, 65 22, 70 25 C75 28, 67 37, 58 40 Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M50 50 L50 75" stroke="currentColor" stroke-width="1" stroke-dasharray="2 2" />
                        <circle cx="43" cy="52" r="1.5" fill="currentColor" />
                        <circle cx="57" cy="52" r="1.5" fill="currentColor" />
                        <path d="M48 57 Q50 59 52 57" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Right Column (Bento Cards & Forms) -->
        <div class="lg:col-span-8 space-y-12 lg:space-y-16">
            <!-- Section 01: Profile Info -->
            <div id="info" class="scroll-mt-24 p-6 sm:p-8 bg-white dark:bg-zinc-900/60 border border-[#EAEAEA] dark:border-zinc-800/80 rounded-[6px]">
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Section 02: Update Password -->
            <div id="security" class="scroll-mt-24 p-6 sm:p-8 bg-white dark:bg-zinc-900/60 border border-[#EAEAEA] dark:border-zinc-800/80 rounded-[6px]">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Section 03: Delete User Account -->
            <div id="danger" class="scroll-mt-24 p-6 sm:p-8 bg-[#FDFBFA] dark:bg-red-950/5 border border-[#F5C2C1]/60 dark:border-red-950/30 rounded-[6px]">
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <!-- Section 04: Admin RBAC controls (rendered only if Auth::user()->isAdmin()) -->
            @if ($user->isAdmin())
                <div id="roles" class="scroll-mt-24 p-6 sm:p-8 bg-white dark:bg-zinc-900/60 border border-[#EAEAEA] dark:border-zinc-800/80 rounded-[6px]">
                    <div class="max-w-full">
                        @include('profile.partials.manage-roles-form')
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
