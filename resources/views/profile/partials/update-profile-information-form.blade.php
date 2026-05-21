<section>
    <header>
        <span class="font-mono text-[10px] uppercase tracking-widest text-[#9F2F2D] dark:text-red-400 block mb-1">[ Mục 01 ]</span>
        <h2 class="text-xl font-serif text-[#18181B] dark:text-zinc-100 tracking-tight">
            Thông tin tài khoản
        </h2>
        <p class="mt-1.5 text-xs text-zinc-500 dark:text-zinc-400 font-sans font-light">
            Cập nhật tên hiển thị và địa chỉ email chính thức để kết nối với hệ thống.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="Tên người dùng" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="Địa chỉ Email" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-[#FDFBFA] dark:bg-zinc-800/40 border border-[#EAEAEA] dark:border-zinc-800 rounded-[6px]">
                    <p class="text-xs text-zinc-600 dark:text-zinc-400">
                        Địa chỉ email của bạn chưa được xác minh.
                        <button form="send-verification" class="underline text-xs text-zinc-500 dark:text-zinc-400 hover:text-[#18181B] dark:hover:text-zinc-100 focus:outline-none transition duration-150">
                            Nhấp vào đây để gửi lại email xác minh.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-mono text-[10px] text-[#346538] dark:text-emerald-400 uppercase tracking-wider">
                            Một liên kết xác minh mới đã được gửi tới địa chỉ email của bạn.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <x-primary-button>Lưu thay đổi</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="px-2.5 py-1 text-[11px] font-mono uppercase tracking-wider rounded-[4px] bg-[#EDF3EC] dark:bg-emerald-950/30 text-[#346538] dark:text-emerald-400 border border-[#D5E8D4]/60 dark:border-emerald-900/30"
                >Đã cập nhật thành công</p>
            @endif
        </div>
    </form>
</section>
