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

    <form x-data="profileForm()" @submit.prevent="submitForm" method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="Anh_dai_dien" value="Ảnh đại diện" />
            <div class="mt-3 flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-6">
                <!-- Avatar Preview -->
                <div class="relative shrink-0 w-20 h-20 rounded-full bg-white shadow-sm ring-4 ring-[#F58A3C]/10 border-2 border-white">
                    <img :src="imageUrl" alt="Avatar" class="w-full h-full rounded-full object-cover">
                </div>
                
                <!-- File Input -->
                <div class="flex-1 w-full min-w-0">
                    <input id="Anh_dai_dien" name="Anh_dai_dien" type="file" @change="fileChosen" class="hidden" accept="image/*"/>
                    <label for="Anh_dai_dien" class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 rounded-[10px] font-medium text-sm text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors cursor-pointer">
                        <svg class="w-4 h-4 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        Thay đổi ảnh đại diện
                    </label>
                    <p class="mt-2 text-xs text-slate-400">Định dạng hỗ trợ: JPG, PNG, GIF. Kích thước tối đa 2MB.</p>
                </div>
            </div>
            <p x-show="errors.Anh_dai_dien" x-text="errors.Anh_dai_dien ? errors.Anh_dai_dien[0] : ''" class="mt-2 text-sm font-medium text-red-600" x-cloak></p>
            
            <script>
                function profileForm() {
                    return {
                        imageUrl: '{!! $user->Anh_dai_dien ? asset("storage/" . $user->Anh_dai_dien) : "https://ui-avatars.com/api/?name=" . urlencode($user->Ho_ten ?: $user->Email) . "&background=F58A3C&color=fff" !!}',
                        errors: {},
                        isSubmitting: false,
                        fileChosen(event) {
                            const file = event.target.files[0];
                            if (file) {
                                // Validate size (2MB)
                                if (file.size > 2 * 1024 * 1024) {
                                    window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'warning', message: 'Kích thước ảnh quá lớn! Vui lòng chọn ảnh dưới 2MB.' } }));
                                    event.target.value = '';
                                    return;
                                }
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    this.imageUrl = e.target.result;
                                };
                                reader.readAsDataURL(file);
                            }
                        },
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
                                    window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'success', message: 'Đã cập nhật thông tin thành công!' } }));
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
        </div>

        <div>
            <x-input-label for="Ho_ten" value="Tên người dùng" />
            <x-text-input id="Ho_ten" name="Ho_ten" type="text" class="mt-1 block w-full" :value="old('Ho_ten', $user->Ho_ten)" required autofocus autocomplete="name" />
            <p x-show="errors.Ho_ten" x-text="errors.Ho_ten ? errors.Ho_ten[0] : ''" class="mt-2 text-sm font-medium text-red-600" x-cloak></p>
        </div>

        <div>
            <x-input-label for="Email" value="Địa chỉ Email" />
            <x-text-input id="Email" name="Email" type="email" class="mt-1 block w-full" :value="old('Email', $user->Email)" required autocomplete="username" />
            <p x-show="errors.Email" x-text="errors.Email ? errors.Email[0] : ''" class="mt-2 text-sm font-medium text-red-600" x-cloak></p>
        </div>


        <div>
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-orange-50/50 border border-orange-100 rounded-lg">
                    <p class="text-sm text-slate-600">
                        Địa chỉ email của bạn chưa được xác minh.
                        <button form="send-verification" class="font-medium text-primary hover:text-orange-600 focus:outline-none focus:underline transition duration-150">
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
            <x-primary-button x-bind:disabled="isSubmitting">
                <span x-show="!isSubmitting">Lưu thay đổi</span>
                <span x-show="isSubmitting" x-cloak>Đang xử lý...</span>
            </x-primary-button>
        </div>
    </form>
</section>
