<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PetJam') }} - @yield('title', $autoPageTitle ?? 'Bảng Điều Khiển')</title>

        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        
        <!-- Trix Editor -->
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
        
        <!-- Flatpickr (Date Range Picker) -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://npmcdn.com/flatpickr/dist/l10n/vn.js"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Geist+Mono:wght@400;500;600&display=swap" rel="stylesheet">

        <!-- TomSelect -->
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="font-sans antialiased text-slate-900 bg-[#F4F7F6] overflow-hidden">
        
        <!-- Alpine State wrapper for layout -->
        <div x-data="{ expanded: localStorage.getItem('sidebarExpanded') === 'false' ? false : true }" x-init="$watch('expanded', val => localStorage.setItem('sidebarExpanded', val))" class="flex h-screen overflow-hidden">
            
            <!-- Sidebar -->
            @include('layouts.partials.admin-sidebar')

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col h-screen overflow-hidden relative min-w-0">
                <!-- Mobile Header Overlay (if needed in future) -->
                
                <!-- Top Header -->
                <header class="h-14 border-b border-slate-200 bg-white sticky top-0 z-10 shrink-0 flex items-center justify-between px-6 lg:px-8">
                    <!-- Left side: Breadcrumb -->
                    <div class="flex items-center text-sm font-medium">
                        @if (isset($header))
                            {{ $header }}
                        @else
                            <span class="text-slate-500">Tổng Quan</span>
                            <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            <span class="text-orange-brand">Dashboard</span>
                        @endif
                    </div>

                    <!-- Right side: Search & Profile -->
                    <div class="flex items-center gap-5">
                        <!-- Search Bar -->
                        <div class="relative hidden md:block">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" id="global-search-input" placeholder="Search..." class="w-64 h-9 pl-10 pr-12 bg-slate-50/50 border border-slate-200/80 rounded-xl text-sm focus:outline-none focus:border-orange-brand focus:ring-2 focus:ring-orange-brand/20 text-slate-700 placeholder-slate-400 transition-all shadow-sm">
                            <div class="absolute inset-y-0 right-0 pr-2 flex items-center pointer-events-none">
                                <span class="text-[10px] text-slate-400 font-medium border border-slate-200/80 bg-white rounded-md px-1.5 py-0.5 shadow-sm">⌘K</span>
                            </div>
                            
                            <!-- Search Results Dropdown -->
                            <div id="global-search-results" class="absolute top-full left-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-slate-100 overflow-hidden z-50 hidden flex-col max-h-[400px] overflow-y-auto">
                                <div class="p-2 text-xs font-semibold text-slate-400 uppercase tracking-wider bg-slate-50/50 border-b border-slate-100">Kết quả tìm kiếm</div>
                                <div id="search-results-list" class="flex flex-col"></div>
                            </div>
                        </div>

                        <!-- Notification Icon -->
                        <div class="relative">
                            <button id="notification-button" class="relative w-10 h-10 rounded-xl bg-slate-50/50 border border-slate-200/80 flex items-center justify-center text-slate-500 hover:text-orange-brand hover:bg-slate-100 transition-all shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                <span id="notification-badge" class="absolute -top-1.5 -right-1.5 flex items-center justify-center min-w-[1.25rem] h-5 px-1 rounded-full bg-red-400 text-[10px] font-bold text-white border-2 border-white shadow-sm hidden">0</span>
                            </button>

                            <!-- Notification Dropdown -->
                            <div id="notification-dropdown" class="absolute top-full right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-slate-100 overflow-hidden z-50 hidden flex-col max-h-[400px]">
                                <div class="flex items-center justify-between p-3 border-b border-slate-100 bg-slate-50/50">
                                    <h3 class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Thông báo</h3>
                                    <button id="mark-all-read-btn" class="text-xs text-orange-brand hover:text-orange-600 font-medium">Đánh dấu tất cả đã đọc</button>
                                </div>
                                <div id="notification-list" class="flex flex-col overflow-y-auto">
                                    <div class="p-4 text-sm text-slate-500 text-center">Đang tải...</div>
                                </div>
                            </div>
                        </div>

                        <!-- User Menu & Avatar -->
                        <div class="flex items-center gap-3 relative" x-data="{ userMenuOpen: false }">
                            <div class="hidden md:flex flex-col items-end cursor-pointer" @click="userMenuOpen = !userMenuOpen">
                                <span class="text-sm font-semibold text-slate-700">{{ Auth::user()->Ho_ten ?? 'Admin' }}</span>
                                <span class="text-xs text-slate-500">{{ Auth::user()?->isAdmin() ? 'Quản trị viên' : (Auth::user()?->isStaff() ? 'Nhân viên' : 'Người dùng') }}</span>
                            </div>
                            <button @click="userMenuOpen = !userMenuOpen" class="w-10 h-10 rounded-[1rem] bg-slate-100 border-0 ring-2 ring-transparent hover:ring-orange-brand/30 flex items-center justify-center overflow-hidden shrink-0 transition-all shadow-md cursor-pointer relative group">
                                @if(Auth::user() && Auth::user()->Anh_dai_dien)
                                    <img src="{{ asset('storage/' . Auth::user()->Anh_dai_dien) }}" alt="Avatar" class="w-full h-full object-cover">
                                @else
                                    @php
                                        $initials = 'AD';
                                        if(Auth::user()) {
                                            if(Auth::user()->Ho_ten) {
                                                $nameParts = explode(' ', trim(Auth::user()->Ho_ten));
                                                $lastName = end($nameParts);
                                                $initials = mb_strtoupper(mb_substr($lastName, 0, 1, 'UTF-8'), 'UTF-8');
                                                if (count($nameParts) > 1) {
                                                    $firstName = $nameParts[0];
                                                    $initials = mb_strtoupper(mb_substr($firstName, 0, 1, 'UTF-8'), 'UTF-8') . mb_strtoupper(mb_substr($lastName, 0, 1, 'UTF-8'), 'UTF-8');
                                                }
                                            } else {
                                                if (Auth::user()->isAdmin()) {
                                                    $initials = 'AD';
                                                } else if (Auth::user()->isStaff()) {
                                                    $initials = 'NV';
                                                }
                                            }
                                        }
                                    @endphp
                                    <span class="text-sm font-bold text-slate-600 group-hover:text-orange-brand transition-colors">{{ $initials }}</span>
                                @endif
                                <div class="absolute inset-0 rounded-[1rem] ring-1 ring-inset ring-slate-900/10"></div>
                            </button>

                            <!-- User Dropdown Menu -->
                            <div x-show="userMenuOpen" @click.away="userMenuOpen = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 translate-y-1"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 translate-y-1"
                                 class="absolute top-full right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-slate-100 overflow-hidden z-50"
                                 style="display: none;">
                                 <div class="px-4 py-3 border-b border-slate-100 bg-slate-50/50">
                                     <p class="text-xs text-slate-500">Đăng nhập với tư cách</p>
                                     <p class="text-sm font-medium text-slate-900 truncate">{{ Auth::user()->Email ?? 'admin@example.com' }}</p>
                                 </div>
                                 <div class="py-1">
                                     <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-orange-brand transition-colors">
                                         <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                         Hồ sơ cá nhân
                                     </a>
                                 </div>
                                 <div class="py-1 border-t border-slate-100">
                                     <form method="POST" action="{{ route('logout') }}">
                                         @csrf
                                         <button type="submit" class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                             Đăng xuất
                                         </button>
                                     </form>
                                 </div>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Main Scrollable Area -->
                <main class="flex-1 overflow-y-auto p-6 lg:p-8 min-w-0">
                    {{ $slot }}
                </main>
            </div>
        </div>

        <!-- Global Toast Notification System -->
        <div x-data="toastComponent()" 
             x-on:notify.window="add($event.detail)"
             class="fixed flex flex-col gap-3 pointer-events-none w-full"
             style="bottom: 24px; right: 24px; max-width: 350px; z-index: 9999;">
            <template x-for="toast in toasts" :key="toast.id">
                <div x-show="toast.visible"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-8 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     class="pointer-events-auto relative overflow-hidden border shadow-lg p-4 flex items-start gap-3"
                     :class="{
                         'bg-emerald-600 border-emerald-700 text-white': toast.type === 'success',
                         'bg-red-600 border-red-700 text-white': toast.type === 'error',
                         'bg-amber-500 border-amber-600 text-white': toast.type === 'warning',
                         'bg-blue-600 border-blue-700 text-white': toast.type === 'info',
                     }"
                     style="border-radius: 12px;">
                    
                    <!-- Icon -->
                    <div class="shrink-0 rounded-full p-1"
                         :class="{
                             'bg-emerald-700 text-white': toast.type === 'success',
                             'bg-red-700 text-white': toast.type === 'error',
                             'bg-amber-600 text-white': toast.type === 'warning',
                             'bg-blue-700 text-white': toast.type === 'info',
                         }">
                        <svg x-show="toast.type === 'success'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <svg x-show="toast.type === 'error'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        <svg x-show="toast.type === 'warning'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <svg x-show="toast.type === 'info'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>

                    <!-- Message -->
                    <div class="flex-1 pt-0.5">
                        <p class="text-sm font-medium leading-snug" x-text="toast.message"></p>
                    </div>

                    <!-- Undo Button -->
                    <button type="button" x-show="toast.undoable" @click="undoAction(toast)" class="shrink-0 text-sm font-bold underline hover:opacity-80 transition-opacity whitespace-nowrap bg-black/20 px-2 py-0.5 rounded">
                        Hoàn tác
                    </button>

                    <!-- Close Button -->
                    <button type="button" @click="remove(toast.id)" class="shrink-0 opacity-70 hover:opacity-100 transition-opacity p-1 -m-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>

                    <!-- Progress Bar -->
                    <div class="absolute bottom-0 left-0 h-1 bg-black/20 w-full">
                        <div class="h-full transition-all duration-75 ease-linear bg-white/80"
                             :style="`width: ${toast.progress}%`"></div>
                    </div>
                </div>
            </template>
        </div>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('toastComponent', () => ({
                    toasts: [],
                    add(toast) {
                        const id = Date.now();
                        const newToast = {
                            id,
                            type: toast.type || 'info',
                            message: toast.message,
                            undoable: toast.undoable || false,
                            slotId: toast.slotId || null,
                            visible: true,
                            progress: 100,
                        };
                        this.toasts.push(newToast);

                        const duration = toast.undoable ? 5000 : 3000;
                        const interval = 20;
                        const step = (100 / (duration / interval));
                        
                        const timer = setInterval(() => {
                            const t = this.toasts.find(t => t.id === id);
                            if (t && t.progress > 0) {
                                t.progress -= step;
                            } else {
                                clearInterval(timer);
                            }
                        }, interval);

                        setTimeout(() => {
                            this.remove(id);
                        }, duration);
                    },
                    remove(id) {
                        const toast = this.toasts.find(t => t.id === id);
                        if (toast) {
                            toast.visible = false;
                            setTimeout(() => {
                                this.toasts = this.toasts.filter(t => t.id !== id);
                            }, 300);
                        }
                    },
                    undoAction(toast) {
                        window.dispatchEvent(new CustomEvent('undo-action', { detail: toast.slotId }));
                        this.remove(toast.id);
                    }
                }));
            });
        </script>

        <!-- Auto trigger Laravel Sessions -->
        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    setTimeout(() => { window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'success', message: `{!! addslashes(session('success')) !!}` }})); }, 100);
                });
            </script>
        @endif
        @if(session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    setTimeout(() => { window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'error', message: `{!! addslashes(session('error')) !!}` }})); }, 100);
                });
            </script>
        @endif

        <script>
            // Global AJAX Table Initializer
            window.initAjaxTable = function(containerId, formId = null) {
                const container = document.getElementById(containerId);
                const form = formId ? document.getElementById(formId) : null;
                
                if (!container) return;

                let debounceTimer;

                async function fetchAndReplace(url) {
                    const overlay = document.getElementById('table-loading-overlay');
                    if(overlay) overlay.classList.remove('hidden');

                    try {
                        const response = await fetch(url, {
                            headers: { 'X-Requested-With': 'XMLHttpRequest' }
                        });
                        if (response.ok) {
                            const html = await response.text();
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            
                            const newContainer = doc.getElementById(containerId);
                            if (newContainer) {
                                container.innerHTML = newContainer.innerHTML;
                                window.history.pushState({}, '', url);
                            }
                        }
                    } catch (error) {
                        console.error('Lỗi khi tải dữ liệu:', error);
                        // Fallback
                        window.location.href = url;
                    } finally {
                        const newOverlay = document.getElementById('table-loading-overlay');
                        if(newOverlay) newOverlay.classList.add('hidden');
                    }
                }

                // Intercept pagination clicks
                container.addEventListener('click', (e) => {
                    const link = e.target.closest('a');
                    if (link && link.href && link.href.includes('page=')) {
                        e.preventDefault();
                        fetchAndReplace(link.href);
                    }
                });

                // Intercept per_page select change inside table container
                container.addEventListener('change', (e) => {
                    if (e.target.name === 'per_page') {
                        e.preventDefault();
                        const url = new URL(window.location.href);
                        url.searchParams.set('per_page', e.target.value);
                        url.searchParams.set('page', '1');
                        fetchAndReplace(url.toString());
                    }
                });

                // Handle Form Filters
                if (form) {
                    const submitForm = () => {
                        const formData = new FormData(form);
                        const url = new URL(form.action || window.location.href);
                        
                        // Preserve per_page if it exists in current url
                        const currentParams = new URLSearchParams(window.location.search);
                        if(currentParams.has('per_page')) {
                            url.searchParams.set('per_page', currentParams.get('per_page'));
                        }

                        // Add form data to url params
                        for (const [key, value] of formData.entries()) {
                            if (value && value !== 'all') {
                                url.searchParams.set(key, value);
                            } else {
                                url.searchParams.delete(key);
                            }
                        }
                        url.searchParams.delete('page'); // reset page to 1
                        
                        fetchAndReplace(url.toString());
                    };

                    form.addEventListener('submit', (e) => {
                        e.preventDefault();
                        submitForm();
                    });

                    // Auto submit on select change or hidden input change
                    form.addEventListener('change', (e) => {
                        if (e.target.tagName === 'SELECT' || e.target.type === 'hidden') {
                            submitForm();
                        }
                    });

                    // Auto submit on input (debounce)
                    form.addEventListener('input', (e) => {
                        if (e.target.tagName === 'INPUT' && e.target.type === 'text') {
                            clearTimeout(debounceTimer);
                            debounceTimer = setTimeout(() => {
                                submitForm();
                            }, 300); // 0.3s delay to prevent request overlap
                        }
                    });
                }
            };

            // Global Search Logic
            const searchInput = document.getElementById('global-search-input');
            const searchResults = document.getElementById('global-search-results');
            const searchList = document.getElementById('search-results-list');
            let searchTimeout = null;

            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const q = e.target.value.trim();
                    
                    clearTimeout(searchTimeout);
                    
                    if (q.length < 2) {
                        searchResults.classList.add('hidden');
                        searchResults.classList.remove('flex');
                        return;
                    }

                    searchTimeout = setTimeout(() => {
                        fetch(`/quan-tri/tim-kiem?q=${encodeURIComponent(q)}`)
                            .then(res => res.json())
                            .then(data => {
                                searchList.innerHTML = '';
                                
                                if (data.length === 0) {
                                    searchList.innerHTML = `<div class="p-4 text-sm text-slate-500 text-center">Không tìm thấy kết quả nào</div>`;
                                } else {
                                    data.forEach(item => {
                                        searchList.innerHTML += `
                                            <a href="${item.url}" class="flex items-center gap-3 p-3 hover:bg-slate-50 transition-colors border-b border-slate-50 last:border-0">
                                                <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center shrink-0">
                                                    ${item.icon}
                                                </div>
                                                <div class="flex flex-col min-w-0">
                                                    <span class="text-xs text-slate-500">${item.type}</span>
                                                    <span class="text-sm font-medium text-slate-700 truncate">${item.title}</span>
                                                </div>
                                            </a>
                                        `;
                                    });
                                }
                                
                                searchResults.classList.remove('hidden');
                                searchResults.classList.add('flex');
                            })
                            .catch(err => console.error(err));
                    }, 300);
                });

                // Hotkey for search
                document.addEventListener('keydown', e => {
                    if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                        e.preventDefault();
                        searchInput.focus();
                    }
                });

                // Hide dropdown when clicking outside
                document.addEventListener('click', e => {
                    if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                        searchResults.classList.add('hidden');
                        searchResults.classList.remove('flex');
                    }
                });
            }

            // Notification Logic
            const notifButton = document.getElementById('notification-button');
            const notifDropdown = document.getElementById('notification-dropdown');
            const notifList = document.getElementById('notification-list');
            const notifBadge = document.getElementById('notification-badge');
            const markAllReadBtn = document.getElementById('mark-all-read-btn');
            
            function fetchNotifications() {
                fetch('/admin/notifications')
                    .then(res => res.json())
                    .then(data => {
                        if (data.unread_count > 0) {
                            notifBadge.textContent = data.unread_count > 99 ? '99+' : data.unread_count;
                            notifBadge.classList.remove('hidden');
                        } else {
                            notifBadge.classList.add('hidden');
                        }

                        notifList.innerHTML = '';
                        if (data.notifications.length === 0) {
                            notifList.innerHTML = `<div class="p-4 text-sm text-slate-500 text-center">Không có thông báo mới</div>`;
                        } else {
                            data.notifications.forEach(notif => {
                                notifList.innerHTML += `
                                    <div class="flex flex-col gap-1 p-3 hover:bg-slate-50 transition-colors border-b border-slate-50 last:border-0 relative">
                                        <a href="${notif.url}" class="text-sm font-medium text-slate-800 pr-6">${notif.title}</a>
                                        <p class="text-xs text-slate-500">${notif.message}</p>
                                        <span class="text-[10px] text-slate-400 mt-1">${notif.created_at}</span>
                                        <button onclick="markAsRead('${notif.id}')" class="absolute top-3 right-3 text-slate-300 hover:text-green-500 transition-colors" title="Đánh dấu đã đọc">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </button>
                                    </div>
                                `;
                            });
                        }
                    });
            }

            window.markAsRead = function(id) {
                fetch(`/admin/notifications/${id}/read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(() => fetchNotifications());
            };

            if (notifButton) {
                notifButton.addEventListener('click', () => {
                    const isHidden = notifDropdown.classList.contains('hidden');
                    if (isHidden) {
                        notifDropdown.classList.remove('hidden');
                        notifDropdown.classList.add('flex');
                        fetchNotifications();
                    } else {
                        notifDropdown.classList.add('hidden');
                        notifDropdown.classList.remove('flex');
                    }
                });

                document.addEventListener('click', e => {
                    if (!notifButton.contains(e.target) && !notifDropdown.contains(e.target)) {
                        notifDropdown.classList.add('hidden');
                        notifDropdown.classList.remove('flex');
                    }
                });

                markAllReadBtn.addEventListener('click', () => {
                    fetch(`/admin/notifications/read-all`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    }).then(() => fetchNotifications());
                });

                // Initial fetch
                fetchNotifications();
            }

            // Global SweetAlert Config
            window.swalConfig = {
                customClass: {
                    popup: 'rounded-[16px] border border-slate-100 shadow-2xl bg-white font-sans',
                    title: 'text-[18px] font-bold text-slate-800 pt-4',
                    htmlContainer: 'text-[14px] text-slate-500 font-medium leading-relaxed mt-2',
                    confirmButton: 'bg-red-600 hover:bg-red-700 text-white font-semibold rounded-[10px] px-6 py-2.5 transition-colors shadow-sm',
                    cancelButton: 'bg-white hover:bg-slate-50 text-slate-600 border border-slate-200 font-semibold rounded-[10px] px-6 py-2.5 transition-colors shadow-sm ml-3',
                    actions: 'mt-6 mb-2',
                    icon: 'border-0 scale-110 mb-0'
                },
                buttonsStyling: false,
                backdrop: 'rgba(15, 23, 42, 0.5)'
            };

            // SweetAlert confirm delete
            document.addEventListener('DOMContentLoaded', () => {
                document.addEventListener('click', (e) => {
                    const form = e.target.closest('form.confirm-delete');
                    if (form) {
                        e.preventDefault();
                        
                        // Lấy data attributes từ form nếu có, nếu không dùng mặc định
                        const title = form.dataset.title || 'Xóa dữ liệu?';
                        const text = form.dataset.text || 'Bạn có chắc chắn muốn xóa dữ liệu này vĩnh viễn? Hành động này không thể hoàn tác!';
                        
                        Swal.fire({
                            ...window.swalConfig,
                            title: title,
                            text: text,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Có, xóa ngay',
                            cancelButtonText: 'Hủy'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    }
                });
            });
        </script>

        @stack('scripts')
        
        @if (!request()->routeIs('login', 'register'))
    @include('components.chatbox-widget')
@endif
    </body>
</html>
