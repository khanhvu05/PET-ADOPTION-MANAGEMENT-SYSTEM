<section>
    <header>
        <h2 class="text-lg font-bold text-slate-900">
            Thông tin tài khoản
        </h2>
        <p class="mt-1 text-sm text-slate-500">
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
                <div class="mt-4 p-4 bg-orange-50/50 border border-orange-100 rounded-lg">
                    <p class="text-sm text-slate-600">
                        Địa chỉ email của bạn chưa được xác minh.
                        <button form="send-verification" class="font-medium text-orange-brand hover:text-orange-600 focus:outline-none focus:underline transition duration-150">
                            Nhấp vào đây để gửi lại email xác minh.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-xs font-medium text-green-600">
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
                    class="text-sm font-medium text-green-600"
                >Đã lưu thành công.</p>
            @endif
        </div>
    </form>
</section>
