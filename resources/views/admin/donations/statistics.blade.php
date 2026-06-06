<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Tổng Quan
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('admin.donations.index') }}" class="hover:text-teal-600 transition-colors text-slate-500">Quyên Góp</a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-slate-700 font-bold">Thống Kê</span>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6 lg:space-y-8">

        <!-- Header Row -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-slate-900 tracking-tight">Thống Kê Quyên Góp</h1>
                <p class="text-sm text-slate-500 mt-1">Tổng quan toàn bộ hoạt động quyên góp của hệ thống</p>
            </div>
            <!-- Year Filter -->
            <form method="GET" action="{{ route('admin.donations.statistics') }}" class="flex items-center gap-3">
                <label class="text-sm font-semibold text-slate-600">Năm:</label>
                <select name="year" onchange="this.form.submit()" class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 shadow-sm focus:ring-2 focus:ring-teal-400 focus:border-teal-400 outline-none">
                    @foreach($availableYears as $y)
                        <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <!-- KPI Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
            <!-- Total Amount -->
            <div class="bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl p-5 lg:p-6 shadow-lg shadow-teal-200/50 text-white">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <p class="text-teal-100 text-[12px] font-bold uppercase tracking-wider mb-1">Tổng Quyên Góp</p>
                <p class="text-2xl font-black tracking-tight">{{ number_format($totalAmount, 0, ',', '.') }}đ</p>
            </div>

            <!-- Total Transactions -->
            <div class="bg-white border border-slate-200 rounded-2xl p-5 lg:p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                </div>
                <p class="text-slate-500 text-[12px] font-bold uppercase tracking-wider mb-1">Giao Dịch Thành Công</p>
                <p class="text-2xl font-black text-slate-900">{{ number_format($totalTx) }}</p>
            </div>

            <!-- Unique Donors -->
            <div class="bg-white border border-slate-200 rounded-2xl p-5 lg:p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                </div>
                <p class="text-slate-500 text-[12px] font-bold uppercase tracking-wider mb-1">Nhà Hảo Tâm</p>
                <p class="text-2xl font-black text-slate-900">{{ number_format($uniqueDonors) }}</p>
            </div>

            <!-- Average Amount -->
            <div class="bg-white border border-slate-200 rounded-2xl p-5 lg:p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                </div>
                <p class="text-slate-500 text-[12px] font-bold uppercase tracking-wider mb-1">Trung Bình/GD</p>
                <p class="text-2xl font-black text-slate-900">{{ number_format($avgAmount, 0, ',', '.') }}đ</p>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Monthly Line Chart (2/3 width) -->
            <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-base font-bold text-slate-800">Xu Hướng Theo Tháng</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Năm {{ $year }} — Đơn vị: VNĐ</p>
                    </div>
                </div>
                <canvas id="monthlyChart" height="120"></canvas>
            </div>

            <!-- Campaign Doughnut Chart (1/3 width) -->
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <h3 class="text-base font-bold text-slate-800 mb-1">Phân Bổ Chiến Dịch</h3>
                <p class="text-xs text-slate-400 mb-5">Tỷ trọng theo số tiền</p>
                @if(!empty($campaignTotals))
                    <canvas id="campaignChart" height="200"></canvas>
                @else
                    <div class="flex items-center justify-center h-48 text-slate-400 text-sm">Chưa có dữ liệu</div>
                @endif
            </div>
        </div>

        <!-- Bottom Row: Top Donors + Stats Table -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Top Donors -->
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <h3 class="text-base font-bold text-slate-800 mb-5">🏆 Top Nhà Hảo Tâm</h3>
                <div class="space-y-4">
                    @forelse($topDonors as $index => $donor)
                        <div class="flex items-center gap-4">
                            <div class="w-8 h-8 rounded-xl font-black text-sm flex items-center justify-center shrink-0
                                {{ $index === 0 ? 'bg-amber-100 text-amber-600' : ($index === 1 ? 'bg-slate-100 text-slate-600' : ($index === 2 ? 'bg-orange-100 text-orange-600' : 'bg-gray-50 text-gray-400')) }}">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-slate-800 text-sm truncate">
                                    @if($donor->An_danh)
                                        <span class="text-gray-400 italic">Ẩn danh</span>
                                    @else
                                        {{ $donor->Ten_nguoi_ung_ho }}
                                    @endif
                                </p>
                                <p class="text-xs text-slate-400">{{ $donor->count }} giao dịch</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-teal-600 text-sm">{{ number_format($donor->total, 0, ',', '.') }}đ</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-400 text-sm text-center py-8">Chưa có dữ liệu</p>
                    @endforelse
                </div>
            </div>

            <!-- Monthly Stats Table -->
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <h3 class="text-base font-bold text-slate-800 mb-5">📊 Chi Tiết Theo Tháng ({{ $year }})</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-slate-100">
                                <th class="text-left py-2 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Tháng</th>
                                <th class="text-right py-2 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Số GD</th>
                                <th class="text-right py-2 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach($monthlyLabels as $idx => $label)
                                <tr class="{{ $monthlyTotals[$idx] > 0 ? 'bg-teal-50/30' : '' }}">
                                    <td class="py-2.5 text-[13px] font-semibold text-slate-700">{{ $label }}</td>
                                    <td class="py-2.5 text-right text-[13px] font-bold {{ $monthlyCounts[$idx] > 0 ? 'text-slate-700' : 'text-slate-300' }}">
                                        {{ $monthlyCounts[$idx] > 0 ? $monthlyCounts[$idx] : '—' }}
                                    </td>
                                    <td class="py-2.5 text-right text-[13px] font-bold {{ $monthlyTotals[$idx] > 0 ? 'text-teal-700' : 'text-slate-300' }}">
                                        {{ $monthlyTotals[$idx] > 0 ? number_format($monthlyTotals[$idx], 0, ',', '.') . 'đ' : '—' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // ── Monthly Line Chart ──────────────────────────────
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyGradient = monthlyCtx.createLinearGradient(0, 0, 0, 300);
        monthlyGradient.addColorStop(0, 'rgba(20, 184, 166, 0.25)');
        monthlyGradient.addColorStop(1, 'rgba(20, 184, 166, 0)');

        new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: @json($monthlyLabels),
                datasets: [{
                    label: 'Số tiền (đ)',
                    data: @json($monthlyTotals),
                    borderColor: '#14b8a6',
                    backgroundColor: monthlyGradient,
                    borderWidth: 2.5,
                    pointBackgroundColor: '#14b8a6',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.4,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => ' ' + new Intl.NumberFormat('vi-VN').format(ctx.parsed.y) + 'đ'
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 11, weight: '600' }, color: '#94a3b8' }
                    },
                    y: {
                        grid: { color: '#f1f5f9' },
                        ticks: {
                            font: { size: 10 },
                            color: '#94a3b8',
                            callback: v => v > 0 ? (v / 1000000).toFixed(1) + 'M' : '0'
                        }
                    }
                }
            }
        });

        // ── Campaign Doughnut Chart ──────────────────────────
        @if(!empty($campaignTotals))
        const campaignCtx = document.getElementById('campaignChart').getContext('2d');
        new Chart(campaignCtx, {
            type: 'doughnut',
            data: {
                labels: @json($campaignLabels),
                datasets: [{
                    data: @json($campaignTotals),
                    backgroundColor: [
                        '#14b8a6', '#f59e0b', '#6366f1', '#ec4899', '#10b981', '#f97316'
                    ],
                    borderWidth: 3,
                    borderColor: '#fff',
                    hoverBorderWidth: 0
                }]
            },
            options: {
                responsive: true,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: 10, weight: '600' },
                            color: '#64748b',
                            padding: 12,
                            usePointStyle: true,
                            pointStyleWidth: 8
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: ctx => ' ' + new Intl.NumberFormat('vi-VN').format(ctx.parsed) + 'đ'
                        }
                    }
                }
            }
        });
        @endif
    </script>
    @endpush
</x-admin-layout>
