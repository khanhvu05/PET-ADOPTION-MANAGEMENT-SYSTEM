<section>
    <header>
        <span class="font-mono text-[10px] uppercase tracking-widest text-[#9F2F2D] dark:text-red-400 block mb-1">[ Mục 02 ]</span>
        <h2 class="text-xl font-serif text-[#18181B] dark:text-zinc-100 tracking-tight">
            Bảo mật mật khẩu
        </h2>
        <p class="mt-1.5 text-xs text-zinc-500 dark:text-zinc-400 font-sans font-light">
            Cập nhật mật khẩu định kỳ để duy trì tính bảo mật an toàn tối đa cho tài khoản của bạn.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" value="Mật khẩu hiện tại" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" value="Mật khẩu mới" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" value="Xác nhận mật khẩu mới" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <x-primary-button>Cập nhật mật khẩu</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="px-2.5 py-1 text-[11px] font-mono uppercase tracking-wider rounded-[4px] bg-[#EDF3EC] dark:bg-emerald-950/30 text-[#346538] dark:text-emerald-400 border border-[#D5E8D4]/60 dark:border-emerald-900/30"
                >Đã đổi mật khẩu thành công</p>
            @endif
        </div>
    </form>
</section>
