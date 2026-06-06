<x-guest-layout>
    @section('title', 'Quên mật khẩu')

    <!-- Header/Title inside card -->
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-black tracking-tight text-white">Quên mật khẩu?</h2>
        <p class="mt-1.5 text-[11px] text-text-muted font-bold px-4 leading-relaxed">
            Đừng lo lắng. Hãy nhập địa chỉ email của bạn, chúng tôi sẽ gửi một liên kết để bạn có thể đặt lại mật khẩu mới an toàn.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
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
                <input id="email" type="email" name="email" :value="old('email')" autofocus autocomplete="username" placeholder="vidu@email.com" class="block w-full pl-10 pr-4 py-2.5 bg-input-dark text-white border border-transparent rounded-xl text-sm font-bold focus:ring-2 focus:ring-orange-brand/50 focus:outline-none transition-all" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center py-3 px-4 bg-orange-brand hover:opacity-90 rounded-full text-white text-sm font-bold shadow-glow transition duration-200">
                Gửi liên kết khôi phục
            </button>
        </div>
        
        <div class="mt-4 text-center text-xs text-text-muted font-bold">
            <a class="text-orange-brand hover:underline transition ml-1" href="{{ route('login') }}">
                Quay lại đăng nhập
            </a>
        </div>
    </form>
</x-guest-layout>
