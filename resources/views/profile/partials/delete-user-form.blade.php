<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-[#E75E5B]">
            Khu vực rủi ro
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            Một khi bạn xác nhận xóa tài khoản, toàn bộ dữ liệu cá nhân, lịch sử và thông tin liên quan sẽ bị xóa sạch vĩnh viễn khỏi máy chủ. Hãy cân nhắc kỹ.
        </p>
    </header>

    <div class="pt-2">
        <x-danger-button
            class="!bg-[#E75E5B] hover:!bg-[#d94f4c] focus:!bg-[#d94f4c] active:!bg-[#c9413e] focus:!ring-[#E75E5B]"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >
            Yêu cầu xóa tài khoản
        </x-danger-button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable maxWidth="md">
        <form method="post" action="{{ route('profile.destroy') }}" class="p-5 text-center flex flex-col items-center">
            @csrf
            @method('delete')

            <div class="mb-3 text-[#E75E5B]">
                <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>

            <h2 class="text-lg font-bold text-slate-900">
                Xác nhận xóa tài khoản vĩnh viễn?
            </h2>

            <p class="mt-2 text-[13px] text-slate-500 leading-relaxed px-2">
                Để đảm bảo đây là quyết định của chính bạn, vui lòng điền mật khẩu đăng nhập hiện tại vào trường bên dưới. Dữ liệu sẽ không thể khôi phục sau khi xóa.
            </p>

            <div class="mt-5 w-full max-w-sm mx-auto flex flex-col items-center">
                <x-input-label for="password" value="Mật khẩu bảo mật" class="text-slate-700 font-semibold text-sm" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-2 block w-full text-center"
                    placeholder="Nhập mật khẩu của bạn"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-center w-full gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Hủy bỏ
                </x-secondary-button>

                <x-danger-button class="!bg-[#E75E5B] hover:!bg-[#d94f4c] focus:!bg-[#d94f4c] active:!bg-[#c9413e] focus:!ring-[#E75E5B]">
                    Xác nhận xóa tài khoản
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
