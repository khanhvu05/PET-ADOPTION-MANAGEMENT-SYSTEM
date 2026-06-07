@extends('layouts.frontend')

@section('title', 'Lịch Sử Nhận Nuôi')

@section('content')
<div class="pt-28 pb-20 px-4 md:px-6 lg:px-16 max-w-7xl mx-auto min-h-screen">
    <!-- Breadcrumb & Header -->
    <div class="mb-10">
        <nav class="flex text-sm text-gray-500 mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2">
                <li><a href="/" class="hover:text-primary transition-colors">Trang chủ</a></li>
                <li><span class="mx-2 text-gray-400">/</span></li>
                <li><span class="text-gray-900 font-medium">Tài khoản</span></li>
                <li><span class="mx-2 text-gray-400">/</span></li>
                <li class="text-primary font-bold" aria-current="page">Lịch sử nhận nuôi</li>
            </ol>
        </nav>
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black text-dark tracking-tight mb-2">Lịch Sử Nhận Nuôi</h1>
                <p class="text-gray-600">Theo dõi trạng thái các hồ sơ xin nhận nuôi thú cưng của bạn.</p>
            </div>
            
            <a href="{{ route('frontend.adoptions.index') }}" class="btn-primary">
                <i data-lucide="search" class="w-4 h-4"></i>
                Tìm thêm thú cưng
            </a>
        </div>
    </div>

    @if($applications->isEmpty())
        <div class="bg-white rounded-3xl p-10 text-center border border-gray-100 shadow-sm flex flex-col items-center justify-center">
            <div class="w-24 h-24 bg-orange-50 rounded-full flex items-center justify-center mb-6">
                <i data-lucide="clipboard-list" class="w-12 h-12 text-primary"></i>
            </div>
            <h3 class="text-xl font-bold text-dark mb-2">Chưa có hồ sơ nào</h3>
            <p class="text-gray-500 mb-8 max-w-md">Bạn chưa gửi bất kỳ yêu cầu nhận nuôi thú cưng nào. Hãy dạo một vòng xem có bé nào hợp duyên với bạn không nhé!</p>
            <a href="{{ route('frontend.adoptions.index') }}" class="btn-primary">Xem danh sách thú cưng</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($applications as $app)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] overflow-hidden transition-transform duration-300 hover:-translate-y-1">
                    <div class="p-5 flex gap-4">
                        <div class="w-24 h-24 rounded-xl overflow-hidden shrink-0 bg-gray-50 relative">
                            @if($app->thuCung && $app->thuCung->AnhUrl)
                                <img src="{{ $app->thuCung->AnhUrl }}" class="w-full h-full object-cover" alt="{{ $app->thuCung->Ten }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <i data-lucide="image-off" class="w-8 h-8"></i>
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex-1 min-w-0 flex flex-col justify-center">
                            <h3 class="text-lg font-black text-dark truncate mb-1">
                                {{ $app->thuCung ? $app->thuCung->Ten : 'Thú cưng đã bị xóa' }}
                            </h3>
                            <p class="text-xs text-gray-500 font-medium mb-3">Mã đơn: <span class="font-mono text-gray-700">{{ substr($app->Ma_don, 0, 8) }}</span></p>
                            
                            <div>
                                @php
                                    $statusClasses = [
                                        'cho_duyet'         => 'bg-amber-50 text-amber-600 border-amber-200',
                                        'cho_xac_nhan_don'  => 'bg-green-50 text-green-600 border-green-200',
                                        'cho_phong_van'     => 'bg-blue-50 text-blue-600 border-blue-200',
                                        'da_duyet'          => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                                        'tu_choi'           => 'bg-red-50 text-red-600 border-red-200',
                                        'hoan_thanh'        => 'bg-purple-50 text-purple-600 border-purple-200',
                                    ];
                                    $statusClass = $statusClasses[$app->Trang_thai] ?? 'bg-gray-100 text-gray-600 border-gray-200';
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold border {{ $statusClass }}">
                                    @if($app->Trang_thai === 'cho_duyet')
                                        <i data-lucide="clock" class="w-3 h-3 mr-1"></i>
                                    @elseif(in_array($app->Trang_thai, ['cho_xac_nhan_don', 'da_duyet', 'hoan_thanh']))
                                        <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i>
                                    @elseif($app->Trang_thai === 'tu_choi')
                                        <i data-lucide="x-circle" class="w-3 h-3 mr-1"></i>
                                    @else
                                        <i data-lucide="info" class="w-3 h-3 mr-1"></i>
                                    @endif
                                    {{ $app->trang_thai_label }}
                                </span>
                            </div>
                            
                            @if($app->Trang_thai === 'cho_xac_nhan_don' && !$app->interview_slot_id)
                                @if($app->han_xac_nhan_phong_van && now()->greaterThan($app->han_xac_nhan_phong_van))
                                    <div class="mt-3 p-2 bg-red-50 rounded-lg border border-red-100 text-xs text-red-600 font-medium">
                                        Đã quá hạn xác nhận lịch phỏng vấn.
                                    </div>
                                @else
                                    <div class="mt-3 p-3 bg-orange-50 rounded-lg border border-orange-200">
                                        <p class="text-[11px] font-bold text-red-600 mb-2">Vui lòng chọn lịch phỏng vấn đón bé trước {{ $app->han_xac_nhan_phong_van->format('H:i d/m/Y') }}</p>
                                        <form action="{{ route('frontend.user.adoptions.schedule-interview', $app->Ma_don) }}" method="POST">
                                            @csrf
                                            <select name="interview_slot_id" class="w-full text-xs border-gray-300 rounded-md shadow-sm mb-2" required>
                                                <option value="">-- Chọn lịch trống --</option>
                                                @foreach($availableSlots as $slot)
                                                    <option value="{{ $slot->Ma_slot }}">{{ date('d/m/Y', strtotime($slot->Ngay)) }} | {{ $slot->formatted_time }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="w-full py-1.5 bg-primary text-white text-xs font-bold rounded-md hover:bg-orange-600 transition-colors">Xác nhận lịch</button>
                                        </form>
                                    </div>
                                @endif
                            @elseif($app->interview_slot_id)
                                <div class="mt-3 p-2 bg-teal-50 rounded-lg border border-teal-100 text-[11px] text-teal-800 font-medium">
                                    <i data-lucide="calendar-check" class="w-3 h-3 inline mr-1"></i>
                                    Lịch phỏng vấn: {{ $app->interviewSlot->formatted_time ?? '' }} ngày {{ $app->interviewSlot ? date('d/m/Y', strtotime($app->interviewSlot->Ngay)) : '' }}
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="px-5 py-4 bg-gray-50/50 border-t border-gray-50 flex justify-between items-center">
                        <span class="text-xs font-medium text-gray-500">
                            Ngày gửi: <span class="text-gray-800">{{ $app->Ngay_tao->format('d/m/Y H:i') }}</span>
                        </span>
                        
                        <div class="flex items-center gap-3">
                            @if(in_array($app->Trang_thai, ['cho_duyet', 'cho_xac_nhan_don']))
                                <form id="cancel-form-{{ $app->Ma_don }}" action="{{ route('frontend.adoptions.cancel', $app->Ma_don) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="button" onclick="confirmCancel('{{ $app->Ma_don }}')" class="text-red-500 text-sm font-bold hover:underline">Hủy đơn</button>
                                </form>
                            @endif
                            <a href="{{ route('frontend.adoptions.show', $app->Ma_thu_cung) }}" class="text-primary text-sm font-bold hover:underline">
                                Xem thú cưng &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-8">
            {{ $applications->links() }}
        </div>
    @endif
</div>

@section('scripts')
<script>
    function confirmCancel(appId) {
        Swal.fire({
            title: 'Hủy đơn đăng ký?',
            text: "Bạn có chắc chắn muốn hủy đơn đăng ký nhận nuôi này không? Hành động này không thể hoàn tác.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6e7881',
            confirmButtonText: 'Đồng ý, hủy đơn!',
            cancelButtonText: 'Đóng',
            customClass: {
                popup: 'rounded-[20px]',
                confirmButton: 'rounded-[10px] px-6 py-2.5 font-bold',
                cancelButton: 'rounded-[10px] px-6 py-2.5 font-bold'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('cancel-form-' + appId).submit();
            }
        });
    }
</script>
@endsection
@endsection
