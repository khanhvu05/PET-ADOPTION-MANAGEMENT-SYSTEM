<x-guest-layout>
    <div class="mb-8">
        <h2 class="font-serif text-3xl tracking-tight text-[#18181B] dark:text-zinc-100">Đặt lại mật khẩu</h2>
        <p class="mt-2 text-xs text-zinc-500 dark:text-zinc-400 font-sans font-light">
            Vui lòng nhập mật khẩu mới cho tài khoản của bạn.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="space-y-1.5">
            <x-input-label for="email" value="Địa chỉ Email" />
            <x-text-input id="email" class="block w-full opacity-70 bg-[#FBFBFA] dark:bg-zinc-950" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" readonly />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div class="space-y-1.5">
            <x-input-label for="password" value="Mật khẩu mới" />
            <x-text-input id="password" class="block w-full" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-1.5">
            <x-input-label for="password_confirmation" value="Xác nhận mật khẩu mới" />
            <x-text-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="pt-4">
            <x-primary-button class="w-full justify-center py-2.5 text-sm">
                Xác nhận đặt lại
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
