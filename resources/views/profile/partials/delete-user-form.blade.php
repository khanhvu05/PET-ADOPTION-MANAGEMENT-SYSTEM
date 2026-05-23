<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-red-600">
            Khu vực rủi ro
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            Một khi bạn xác nhận xóa tài khoản, toàn bộ dữ liệu cá nhân, lịch sử và thông tin liên quan sẽ bị xóa sạch vĩnh viễn khỏi máy chủ. Hãy cân nhắc kỹ.
        </p>
    </header>

    <div class="pt-2">
        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >
            Yêu cầu xóa tài khoản
        </x-danger-button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-slate-900">
                Xác nhận xóa tài khoản vĩnh viễn?
            </h2>

            <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                Để đảm bảo đây là quyết định của chính bạn, vui lòng điền mật khẩu đăng nhập hiện tại vào trường bên dưới. Dữ liệu sẽ không thể khôi phục sau khi xóa.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Mật khẩu bảo mật" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full sm:w-3/4"
                    placeholder="Nhập mật khẩu của bạn"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Hủy bỏ
                </x-secondary-button>

                <x-danger-button>
                    Xác nhận xóa tài khoản
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
