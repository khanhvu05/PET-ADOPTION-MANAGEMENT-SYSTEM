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

    @if(session('status'))
        <script>
            // Set 60 seconds timer in localStorage on successful request
            localStorage.setItem('forgot_password_timer', Date.now() + 60000);
        </script>
    @endif

    <form id="forgot-password-form" method="POST" action="{{ route('password.email') }}" class="space-y-4">
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
            <button id="submit-btn" type="submit" class="w-full flex justify-center items-center py-3 px-4 bg-orange-brand hover:opacity-90 rounded-full text-white text-sm font-bold shadow-glow transition duration-200">
                Gửi liên kết khôi phục
            </button>
        </div>
        
        <div class="mt-4 text-center text-xs text-text-muted font-bold">
            <a class="text-orange-brand hover:underline transition ml-1" href="{{ route('login') }}">
                Quay lại đăng nhập
            </a>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('forgot-password-form');
            const input = document.getElementById('email');
            const button = document.getElementById('submit-btn');
            const originalText = button.innerHTML;

            // Xử lý loading khi bấm submit
            if(form) {
                form.addEventListener('submit', function (e) {
                    if(form.dataset.submitted) {
                        e.preventDefault();
                        return;
                    }
                    form.dataset.submitted = 'true';
                    button.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Đang xử lý...';
                    button.classList.add('opacity-70', 'cursor-not-allowed');
                });
            }

            // Xử lý đếm ngược
            const timerEnd = localStorage.getItem('forgot_password_timer');
            if (timerEnd) {
                const remaining = Math.ceil((timerEnd - Date.now()) / 1000);
                if (remaining > 0) {
                    startCountdown(remaining);
                } else {
                    localStorage.removeItem('forgot_password_timer');
                }
            }

            function startCountdown(seconds) {
                input.disabled = true;
                button.disabled = true;
                input.classList.add('opacity-50', 'cursor-not-allowed');
                button.classList.add('opacity-50', 'cursor-not-allowed');

                let current = seconds;
                button.innerHTML = `Vui lòng thử lại sau ${current}s`;

                const interval = setInterval(() => {
                    current--;
                    if (current <= 0) {
                        clearInterval(interval);
                        localStorage.removeItem('forgot_password_timer');
                        input.disabled = false;
                        button.disabled = false;
                        input.classList.remove('opacity-50', 'cursor-not-allowed');
                        button.classList.remove('opacity-50', 'cursor-not-allowed');
                        button.innerHTML = originalText;
                    } else {
                        button.innerHTML = `Vui lòng thử lại sau ${current}s`;
                    }
                }, 1000);
            }
        });
    </script>
</x-guest-layout>
