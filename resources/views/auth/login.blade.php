<x-guest-layout>
    <!-- Header/Title inside card -->
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-black tracking-tight text-white">Chào mừng trở lại</h2>
        <p class="mt-1.5 text-[11px] text-text-muted font-bold px-4 leading-relaxed">
            Đăng nhập vào tài khoản PetJam của bạn để tiếp tục.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div class="space-y-1.5">
            <x-input-label for="email" value="ĐỊA CHỈ EMAIL" class="!text-[10px] !text-text-muted" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="vidu@email.com" class="block w-full pl-10 pr-4 py-2.5 bg-input-dark text-white border border-transparent rounded-xl text-sm font-bold focus:ring-2 focus:ring-orange-brand/50 focus:outline-none transition-all" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="space-y-1.5" x-data="{ show: false }">
            <div class="flex items-center justify-between">
                <x-input-label for="password" value="MẬT KHẨU" class="!text-[10px] !text-text-muted !mb-0" />
                @if (Route::has('password.request'))
                    <a class="text-xs text-text-muted hover:text-white font-bold transition-colors" href="{{ route('password.request') }}">
                        QUÊN MẬT KHẨU?
                    </a>
                @endif
            </div>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password" placeholder="••••••••" class="block w-full pl-10 pr-10 py-2.5 bg-input-dark text-white border border-transparent rounded-xl text-sm font-bold focus:ring-2 focus:ring-orange-brand/50 focus:outline-none transition-all" />
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center cursor-pointer text-text-muted hover:text-white transition focus:outline-none">
                    <svg x-show="show" style="display: none;" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="!show" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center py-1">
            <label for="remember_me" class="relative flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="peer sr-only" name="remember">
                <div class="w-4.5 h-4.5 border border-white/20 bg-input-dark rounded flex items-center justify-center transition-all duration-200 peer-checked:bg-orange-brand peer-checked:border-orange-brand group-hover:border-white/40 shadow-sm peer-focus-visible:ring-2 peer-focus-visible:ring-orange-brand/50 text-transparent peer-checked:text-white">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <span class="ml-2.5 text-xs text-text-muted group-hover:text-white transition-colors font-medium">
                    Ghi nhớ đăng nhập
                </span>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center py-3 px-4 bg-orange-brand hover:opacity-90 rounded-full text-white text-sm font-bold shadow-glow transition duration-200">
                Đăng nhập
            </button>
        </div>

        <!-- Divider -->
        <div class="relative py-3">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-white/10"></div>
            </div>
            <div class="relative flex justify-center text-[10px]">
                <span class="px-2 bg-card-dark text-text-muted">hoặc tiếp tục với</span>
            </div>
        </div>

        <!-- Google Auth Button -->
        <button type="button" class="w-full flex items-center justify-center gap-2 py-3 px-4 bg-input-dark hover:bg-white/10 border border-white/5 rounded-full text-white text-sm font-bold transition duration-200">
            <svg class="w-5 h-5" viewBox="0 0 24 24">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
            </svg>
            Đăng nhập bằng Google
        </button>

        <!-- Register Link Footer -->
        @if (Route::has('register'))
            <div class="mt-4 text-center text-xs text-text-muted font-bold">
                Bạn chưa có tài khoản?
                <a class="text-orange-brand hover:underline transition ml-1" href="{{ route('register') }}">
                    Đăng ký ngay
                </a>
            </div>
        @endif
    </form>
</x-guest-layout>
