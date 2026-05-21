<x-guest-layout>
    <!-- Header/Title inside card -->
    <div class="mb-8">
        <h2 class="font-serif text-3xl tracking-tight text-[#18181B] dark:text-zinc-100">Đăng nhập</h2>
        <p class="mt-2 text-xs text-zinc-500 dark:text-zinc-400 font-sans font-light">
            Nhập email và mật khẩu của bạn để truy cập bảng điều khiển hệ thống PetAdoption.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div class="space-y-1.5">
            <x-input-label for="email" value="Địa chỉ Email" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div class="space-y-1.5">
            <div class="flex items-center justify-between">
                <x-input-label for="password" value="Mật khẩu bảo mật" class="mb-0" />
                @if (Route::has('password.request'))
                    <a class="text-[10px] font-mono uppercase tracking-wider text-zinc-500 hover:text-[#18181B] dark:text-zinc-400 dark:hover:text-zinc-100 transition duration-150" href="{{ route('password.request') }}">
                        Quên mật khẩu?
                    </a>
                @endif
            </div>
            <x-text-input id="password" class="block w-full" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Remember Me -->
        <div class="block pt-2">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded-[4px] border-[#EAEAEA] dark:border-zinc-800 text-[#18181B] dark:text-zinc-100 shadow-sm focus:ring-[#18181B] dark:focus:ring-zinc-100 dark:bg-zinc-900 transition duration-150 cursor-pointer" name="remember">
                <span class="ms-2.5 text-xs text-zinc-600 dark:text-zinc-400 group-hover:text-[#18181B] dark:group-hover:text-zinc-100 transition duration-150">Ghi nhớ đăng nhập</span>
            </label>
        </div>

        <div class="pt-4">
            <x-primary-button class="w-full justify-center py-2.5 text-sm">
                Đăng nhập
            </x-primary-button>
        </div>

        <!-- Register Link -->
        @if (Route::has('register'))
            <div class="mt-6 text-center text-xs text-zinc-500 dark:text-zinc-400">
                Chưa có tài khoản?
                <a href="{{ route('register') }}" class="font-medium text-[#18181B] dark:text-zinc-100 hover:underline transition duration-150 ml-1">
                    Tạo tài khoản mới
                </a>
            </div>
        @endif
    </form>
</x-guest-layout>
