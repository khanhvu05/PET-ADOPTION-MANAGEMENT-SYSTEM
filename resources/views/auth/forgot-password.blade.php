<x-guest-layout>
    <div class="mb-8">
        <h2 class="font-serif text-3xl tracking-tight text-[#18181B] dark:text-zinc-100">Quên mật khẩu?</h2>
        <p class="mt-3 text-xs text-zinc-500 dark:text-zinc-400 font-sans font-light leading-relaxed">
            Đừng lo lắng. Hãy nhập địa chỉ email của bạn, chúng tôi sẽ gửi một liên kết để bạn có thể đặt lại mật khẩu mới an toàn.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6 p-4 bg-[#EDF3EC] dark:bg-emerald-950/20 text-[#346538] dark:text-emerald-400 text-xs font-mono rounded-[6px] border border-[#D5E8D4]/60 dark:border-emerald-900/30" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-1.5">
            <x-input-label for="email" value="Địa chỉ Email" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center py-2.5 text-sm">
                Gửi liên kết khôi phục
            </x-primary-button>
        </div>
        
        <div class="text-center text-xs text-zinc-500 dark:text-zinc-400">
            <a class="font-medium text-[#18181B] dark:text-zinc-100 hover:underline transition duration-150" href="{{ route('login') }}">
                Quay lại đăng nhập
            </a>
        </div>
    </form>
</x-guest-layout>
