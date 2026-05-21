<section>
    <header class="mb-6">
        <span class="font-mono text-[10px] uppercase tracking-widest text-[#9F2F2D] dark:text-red-400 block mb-1">[ Mục 04 ]</span>
        <h2 class="text-xl font-serif text-[#18181B] dark:text-zinc-100 tracking-tight">
            Quản lý vai trò (RBAC)
        </h2>
        <p class="mt-1.5 text-xs text-zinc-500 dark:text-zinc-400 font-sans font-light">
            Xem danh sách người dùng và phân chia vai trò (Admin, Staff, User) để kiểm soát quyền hạn truy cập hệ thống.
        </p>
    </header>

    @if (session('status') === 'role-updated')
        <div class="mb-6 p-4 bg-[#EDF3EC] dark:bg-emerald-950/20 text-[#346538] dark:text-emerald-400 text-xs font-mono rounded-[6px] border border-[#D5E8D4]/60 dark:border-emerald-900/30">
            [ THÀNH CÔNG ] Cập nhật quyền hạn và vai trò người dùng thành công.
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 p-4 bg-[#FDEBEC] dark:bg-red-950/20 text-[#9F2F2D] dark:text-red-400 text-xs font-mono rounded-[6px] border border-[#F5C2C1]/60 dark:border-red-900/30">
            [ THẤT BẠI ] {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-xs font-sans">
            <thead>
                <tr class="border-b border-[#EAEAEA] dark:border-zinc-800">
                    <th class="py-3 font-mono text-[10px] uppercase tracking-widest text-zinc-400 dark:text-zinc-500 font-medium">Người dùng</th>
                    <th class="py-3 font-mono text-[10px] uppercase tracking-widest text-zinc-400 dark:text-zinc-500 font-medium">Vai trò hiện tại</th>
                    <th class="py-3 font-mono text-[10px] uppercase tracking-widest text-zinc-400 dark:text-zinc-500 font-medium text-right">Thay đổi quyền hạn</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#F5F5F5] dark:divide-zinc-900">
                @foreach ($users as $u)
                    <tr class="align-middle hover:bg-zinc-50/50 dark:hover:bg-zinc-900/30 transition duration-150">
                        <td class="py-4">
                            <div class="font-medium text-[#18181B] dark:text-zinc-200">{{ $u->name }}</div>
                            <div class="font-mono text-[10px] text-zinc-400 mt-0.5">{{ $u->email }}</div>
                        </td>
                        <td class="py-4">
                            @if ($u->isAdmin())
                                <span class="inline-flex items-center px-2 py-0.5 rounded-[4px] text-[10px] font-mono uppercase font-medium bg-[#FDEBEC] dark:bg-red-950/30 text-[#9F2F2D] dark:text-red-400 border border-[#F5C2C1]/50 dark:border-red-900/30">
                                    Admin
                                </span>
                            @elseif ($u->role === 'staff')
                                <span class="inline-flex items-center px-2 py-0.5 rounded-[4px] text-[10px] font-mono uppercase font-medium bg-[#FDF6E2] dark:bg-yellow-950/30 text-[#856404] dark:text-yellow-400 border border-[#F5E7C4]/50 dark:border-yellow-900/30">
                                    Staff
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-[4px] text-[10px] font-mono uppercase font-medium bg-[#EDF3EC] dark:bg-zinc-800/40 text-[#346538] dark:text-zinc-400 border border-[#D5E8D4]/50 dark:border-zinc-800/40">
                                    User
                                </span>
                            @endif
                        </td>
                        <td class="py-4 text-right">
                            @if (Auth::user()->id !== $u->id)
                                <form method="POST" action="{{ route('admin.users.role.update', $u) }}" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <div class="flex items-center gap-2 justify-end">
                                        <select name="role" class="rounded-[6px] border border-[#EAEAEA] dark:border-zinc-800 bg-white dark:bg-zinc-900 text-[#18181B] dark:text-zinc-200 px-2 py-1 text-[11px] font-mono focus:outline-none focus:border-zinc-500 transition duration-150">
                                            <option value="user" {{ $u->role === 'user' ? 'selected' : '' }}>USER</option>
                                            <option value="staff" {{ $u->role === 'staff' ? 'selected' : '' }}>STAFF</option>
                                            <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>ADMIN</option>
                                        </select>
                                        <x-secondary-button type="submit" class="px-2 py-1 !text-[10px] tracking-wider uppercase">
                                            Cập nhật
                                        </x-secondary-button>
                                    </div>
                                </form>
                            @else
                                <span class="text-[10px] font-mono text-zinc-400 italic pr-2">Tài khoản của bạn</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
