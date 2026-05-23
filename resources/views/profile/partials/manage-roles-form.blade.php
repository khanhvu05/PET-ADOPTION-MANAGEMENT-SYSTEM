<section>
    <header class="mb-6">
        <h2 class="text-lg font-bold text-slate-900">
            Quản lý vai trò (RBAC)
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            Xem danh sách người dùng và phân chia vai trò (Admin, Staff, User) để kiểm soát quyền hạn truy cập hệ thống.
        </p>
    </header>

    @if (session('status') === 'role-updated')
        <div class="mb-6 p-4 bg-green-50/50 border border-green-100 text-green-600 text-sm font-medium rounded-lg">
            Cập nhật quyền hạn và vai trò người dùng thành công.
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 p-4 bg-red-50/50 border border-red-100 text-red-600 text-sm font-medium rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto border border-slate-200 rounded-xl">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-200">
                    <th class="py-3 px-4 font-bold text-xs uppercase tracking-widest text-slate-500">Người dùng</th>
                    <th class="py-3 px-4 font-bold text-xs uppercase tracking-widest text-slate-500">Vai trò hiện tại</th>
                    <th class="py-3 px-4 font-bold text-xs uppercase tracking-widest text-slate-500 text-right">Thay đổi quyền hạn</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach ($users as $u)
                    <tr class="align-middle hover:bg-slate-50/50 transition duration-150">
                        <td class="py-3 px-4">
                            <div class="font-semibold text-slate-900">{{ $u->name }}</div>
                            <div class="font-mono text-xs text-slate-500 mt-0.5">{{ $u->email }}</div>
                        </td>
                        <td class="py-3 px-4">
                            @if ($u->isAdmin())
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide bg-orange-brand text-white shadow-sm">
                                    Admin
                                </span>
                            @elseif ($u->role === 'staff')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide bg-orange-100 text-orange-700">
                                    Staff
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide bg-slate-100 text-slate-600">
                                    User
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-right">
                            @if (Auth::user()->id !== $u->id)
                                <form method="POST" action="{{ route('admin.users.role.update', $u) }}" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <div class="flex items-center gap-2 justify-end">
                                        <select name="role" class="rounded-lg border border-slate-200 bg-white text-slate-900 px-3 py-1.5 text-sm font-medium focus:outline-none focus:border-orange-brand focus:ring-1 focus:ring-orange-brand transition-all shadow-sm">
                                            <option value="user" {{ $u->role === 'user' ? 'selected' : '' }}>USER</option>
                                            <option value="staff" {{ $u->role === 'staff' ? 'selected' : '' }}>STAFF</option>
                                            <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>ADMIN</option>
                                        </select>
                                        <button type="submit" class="px-3 py-1.5 border border-slate-200 rounded-lg hover:bg-slate-50 text-slate-600 font-medium text-xs transition-colors shadow-sm">
                                            Cập nhật
                                        </button>
                                    </div>
                                </form>
                            @else
                                <span class="text-xs text-slate-400 italic pr-2">Tài khoản của bạn</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
