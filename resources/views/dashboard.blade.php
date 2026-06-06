<x-admin-layout>
    @section('title', 'Tổng Quan')

    <!-- Main Content Area -->
    <div class="space-y-6">
        
        <!-- Metrics Grid (4 columns) -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
            <!-- Metric Card 1 -->
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm relative overflow-hidden group">
                <div class="flex justify-between items-start mb-4 relative z-10">
                    <div>
                        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Tổng Thú Cưng</p>
                        <h3 class="text-2xl font-black text-slate-900 tracking-tight">{{ number_format($totalPets) }}</h3>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-orange-brand/10 group-hover:text-orange-brand transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path></svg>
                    </div>
                </div>
                <div class="flex items-center text-xs font-semibold relative z-10">
                    <span class="{{ $petsPercent > 0 ? 'text-emerald-600' : 'text-slate-500' }} flex items-center gap-1 bg-white px-2 py-0.5 rounded-md border border-slate-100 shadow-sm">
                        {{ $availablePets }} sẵn sàng
                    </span>
                    <span class="text-slate-400 ml-2 font-medium truncate">/ tổng số</span>
                </div>
            </div>

            <!-- Metric Card 2 -->
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm relative overflow-hidden group">
                <div class="flex justify-between items-start mb-4 relative z-10">
                    <div>
                        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Đơn Nhận Nuôi</p>
                        <h3 class="text-2xl font-black text-slate-900 tracking-tight">{{ number_format($totalAdoptions) }}</h3>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-orange-brand/10 group-hover:text-orange-brand transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                </div>
                <div class="flex items-center text-xs font-semibold relative z-10">
                    <span class="{{ $pendingAdoptions > 0 ? 'text-amber-600' : 'text-slate-500' }} flex items-center gap-1 bg-white px-2 py-0.5 rounded-md border border-slate-100 shadow-sm">
                        {{ $pendingAdoptions }} chờ duyệt
                    </span>
                    <span class="text-slate-400 ml-2 font-medium truncate">/ tổng số</span>
                </div>
            </div>

            <!-- Metric Card 3 -->
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm relative overflow-hidden group">
                <div class="flex justify-between items-start mb-4 relative z-10">
                    <div>
                        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Tổng Quyên Góp</p>
                        <h3 class="text-2xl font-black text-slate-900 tracking-tight">{{ number_format($totalDonations, 0, ',', '.') }}đ</h3>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-orange-brand/10 group-hover:text-orange-brand transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div class="flex items-center text-xs font-semibold relative z-10">
                    <span class="text-emerald-600 flex items-center gap-1 bg-white px-2 py-0.5 rounded-md border border-slate-100 shadow-sm">
                        + {{ number_format($thisMonthDonations, 0, ',', '.') }}đ
                    </span>
                    <span class="text-slate-400 ml-2 font-medium truncate">tháng này</span>
                </div>
            </div>

            <!-- Metric Card 4 -->
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm relative overflow-hidden group">
                <div class="flex justify-between items-start mb-4 relative z-10">
                    <div>
                        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Người Dùng</p>
                        <h3 class="text-2xl font-black text-slate-900 tracking-tight">{{ number_format($totalUsers) }}</h3>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-orange-brand/10 group-hover:text-orange-brand transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
                <div class="flex items-center text-xs font-semibold relative z-10">
                    <span class="text-emerald-600 flex items-center gap-1 bg-white px-2 py-0.5 rounded-md border border-slate-100 shadow-sm">
                        + {{ number_format($recentUsers) }} 
                    </span>
                    <span class="text-slate-400 ml-2 font-medium truncate">tháng này</span>
                </div>
            </div>
        </div>

        <!-- Charts Section (12 columns) -->
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">
            <!-- Main Chart: Sales Trend -->
            <div class="lg:col-span-8 bg-white border border-slate-200 rounded-xl p-6 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-base font-semibold text-slate-900">Thống Kê Nhận Nuôi (6 Tháng)</h3>
                </div>
                
                <!-- Chart Area -->
                <div class="relative w-full h-[280px] mt-4">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <!-- Secondary Chart: Revenue Breakdown -->
            <div class="lg:col-span-4 bg-white border border-slate-200 rounded-xl p-6 shadow-sm flex flex-col">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-base font-semibold text-slate-900">Phân Bố Giống Loài</h3>
                </div>
                
                <div class="flex-1 flex flex-col justify-center mb-6">
                    <!-- Doughnut Chart Area -->
                    <div class="relative w-full h-[200px] flex items-center justify-center">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <!-- Insight Bar -->
                <div class="mt-auto bg-slate-50 border border-slate-200 rounded-lg p-3 flex items-center gap-3">
                    <svg class="w-4 h-4 text-orange-brand shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-[11px] text-slate-600 font-medium leading-tight">Biểu đồ thể hiện tỷ lệ số lượng thú cưng theo giống loài hiện có trong hệ thống.</span>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
            <!-- Table Header -->
            <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <h3 class="text-base font-semibold text-slate-900">Đơn Nhận Nuôi Gần Đây</h3>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.adoptions.index') }}" class="bg-orange-brand text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-orange-500 hover:shadow-md hover:-translate-y-0.5 transition-all shadow-sm shrink-0">
                        Xem Tất Cả
                    </a>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="py-3 px-5 border-b border-slate-100 text-[10px] font-bold uppercase tracking-widest text-slate-500">Mã Đơn</th>
                            <th class="py-3 px-5 border-b border-slate-100 text-[10px] font-bold uppercase tracking-widest text-slate-500">Người Đăng Ký</th>
                            <th class="py-3 px-5 border-b border-slate-100 text-[10px] font-bold uppercase tracking-widest text-slate-500">Thú Cưng</th>
                            <th class="py-3 px-5 border-b border-slate-100 text-[10px] font-bold uppercase tracking-widest text-slate-500">Trạng Thái</th>
                            <th class="py-3 px-5 border-b border-slate-100 text-[10px] font-bold uppercase tracking-widest text-slate-500">Ngày Đăng Ký</th>
                            <th class="py-3 px-5 border-b border-slate-100 w-12"></th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($recentApplications as $app)
                        <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors group">
                            <td class="py-3 px-5 font-mono text-slate-500 text-xs">#{{ substr($app->Ma_don, 0, 8) }}</td>
                            <td class="py-3 px-5 font-medium text-slate-900">{{ $app->nguoiDung->Ho_ten ?? 'N/A' }}</td>
                            <td class="py-3 px-5 text-slate-500">{{ $app->thuCung->Ten ?? 'N/A' }}</td>
                            <td class="py-3 px-5">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-amber-500/10 text-amber-600 border-amber-500/20 dot-amber-500',
                                        'approved' => 'bg-green-500/10 text-green-600 border-green-500/20 dot-green-500',
                                        'rejected' => 'bg-red-500/10 text-red-600 border-red-500/20 dot-red-500',
                                        'cancelled' => 'bg-slate-500/10 text-slate-600 border-slate-500/20 dot-slate-500',
                                        'cho_phong_van' => 'bg-blue-500/10 text-blue-600 border-blue-500/20 dot-blue-500',
                                        'hoan_thanh' => 'bg-emerald-500/10 text-emerald-600 border-emerald-500/20 dot-emerald-500',
                                    ];
                                    $colorClass = $statusColors[$app->Trang_thai] ?? 'bg-slate-500/10 text-slate-600 border-slate-500/20 dot-slate-500';
                                    $parts = explode(' dot-', $colorClass);
                                    $badgeColor = $parts[0];
                                    $dotColor = 'bg-' . ($parts[1] ?? 'slate-500');

                                    $statusLabels = [
                                        'pending' => 'Chờ duyệt',
                                        'approved' => 'Đã duyệt',
                                        'rejected' => 'Từ chối',
                                        'cancelled' => 'Đã hủy',
                                        'cho_phong_van' => 'Chờ phỏng vấn',
                                        'hoan_thanh' => 'Hoàn thành'
                                    ];
                                    $label = $statusLabels[$app->Trang_thai] ?? $app->Trang_thai;
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide border {{ $badgeColor }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $dotColor }}"></span>
                                    {{ $label }}
                                </span>
                            </td>
                            <td class="py-3 px-5 font-medium text-slate-900">{{ $app->Ngay_tao->format('d/m/Y') }}</td>
                            <td class="py-3 px-5">
                                <a href="{{ route('admin.adoptions.show', $app->Ma_don) }}" class="text-slate-400 hover:text-slate-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-500">Không có đơn nhận nuôi nào gần đây.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($recentApplications->count() >= 5)
            <div class="px-5 py-3 border-t border-slate-100 flex items-center justify-center text-xs text-slate-500">
                <a href="{{ route('admin.adoptions.index') }}" class="px-3 py-1.5 text-orange-brand font-medium hover:underline transition-colors">Xem toàn bộ danh sách</a>
            </div>
            @endif
        </div>

    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof Chart === 'undefined') {
                console.error('Chart.js is not loaded.');
                return;
            }

            // Data passed from controller
            let chartLabels = {!! json_encode($chartLabels) !!};
            let adoptionsData = {!! json_encode($adoptionsTrendData) !!};
            let petBreakdownData = {!! json_encode($petBreakdownData) !!};

            // Chart Defaults for Premium Look
            Chart.defaults.font.family = "'General Sans', 'Nunito', ui-sans-serif, system-ui, sans-serif";
            Chart.defaults.color = '#64748b'; // slate-500
            
            // 1. Sales Trend Chart (Mixed Bar & Line)
            const salesCtx = document.getElementById('salesChart').getContext('2d');

            new Chart(salesCtx, {
                type: 'bar',
                data: {
                    labels: chartLabels,
                    datasets: [
                        {
                            type: 'line',
                            label: 'Xu hướng',
                            data: adoptionsData,
                            borderColor: '#3f899a', // sidebar-blue
                            borderWidth: 2,
                            borderDash: [5, 5],
                            tension: 0.3, // Smooth curves
                            pointBackgroundColor: '#fff',
                            pointBorderColor: '#3f899a',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            fill: false,
                            order: 1
                        },
                        {
                            type: 'bar',
                            label: 'Đơn nhận nuôi',
                            data: adoptionsData,
                            backgroundColor: 'rgba(232, 130, 42, 0.6)', // Richer orange as requested
                            hoverBackgroundColor: '#e8822a', // Solid brand orange on hover
                            borderRadius: 6,
                            barPercentage: 0.4,
                            order: 2
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(30, 41, 59, 0.95)',
                            padding: 12,
                            titleFont: { size: 13, family: "'General Sans', sans-serif" },
                            bodyFont: { size: 14, weight: 'bold', family: "'General Sans', sans-serif" },
                            displayColors: false,
                            filter: function(tooltipItem) {
                                // Only show tooltip for the bar dataset so we don't duplicate identical values
                                return tooltipItem.datasetIndex === 1;
                            },
                            callbacks: {
                                label: function(context) {
                                    return 'Số đơn: ' + context.parsed.y;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(226, 232, 240, 0.5)', // slate-200/50
                                drawBorder: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                precision: 0,
                                padding: 10
                            },
                            border: { display: false }
                        },
                        x: {
                            grid: { display: false },
                            ticks: {
                                font: { size: 10, weight: 'bold' },
                                color: function(context) {
                                    return context.index === 5 ? '#e8822a' : '#64748b'; // Highlight current month
                                }
                            },
                            border: { display: false }
                        }
                    }
                }
            });

            // 2. Revenue Breakdown Chart (Doughnut)
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            new Chart(revenueCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Chó', 'Mèo', 'Khác'],
                    datasets: [{
                        data: petBreakdownData,
                        backgroundColor: [
                            '#e8822a', 
                            'rgba(232, 130, 42, 0.7)',
                            'rgba(232, 130, 42, 0.4)'
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 20,
                                font: { size: 11, weight: '500' }
                            }
                        },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            padding: 10,
                            bodyFont: { size: 13, weight: 'bold' },
                            callbacks: {
                                label: function(context) {
                                    return ' ' + context.label + ': ' + context.parsed + ' thú cưng';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-admin-layout>
