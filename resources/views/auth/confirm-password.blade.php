<x-guest-layout>
    <!-- Header/Title inside card -->
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-black tracking-tight text-white">Xác nhận Bảo mật</h2>
        <p class="mt-1.5 text-[11px] text-text-muted font-bold px-4 leading-relaxed">
            Khu vực này yêu cầu bảo mật cao. Vui lòng xác nhận mật khẩu của bạn trước khi tiếp tục.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <!-- Password -->
        <div class="space-y-1.5" x-data="{ show: false }">
            <x-input-label for="password" value="MẬT KHẨU CỦA BẠN" class="!text-[10px] !text-text-muted" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password" :type="show ? 'text' : 'password'" type="password" name="password" autocomplete="current-password" placeholder="••••••••" class="block w-full pl-10 pr-10 py-2.5 bg-input-dark text-white border border-transparent rounded-xl text-sm font-bold focus:ring-2 focus:ring-orange-brand/50 focus:outline-none transition-all" />
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

        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center py-3 px-4 bg-orange-brand hover:opacity-90 rounded-full text-white text-sm font-bold shadow-glow transition duration-200">
                Xác nhận
            </button>
        </div>
    </form>
</x-guest-layout>
