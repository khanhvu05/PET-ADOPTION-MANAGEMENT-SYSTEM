<x-guest-layout>
    <!-- Header/Title inside card -->
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-black tracking-tight text-white">Xác thực Email</h2>
        <p class="mt-1.5 text-[11px] text-text-muted font-bold px-4 leading-relaxed">
            Cảm ơn bạn đã đăng ký! Trước khi bắt đầu, vui lòng xác thực địa chỉ email bằng cách nhấn vào liên kết chúng tôi vừa gửi. Nếu bạn chưa nhận được, chúng tôi sẽ gửi lại một email khác.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-bold text-[11px] text-emerald-400 text-center px-4">
            Một liên kết xác thực mới vừa được gửi đến địa chỉ email bạn cung cấp khi đăng ký.
        </div>
    @endif

    <div class="mt-6 flex flex-col gap-4 items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full flex justify-center py-3 px-4 bg-orange-brand hover:opacity-90 rounded-full text-white text-sm font-bold shadow-glow transition duration-200">
                Gửi lại Email Xác Thực
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-xs text-text-muted hover:text-white font-bold transition">
                Đăng xuất
            </button>
        </form>
    </div>
</x-guest-layout>
