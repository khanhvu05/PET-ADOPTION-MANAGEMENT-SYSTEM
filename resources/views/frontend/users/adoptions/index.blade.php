@extends('layouts.frontend')

@section('title', 'Lịch Sử Nhận Nuôi')

@section('content')
<style>
    body, .min-h-screen, button, input, select, textarea { font-family: 'Inter', sans-serif !important; }
    svg.lucide, [data-lucide] { stroke-width: 1.5 !important; }
</style>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<div class="min-h-screen pt-20 pb-20">
    <!-- Hero Banner -->
    <section class="w-full mx-auto pb-6 flex justify-center relative">
        <img src="{{ asset('images/bg-nhanuoi.png') }}" alt="Lịch sử nhận nuôi" class="w-full max-w-[1500px] h-auto object-contain">
    </section>

    <div class="max-w-[1300px] mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumb & Header -->
        <div class="mb-8">
            <nav class="flex text-sm text-gray-500 mb-4" aria-label="Breadcrumb">
                <ol class="flex flex-wrap items-center gap-2">
                    <li><a href="/" class="hover:text-[#F58A3C] transition-colors">Trang chủ</a></li>
                    <li><i data-lucide="chevron-right" class="w-3 h-3 text-gray-400"></i></li>
                    <li><span class="text-gray-500">Tài khoản</span></li>
                    <li><i data-lucide="chevron-right" class="w-3 h-3 text-gray-400"></i></li>
                    <li class="text-[#1D2B53] font-semibold" aria-current="page">Lịch sử nhận nuôi</li>
                </ol>
            </nav>
            <h1 class="text-3xl font-semibold text-[#1D2B53] tracking-tight mb-2">Lịch sử nhận nuôi</h1>
            <p class="text-gray-500 text-[15px]">Theo dõi hành trình yêu thương và những người bạn bốn chân đã tìm thấy mái ấm.</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-6 items-start">
            <!-- Sidebar -->
            <aside class="w-full lg:w-[260px] shrink-0 space-y-6">
                <!-- Tổng quan -->
                <div class="bg-[#FFFDFB] rounded-xl p-5 shadow-sm border border-orange-50">
                    <h3 class="font-medium text-[#1D2B53] text-[15px] flex items-center gap-2 mb-5">
                        <i data-lucide="paw-print" class="w-5 h-5 text-[#F58A3C] fill-[#F58A3C]"></i> Tổng quan
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between border-b border-gray-50 pb-3">
                            <div class="flex items-center gap-2 text-[13px] font-medium text-gray-500">
                                <i data-lucide="link" class="w-4 h-4 text-[#F58A3C]"></i>
                                Tổng số đơn
                            </div>
                            <span class="font-semibold text-[15px] text-[#1D2B53]">{{ str_pad($totalPets ?? 0, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="flex items-center justify-between border-b border-gray-50 pb-3">
                            <div class="flex items-center gap-2 text-[13px] font-medium text-gray-500">
                                <i data-lucide="home" class="w-4 h-4 text-emerald-500"></i>
                                Đã nhận nuôi
                            </div>
                            <span class="font-semibold text-[15px] text-[#1D2B53]">{{ str_pad($adoptedPets ?? 0, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 text-[13px] font-medium text-gray-500">
                                <i data-lucide="clock" class="w-4 h-4 text-red-400"></i>
                                Đang xử lý
                            </div>
                            <span class="font-semibold text-[15px] text-[#1D2B53]">{{ str_pad($pendingPets ?? 0, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Bộ lọc -->
                <form id="filter-form" action="{{ route('frontend.user.adoptions.index') }}" method="GET" class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <input type="hidden" name="sort" value="{{ request('sort', 'newest') }}">
                    <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
                    
                    <h3 class="font-medium text-[#1D2B53] text-[15px] flex items-center gap-2 mb-4">
                        <i data-lucide="filter" class="w-4 h-4 text-gray-400"></i> Bộ lọc
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[12px] font-medium text-gray-400 mb-1.5">Trạng thái</label>
                            <div class="relative">
                                <select name="status" data-icon-class="text-gray-400" class="custom-select-trigger w-full text-[13px] font-medium text-[#1D2B53] bg-gray-50/50 hover:bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 outline-none transition-all cursor-pointer shadow-sm">
                                    <option value="all">Tất cả</option>
                                    <option value="cho_duyet" {{ request('status') == 'cho_duyet' ? 'selected' : '' }}>Chờ duyệt</option>
                                    <option value="cho_xac_nhan_don" {{ request('status') == 'cho_xac_nhan_don' ? 'selected' : '' }}>Chờ xác nhận đơn</option>
                                    <option value="cho_phong_van" {{ request('status') == 'cho_phong_van' ? 'selected' : '' }}>Chờ phỏng vấn</option>
                                    <option value="da_duyet" {{ request('status') == 'da_duyet' ? 'selected' : '' }}>Đã duyệt (PV thành công)</option>
                                    <option value="hoan_thanh" {{ request('status') == 'hoan_thanh' ? 'selected' : '' }}>Hoàn thành (Đã nhận nuôi)</option>
                                    <option value="tu_choi" {{ request('status') == 'tu_choi' ? 'selected' : '' }}>Từ chối / Hủy</option>
                                </select>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-[12px] font-medium text-gray-400 mb-1.5">Thời gian</label>
                            <div class="relative">
                                <select name="time" data-icon-class="text-gray-400" class="custom-select-trigger w-full text-[13px] font-medium text-[#1D2B53] bg-gray-50/50 hover:bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 outline-none transition-all cursor-pointer shadow-sm">
                                    <option value="all">Tất cả thời gian</option>
                                    <option value="this_month" {{ request('time') == 'this_month' ? 'selected' : '' }}>Tháng này</option>
                                    <option value="last_3_months" {{ request('time') == 'last_3_months' ? 'selected' : '' }}>3 tháng gần đây</option>
                                    <option value="this_year" {{ request('time') == 'this_year' ? 'selected' : '' }}>Năm nay</option>
                                </select>
                            </div>
                        </div>
                        
                        <button type="button" id="reset-filters" class="w-full flex items-center justify-center gap-1.5 py-2.5 text-[12px] font-medium text-gray-500 bg-white border border-gray-200 hover:bg-gray-50 rounded-[10px] transition-colors mt-2">
                            <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i> Đặt lại bộ lọc
                        </button>
                    </div>
                </form>

                <!-- Hỗ trợ -->
                <div class="bg-[#FFF5EF] rounded-xl p-5 relative overflow-hidden">
                    <h3 class="text-[#1D2B53] font-medium text-[15px] mb-2">Bạn cần hỗ trợ?</h3>
                    <p class="text-[12px] text-gray-600 mb-5 leading-relaxed pr-8">Đội ngũ PetJam luôn sẵn sàng hỗ trợ bạn 24/7.</p>
                    <a href="/lien-he" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-[#F58A3C] hover:bg-[#e07930] text-white text-[12px] font-medium rounded-[8px] transition-colors shadow-sm relative z-10">
                        Liên hệ ngay <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                    </a>
                    
                    <!-- Cute Dog Illustration -->
                    <img src="https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=200&h=200&fit=crop" alt="Support Dog" class="absolute -bottom-2 -right-4 w-24 h-24 object-cover rounded-full border-[4px] border-white shadow-sm opacity-90 transform -scale-x-100">
                </div>
            </aside>

            <!-- Main Content Container -->
            <div id="adoption-list-container" class="flex-1 min-w-0 bg-white rounded-2xl shadow-sm p-6 relative">
                <!-- Search & Sort Bar -->
                <div class="flex flex-col sm:flex-row gap-4 justify-between items-end sm:items-center mb-6 relative z-30">
                    <div class="w-full sm:w-[380px] relative">
                        <input type="text" id="search-input" value="{{ request('search') }}" placeholder="Tìm kiếm thú cưng (tên, mã đơn...)" class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-100 rounded-[12px] text-[13px] focus:outline-none focus:border-[#F58A3C] focus:ring-1 focus:ring-[#F58A3C] transition-all">
                        <i data-lucide="search" class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <span class="text-[13px] font-medium text-gray-500 whitespace-nowrap">Sắp xếp:</span>
                        <div class="relative">
                            <select id="sort-select" data-icon-class="text-gray-400" class="custom-select-trigger text-[13px] font-medium text-[#1D2B53] bg-white hover:bg-gray-50 border border-gray-200 rounded-xl cursor-pointer pl-4 py-2.5 transition-all shadow-sm outline-none">
                                <option value="newest" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Cũ nhất</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Loading Overlay -->
                <div id="loading-overlay" class="absolute top-[80px] left-0 right-0 bottom-0 bg-white/60 backdrop-blur-sm z-20 hidden flex items-start justify-center pt-32 rounded-b-[24px]">
                    <div class="w-8 h-8 border-4 border-[#F58A3C] border-t-transparent rounded-full animate-spin"></div>
                </div>

                <!-- List of Adoptions -->
                <div class="space-y-4">
                    @forelse($applications as $app)
                        <div class="bg-white rounded-xl border border-gray-100 p-4 flex flex-col xl:flex-row gap-5 items-start xl:items-center transition-all hover:border-[#F58A3C]/30 hover:shadow-[0_4px_20px_rgba(245,138,60,0.06)] group">
                            <!-- Left: Image & Info -->
                            <div class="flex gap-4 flex-1 w-full">
                                <!-- Image -->
                                <div class="w-[100px] h-[100px] rounded-lg overflow-hidden shrink-0 bg-gray-50 relative">
                                    @if($app->thuCung && $app->thuCung->AnhUrl)
                                        <img src="{{ $app->thuCung->AnhUrl }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="{{ $app->thuCung->Ten }}">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                                            <i data-lucide="image-off" class="w-8 h-8"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Info -->
                                <div class="flex-1 min-w-0 flex flex-col justify-center py-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h3 class="text-[17px] font-semibold text-[#1D2B53] truncate">{{ $app->thuCung ? $app->thuCung->Ten : 'Thú cưng đã bị xóa' }}</h3>
                                        @if($app->thuCung)
                                            @if($app->thuCung->Gioi_tinh === 'duc')
                                                <i data-lucide="mars" class="w-4 h-4 text-blue-500"></i>
                                            @else
                                                <i data-lucide="venus" class="w-4 h-4 text-pink-500"></i>
                                            @endif
                                        @endif
                                    </div>
                                    
                                    <p class="text-[12px] text-gray-500 mb-3">Mã đơn: <span class="font-medium text-gray-700">{{ strtoupper(substr($app->Ma_don, 0, 8)) }}</span></p>
                                    
                                    <div class="flex flex-wrap items-center gap-4">
                                        @php
                                            $statusConfig = [
                                                'cho_duyet'         => ['text' => 'text-amber-600', 'border' => 'border-amber-200', 'bg' => 'bg-white'],
                                                'cho_xac_nhan_don'  => ['text' => 'text-indigo-600', 'border' => 'border-indigo-200', 'bg' => 'bg-white'],
                                                'cho_phong_van'     => ['text' => 'text-blue-600', 'border' => 'border-blue-200', 'bg' => 'bg-white'],
                                                'da_duyet'          => ['text' => 'text-emerald-600', 'border' => 'border-emerald-200', 'bg' => 'bg-white'],
                                                'tu_choi'           => ['text' => 'text-red-600', 'border' => 'border-red-200', 'bg' => 'bg-white'],
                                                'hoan_thanh'        => ['text' => 'text-emerald-600', 'border' => 'border-emerald-200', 'bg' => 'bg-white'],
                                            ];
                                            $cfg = $statusConfig[$app->Trang_thai] ?? ['text' => 'text-gray-600', 'border' => 'border-gray-200', 'bg' => 'bg-white'];
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-medium border {{ $cfg['border'] }} {{ $cfg['text'] }} {{ $cfg['bg'] }}">
                                            <i data-lucide="check-circle-2" class="w-3.5 h-3.5 mr-1.5 {{ $cfg['text'] }}"></i>
                                            {{ $app->trang_thai_label }}
                                        </span>
                                        
                                        <div class="flex flex-wrap gap-4 text-[11px] text-gray-400 font-medium">
                                            <span class="flex items-center gap-1.5">
                                                <i data-lucide="calendar" class="w-3.5 h-3.5 text-gray-300"></i>
                                                Ngày gửi: {{ $app->Ngay_tao->format('d/m/Y') }}
                                            </span>
                                            
                                            @if($app->Trang_thai === 'hoan_thanh')
                                            <span class="flex items-center gap-1.5">
                                                <i data-lucide="calendar-check" class="w-3.5 h-3.5 text-gray-300"></i>
                                                Ngày hoàn tất: {{ $app->Ngay_cap_nhat->format('d/m/Y') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right: Status Box -->
                            <div class="w-full xl:w-[280px] shrink-0 flex flex-row items-center gap-4 bg-[#F9FDFC] p-4 rounded-lg">
                                <div class="flex-1 min-w-0">
                                    @if($app->Trang_thai === 'hoan_thanh')
                                        <div class="flex items-start gap-2.5 mb-3">
                                            <i data-lucide="home" class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5"></i>
                                            <div>
                                                <h4 class="text-[13px] font-semibold text-emerald-700 mb-1">Đã về mái ấm mới</h4>
                                                <p class="text-[11px] text-gray-500 leading-tight font-medium">{{ $app->thuCung->Ten ?? 'Bé' }} đang có một cuộc sống hạnh phúc bên gia đình mới.</p>
                                            </div>
                                        </div>
                                    @elseif($app->Trang_thai === 'cho_xac_nhan_don' && !$app->interview_slot_id)
                                        <div class="flex items-start gap-2.5">
                                            <i data-lucide="calendar-clock" class="w-5 h-5 text-[#F58A3C] shrink-0 mt-0.5"></i>
                                            <div class="flex-1 min-w-0">
                                                <h4 class="text-[13px] font-semibold text-[#F58A3C] mb-2">Cần xác nhận lịch</h4>
                                                <form action="{{ route('frontend.user.adoptions.schedule-interview', $app->Ma_don) }}" method="POST" class="ajax-schedule-form">
                                                    @csrf
                                                    <div class="relative mb-2.5 z-10">
                                                        <select name="interview_slot_id" data-icon-class="text-[#F58A3C]" class="custom-select-trigger w-full text-[12px] font-medium text-[#1D2B53] bg-white border border-[#F58A3C]/40 rounded-[10px] pl-3 py-2 outline-none transition-all cursor-pointer shadow-sm" required>
                                                            <option value="">-- Chọn lịch --</option>
                                                            @foreach($availableSlots ?? [] as $slot)
                                                                <option value="{{ $slot->Ma_slot }}">{{ date('d/m', strtotime($slot->Ngay)) }} | {{ substr($slot->Gio_bat_dau,0,5) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="w-full py-2 bg-[#F58A3C] text-white text-[12px] font-medium rounded-[10px] hover:bg-[#e07930] hover:shadow-md transition-all">Xác nhận lịch</button>
                                                </form>
                                            </div>
                                        </div>
                                    @elseif($app->Trang_thai === 'cho_phong_van' && $app->interview_slot_id)
                                        <div class="flex items-start gap-2.5 mb-3">
                                            <i data-lucide="calendar-check" class="w-5 h-5 text-blue-500 shrink-0 mt-0.5"></i>
                                            <div>
                                                <h4 class="text-[13px] font-semibold text-blue-700 mb-1">Đã hẹn phỏng vấn</h4>
                                                <p class="text-[11px] text-gray-500 leading-tight font-medium">{{ date('d/m/Y', strtotime($app->interviewSlot->Ngay ?? now())) }} lúc {{ substr($app->interviewSlot->Gio_bat_dau ?? '00:00',0,5) }}</p>
                                            </div>
                                        </div>
                                    @elseif(in_array($app->Trang_thai, ['cho_duyet', 'da_duyet']))
                                        <div class="flex items-start gap-2.5 mb-3">
                                            <i data-lucide="clock" class="w-5 h-5 text-[#F58A3C] shrink-0 mt-0.5"></i>
                                            <div>
                                                <h4 class="text-[13px] font-semibold text-[#1D2B53] mb-1">Đơn đang được xử lý</h4>
                                                <p class="text-[11px] text-gray-500 leading-tight font-medium">Chúng tôi đang xem xét hồ sơ của bạn. Vui lòng chờ trong giây lát.</p>
                                            </div>
                                        </div>
                                    @elseif($app->Trang_thai === 'tu_choi')
                                        <div class="flex items-start gap-2.5 mb-3">
                                            <i data-lucide="x-circle" class="w-5 h-5 text-red-500 shrink-0 mt-0.5"></i>
                                            <div>
                                                <h4 class="text-[13px] font-semibold text-red-700 mb-1">Đã từ chối/Hủy</h4>
                                                <p class="text-[11px] text-gray-500 leading-tight font-medium">Đơn đăng ký không thành công.</p>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <div class="flex flex-wrap items-center justify-center xl:justify-start gap-2 mt-4 pt-3 border-t border-gray-100">
                                        <a href="{{ route('frontend.adoptions.show', $app->Ma_thu_cung) }}" class="inline-block px-4 py-1.5 rounded-[10px] border border-[#F58A3C] text-[#F58A3C] hover:bg-[#F58A3C] hover:text-white text-[11px] font-medium transition-colors">
                                            Xem chi tiết
                                        </a>
                                        @if(in_array($app->Trang_thai, ['cho_duyet', 'cho_xac_nhan_don']))
                                            <form id="cancel-form-{{ $app->Ma_don }}" action="{{ route('frontend.adoptions.cancel', $app->Ma_don) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button" onclick="confirmCancel('{{ $app->Ma_don }}')" class="px-4 py-1.5 rounded-[10px] border border-red-200 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white text-[11px] font-medium transition-colors">
                                                    Hủy đơn
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <i data-lucide="chevron-right" class="w-5 h-5 text-gray-300 group-hover:text-[#F58A3C] transition-colors shrink-0"></i>
                            </div>
                        </div>
                    @empty
                        <div class="bg-gray-50/50 rounded-xl p-12 text-center border border-dashed border-gray-200 flex flex-col items-center">
                            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4 shadow-sm">
                                <i data-lucide="inbox" class="w-8 h-8 text-gray-300"></i>
                            </div>
                            <h3 class="text-[15px] font-medium text-[#1D2B53] mb-2">Chưa có hồ sơ nào</h3>
                            <p class="text-gray-500 text-[13px] mb-6 max-w-sm">Không tìm thấy đơn đăng ký nhận nuôi nào phù hợp với bộ lọc hiện tại.</p>
                            <a href="{{ route('frontend.adoptions.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-[#1D2B53] text-[13px] font-medium rounded-full transition-colors shadow-sm">
                                Xem danh sách thú cưng
                            </a>
                        </div>
                    @endforelse
                </div>
                
                <!-- Pagination Footer -->
                @if($applications->hasPages() || $applications->count() > 0)
                <div class="mt-8 pt-6 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-[12px] text-gray-500 font-medium text-center sm:text-left">
                        Hiển thị {{ $applications->firstItem() ?? 0 }} – {{ $applications->lastItem() ?? 0 }} trong {{ $applications->total() }} kết quả
                    </p>
                    
                    <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-6 w-full sm:w-auto">
                        @if($applications->hasPages())
                            <div class="flex gap-1 overflow-x-auto max-w-full pb-2 sm:pb-0 scrollbar-hide" id="pagination-links">
                                {{ $applications->appends(request()->query())->links('vendor.pagination.tailwind') }}
                            </div>
                        @endif
                        
                        <div class="flex items-center gap-2">
                            <span class="text-[12px] text-gray-500 font-medium">Hiển thị</span>
                            <div class="relative">
                                <select id="per-page-select" data-icon-class="text-gray-400" class="custom-select-trigger text-[12px] font-medium text-[#1D2B53] border border-gray-200 rounded-xl py-1.5 pl-3 outline-none bg-white hover:bg-gray-50 cursor-pointer transition-all shadow-sm">
                                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                </select>
                            </div>
                            <span class="text-[12px] text-gray-500 font-medium">mục/trang</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filter-form');
    const container = document.getElementById('adoption-list-container');
    const searchInput = document.getElementById('search-input');
    const sortSelect = document.getElementById('sort-select');
    const perPageSelect = document.getElementById('per-page-select');
    const resetFilters = document.getElementById('reset-filters');
    
    function fetchResults(url) {
        const loading = document.getElementById('loading-overlay');
        if (loading) loading.classList.remove('hidden');

        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newContainer = doc.getElementById('adoption-list-container');
                if (newContainer && container) {
                    container.innerHTML = newContainer.innerHTML;
                    if (window.lucide) {
                        lucide.createIcons();
                    }
                    bindContainerEvents();
                }
            })
            .catch(err => console.error(err))
            .finally(() => {
                const loadingNow = document.getElementById('loading-overlay');
                if (loadingNow) loadingNow.classList.add('hidden');
            });
    }

    function updateList() {
        const formData = new FormData(filterForm);
        const params = new URLSearchParams(formData);
        const url = `${filterForm.action}?${params.toString()}`;
        
        fetchResults(url);
        window.history.pushState({}, '', url);
    }

    filterForm.addEventListener('change', function(e) {
        if(e.target.name === 'status' || e.target.name === 'time') {
            updateList();
        }
    });

    if(resetFilters) {
        resetFilters.addEventListener('click', function() {
            filterForm.querySelector('select[name="status"]').value = 'all';
            filterForm.querySelector('select[name="time"]').value = 'all';
            filterForm.querySelector('input[name="search"]').value = '';
            if(searchInput) searchInput.value = '';
            updateList();
        });
    }

    let searchTimeout;

    function bindContainerEvents() {
        const currentSortSelect = document.getElementById('sort-select');
        if (currentSortSelect) {
            currentSortSelect.addEventListener('change', function() {
                filterForm.querySelector('input[name="sort"]').value = this.value;
                updateList();
            });
        }

        const currentPerPageSelect = document.getElementById('per-page-select');
        if (currentPerPageSelect) {
            currentPerPageSelect.addEventListener('change', function() {
                filterForm.querySelector('input[name="per_page"]').value = this.value;
                updateList();
            });
        }
        
        const currentSearchInput = document.getElementById('search-input');
        if (currentSearchInput) {
            currentSearchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    filterForm.querySelector('input[name="search"]').value = this.value;
                    updateList();
                }, 500);
            });
        }
        
        if (typeof initCustomSelects === 'function') {
            initCustomSelects();
        }
    }
    
    bindContainerEvents();

    document.addEventListener('click', function(e) {
        const link = e.target.closest('#pagination-links a');
        if (link) {
            e.preventDefault();
            fetchResults(link.href);
            window.history.pushState({}, '', link.href);
            container.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
    
    window.addEventListener('popstate', function() {
        fetchResults(window.location.href);
    });

    document.addEventListener('submit', function(e) {
        if (e.target.classList.contains('ajax-schedule-form')) {
            e.preventDefault();
            const form = e.target;
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<div class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin mx-auto"></div>';
            
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json().catch(() => ({ success: false, message: 'Phản hồi không hợp lệ từ máy chủ.' })))
            .then(data => {
                if(data.success || (data.message && data.message.includes('thành công'))) {
                    Swal.fire({
                        title: 'Thành công!',
                        text: data.message || 'Xác nhận lịch phỏng vấn thành công.',
                        icon: 'success',
                        confirmButtonColor: '#F58A3C',
                        customClass: { popup: 'rounded-2xl', confirmButton: 'rounded-full px-6 py-2.5 text-[13px] font-medium' }
                    }).then(() => {
                        updateList();
                    });
                } else {
                    Swal.fire({
                        title: 'Lỗi', 
                        text: data.message || 'Có lỗi xảy ra', 
                        icon: 'error',
                        customClass: { popup: 'rounded-2xl', confirmButton: 'rounded-full px-6 py-2.5 text-[13px] font-medium bg-red-500' }
                    });
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            })
            .catch(err => {
                console.error(err);
                Swal.fire('Lỗi', 'Có lỗi kết nối, vui lòng thử lại.', 'error');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        }
    });
});

function confirmCancel(appId) {
    Swal.fire({
        title: 'Hủy đơn đăng ký?',
        text: "Bạn có chắc chắn muốn hủy đơn đăng ký nhận nuôi này không? Hành động này không thể hoàn tác.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#94a3b8',
        confirmButtonText: 'Đồng ý, hủy đơn!',
        cancelButtonText: 'Đóng',
        customClass: {
            popup: 'rounded-2xl',
            confirmButton: 'rounded-full px-6 py-2.5 text-[13px] font-medium',
            cancelButton: 'rounded-full px-6 py-2.5 text-[13px] font-medium'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('cancel-form-' + appId).submit();
        }
    });
}

function initCustomSelects() {
    const selects = document.querySelectorAll('select.custom-select-trigger');
    selects.forEach(select => {
        if (select.nextElementSibling && select.nextElementSibling.classList.contains('custom-select-container')) return;
        select.style.display = 'none';
        
        const wrapper = document.createElement('div');
        wrapper.className = 'custom-select-container relative w-full ' + (select.dataset.wrapperClass || '');
        
        const selectedDiv = document.createElement('div');
        selectedDiv.className = select.className.replace('custom-select-trigger', '').replace('hidden', '') + ' flex items-center justify-between cursor-pointer select-none';
        
        const textSpan = document.createElement('span');
        textSpan.className = 'truncate pointer-events-none';
        textSpan.textContent = select.options[select.selectedIndex]?.text || '';
        
        const iconContainer = document.createElement('div');
        iconContainer.className = 'pointer-events-none shrink-0 ml-2';
        iconContainer.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down ${select.dataset.iconClass || 'text-gray-400'}"><path d="m6 9 6 6 6-6"/></svg>`;
        
        selectedDiv.appendChild(textSpan);
        selectedDiv.appendChild(iconContainer);
        wrapper.appendChild(selectedDiv);
        
        const itemsDiv = document.createElement('div');
        itemsDiv.className = 'custom-select-items absolute z-[9999] bg-white border border-gray-100 rounded-[12px] shadow-[0_4px_24px_rgba(0,0,0,0.12)] mt-1.5 w-[calc(100%+8px)] -left-1 max-h-60 overflow-y-auto hidden py-1 opacity-0 transition-opacity duration-200';
        itemsDiv.style.scrollbarWidth = 'thin';
        itemsDiv.style.scrollbarColor = '#cbd5e1 transparent';
        
        const updateOptions = () => {
            itemsDiv.innerHTML = '';
            Array.from(select.options).forEach((option, index) => {
                if (option.disabled && !option.value) return; 
                const item = document.createElement('div');
                item.className = 'px-3 py-2 mx-1 rounded-[8px] cursor-pointer text-[13px] transition-colors flex items-center ' + (option.selected ? 'bg-[#FFF9F5] font-medium text-[#F58A3C]' : 'font-medium text-gray-700 hover:bg-[#FFF9F5] hover:text-[#F58A3C]');
                item.textContent = option.text;
                item.addEventListener('click', function(e) {
                    e.stopPropagation();
                    select.selectedIndex = index;
                    textSpan.textContent = option.text;
                    Array.from(itemsDiv.children).forEach(child => child.className = 'px-3 py-2 mx-1 rounded-[8px] cursor-pointer text-[13px] transition-colors flex items-center font-medium text-gray-700 hover:bg-[#FFF9F5] hover:text-[#F58A3C]');
                    item.className = 'px-3 py-2 mx-1 rounded-[8px] cursor-pointer text-[13px] transition-colors flex items-center bg-[#FFF9F5] font-medium text-[#F58A3C]';
                    closeAllSelects();
                    const event = new Event('change', { bubbles: true });
                    select.dispatchEvent(event);
                });
                itemsDiv.appendChild(item);
            });
        };
        updateOptions();
        
        wrapper.appendChild(itemsDiv);
        select.parentNode.insertBefore(wrapper, select.nextSibling);
        
        selectedDiv.addEventListener('click', function(e) {
            e.stopPropagation();
            const isHidden = itemsDiv.classList.contains('hidden');
            
            closeAllSelects(wrapper); // Close all EXCEPT this one
            
            if (isHidden) {
                const rect = wrapper.getBoundingClientRect();
                const spaceBelow = window.innerHeight - rect.bottom;
                if (spaceBelow < 250 && rect.top > spaceBelow) {
                    itemsDiv.style.bottom = '100%';
                    itemsDiv.style.top = 'auto';
                    itemsDiv.style.marginTop = '0';
                    itemsDiv.style.marginBottom = '6px';
                } else {
                    itemsDiv.style.top = '100%';
                    itemsDiv.style.bottom = 'auto';
                    itemsDiv.style.marginTop = '6px';
                    itemsDiv.style.marginBottom = '0';
                }
                itemsDiv.classList.remove('hidden');
                void itemsDiv.offsetWidth;
                itemsDiv.classList.remove('opacity-0');
                selectedDiv.classList.add('ring-2', 'ring-[#F58A3C]/20', 'border-[#F58A3C]');
            } else {
                itemsDiv.classList.add('opacity-0');
                setTimeout(() => itemsDiv.classList.add('hidden'), 150);
                selectedDiv.classList.remove('ring-2', 'ring-[#F58A3C]/20', 'border-[#F58A3C]');
            }
        });
        select.addEventListener('change', function() {
            textSpan.textContent = select.options[select.selectedIndex]?.text || '';
            updateOptions();
        });
    });
}

function closeAllSelects(exceptWrapper = null) {
    document.querySelectorAll('.custom-select-container').forEach(container => {
        if (exceptWrapper && container === exceptWrapper) return;
        
        const items = container.querySelector('.custom-select-items');
        const trigger = container.querySelector('div:first-child');
        
        if (items && !items.classList.contains('hidden')) {
            items.classList.add('opacity-0');
            setTimeout(() => items.classList.add('hidden'), 150);
        }
        if (trigger) {
            trigger.classList.remove('ring-2', 'ring-[#F58A3C]/20', 'border-[#F58A3C]');
        }
    });
}

document.addEventListener('click', () => closeAllSelects());
document.addEventListener('DOMContentLoaded', initCustomSelects);
</script>
@endsection
