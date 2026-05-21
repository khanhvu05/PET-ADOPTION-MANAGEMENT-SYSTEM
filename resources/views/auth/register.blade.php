<x-guest-layout>
    <!-- Header/Title inside card -->
    <div class="mb-8">
        <h2 class="font-serif text-3xl tracking-tight text-[#18181B] dark:text-zinc-100">Tạo tài khoản</h2>
        <p class="mt-2 text-xs text-zinc-500 dark:text-zinc-400 font-sans font-light">
            Đăng ký để trở thành thành viên của cộng đồng PetAdoption.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div class="space-y-1.5">
            <x-input-label for="name" value="Tên người dùng" />
            <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Ví dụ: Nguyễn Văn A" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <!-- Email Address -->
        <div class="space-y-1.5">
            <x-input-label for="email" value="Địa chỉ Email" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div class="space-y-1.5">
            <x-input-label for="password" value="Mật khẩu bảo mật" />
            <x-text-input id="password" class="block w-full" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-1.5">
            <x-input-label for="password_confirmation" value="Xác nhận mật khẩu" />
            <x-text-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="pt-4 space-y-4">
            <x-primary-button class="w-full justify-center py-2.5 text-sm">
                Đăng ký tài khoản
            </x-primary-button>
            
            <div class="text-center text-xs text-zinc-500 dark:text-zinc-400">
                Đã có tài khoản?
                <a class="font-medium text-[#18181B] dark:text-zinc-100 hover:underline transition duration-150 ml-1" href="{{ route('login') }}">
                    Đăng nhập ngay
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
