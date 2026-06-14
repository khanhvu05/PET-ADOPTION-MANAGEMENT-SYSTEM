<section>
    <header>
        <h2 class="text-lg font-bold text-slate-900">
            Cập nhật mật khẩu
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            Đảm bảo tài khoản của bạn sử dụng mật khẩu dài, ngẫu nhiên để giữ an toàn.
        </p>
    </header>

    <form x-data="passwordForm()" @submit.prevent="submitForm" method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" value="Mật khẩu hiện tại" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <p x-show="errors.current_password" x-text="errors.current_password ? errors.current_password[0] : ''" class="mt-2 text-sm font-medium text-red-600" x-cloak></p>
        </div>

        <div>
            <x-input-label for="update_password_password" value="Mật khẩu mới" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <p x-show="errors.password" x-text="errors.password ? errors.password[0] : ''" class="mt-2 text-sm font-medium text-red-600" x-cloak></p>
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" value="Xác nhận mật khẩu mới" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <p x-show="errors.password_confirmation" x-text="errors.password_confirmation ? errors.password_confirmation[0] : ''" class="mt-2 text-sm font-medium text-red-600" x-cloak></p>
        </div>

        <div class="flex items-center gap-4 pt-2">
            <x-primary-button x-bind:disabled="isSubmitting">
                <span x-show="!isSubmitting">Lưu mật khẩu</span>
                <span x-show="isSubmitting" x-cloak>Đang xử lý...</span>
            </x-primary-button>
        </div>
    </form>

    <script>
        function passwordForm() {
            return {
                errors: {},
                isSubmitting: false,
                async submitForm(event) {
                    this.isSubmitting = true;
                    this.errors = {};
                    const formData = new FormData(event.target);
                    try {
                        const response = await fetch(event.target.action, {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                            },
                            body: formData,
                        });
                        
                        if (response.ok) {
                            event.target.reset();
                            window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'success', message: 'Đã cập nhật mật khẩu thành công!' } }));
                        } else if (response.status === 422) {
                            const data = await response.json();
                            this.errors = data.errors || {};
                            window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'error', message: 'Vui lòng kiểm tra lại thông tin!' } }));
                        } else {
                            throw new Error('Server error');
                        }
                    } catch (error) {
                        window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'error', message: 'Đã xảy ra lỗi hệ thống!' } }));
                    } finally {
                        this.isSubmitting = false;
                    }
                }
            }
        }
    </script>
</section>
