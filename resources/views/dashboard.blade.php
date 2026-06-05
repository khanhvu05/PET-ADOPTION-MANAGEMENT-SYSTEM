<x-admin-layout>
    @section('title', 'Tổng Quan')

    <!-- Main Content Area -->
    <div class="space-y-6">
        
        <!-- Metrics Grid (4 columns) -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
            <!-- Metric Card 1 -->
            <x-admin.kpi-card 
                title="Tổng Doanh Thu" 
                value="124,500" 
                percent="12.5" 
            />

            <!-- Metric Card 2 -->
            <x-admin.kpi-card 
                title="Khách Hàng Hoạt Động" 
                value="1,432" 
                percent="4.2" 
            />

            <!-- Metric Card 3 -->
            <x-admin.kpi-card 
                title="Đăng Ký Mới" 
                value="384" 
                percent="-2.4" 
            />

            <!-- Metric Card 4 -->
            <x-admin.kpi-card 
                title="Tỷ Lệ Chuyển Đổi" 
                value="3.8%" 
                percent="1.1" 
            />
        </div>

        <!-- Charts Section (12 columns) -->
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">
            <!-- Main Chart: Sales Trend -->
            <div class="lg:col-span-8 bg-white border border-slate-200 rounded-xl p-6 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-base font-semibold text-slate-900">Sales Trend</h3>
                    <div x-data="{ open: false, selected: 'Last 6 Months', options: ['Last 6 Months', 'This Year'] }" class="relative w-[130px]">
                        <button @click="open = !open" @click.away="open = false" 
                                class="w-full flex items-center justify-between text-xs font-semibold text-slate-700 bg-slate-50/50 border border-slate-200/80 rounded-[10px] px-3 py-1.5 hover:bg-slate-100 transition-all focus:outline-none focus:border-orange-brand focus:ring-2 focus:ring-orange-brand/20 cursor-pointer shadow-sm">
                            <span x-text="selected"></span>
                            <svg class="w-3.5 h-3.5 text-slate-500 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-1 w-full bg-white border border-slate-200 rounded-xl shadow-lg overflow-hidden z-20 py-1"
                             style="display: none;">
                            <template x-for="option in options" :key="option">
                                <button @click="selected = option; open = false" 
                                        class="w-full text-left px-3 py-2 text-xs font-medium transition-colors"
                                        :class="selected === option ? 'bg-orange-brand/10 text-orange-brand' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'">
                                    <span x-text="option"></span>
                                </button>
                            </template>
                        </div>
                    </div>
                </div>
                
                <!-- Chart Area -->
                <div class="relative w-full h-[280px] mt-4">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <!-- Secondary Chart: Revenue Breakdown -->
            <div class="lg:col-span-4 bg-white border border-slate-200 rounded-xl p-6 shadow-sm flex flex-col">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-base font-semibold text-slate-900">Revenue Breakdown</h3>
                </div>
                
                <div class="flex-1 flex flex-col justify-center mb-6">
                    <!-- Doughnut Chart Area -->
                    <div class="relative w-full h-[200px] flex items-center justify-center">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <!-- AI Insight Bar -->
                <div class="mt-auto bg-slate-50 border border-slate-200 rounded-lg p-3 flex items-center gap-3">
                    <svg class="w-4 h-4 text-orange-brand shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    <span class="text-[11px] text-slate-600 font-medium leading-tight">Subscriptions are trending 15% higher this week. Consider promoting yearly plans.</span>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
            <!-- Table Header -->
            <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <h3 class="text-base font-semibold text-slate-900">Recent Transactions</h3>
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" placeholder="Search orders..." class="w-full sm:w-64 pl-9 pr-4 py-2 bg-slate-50/50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-orange-brand focus:ring-4 focus:ring-orange-brand/10 focus:bg-white transition-all shadow-sm">
                    </div>
                    <button class="bg-orange-brand text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-orange-500 hover:shadow-md hover:-translate-y-0.5 transition-all shadow-sm shrink-0">
                        Add Transaction
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="py-3 px-5 border-b border-slate-100 w-12">
                                <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-orange-brand shadow-sm focus:ring-orange-brand focus:ring-2 focus:ring-offset-1 transition-all cursor-pointer bg-slate-50 hover:bg-slate-100 hover:border-orange-brand/50">
                            </th>
                            <th class="py-3 px-5 border-b border-slate-100 text-[10px] font-bold uppercase tracking-widest text-slate-500">ID</th>
                            <th class="py-3 px-5 border-b border-slate-100 text-[10px] font-bold uppercase tracking-widest text-slate-500">Customer</th>
                            <th class="py-3 px-5 border-b border-slate-100 text-[10px] font-bold uppercase tracking-widest text-slate-500">Product</th>
                            <th class="py-3 px-5 border-b border-slate-100 text-[10px] font-bold uppercase tracking-widest text-slate-500">Status</th>
                            <th class="py-3 px-5 border-b border-slate-100 text-[10px] font-bold uppercase tracking-widest text-slate-500">Total</th>
                            <th class="py-3 px-5 border-b border-slate-100 w-12"></th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <!-- Row 1 -->
                        <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors group">
                            <td class="py-3 px-5">
                                <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-orange-brand shadow-sm focus:ring-orange-brand focus:ring-2 focus:ring-offset-1 transition-all cursor-pointer bg-slate-50 hover:bg-slate-100 hover:border-orange-brand/50">
                            </td>
                            <td class="py-3 px-5 font-mono text-slate-500 text-xs">#TRX-8492</td>
                            <td class="py-3 px-5 font-medium text-slate-900">Acme Corp</td>
                            <td class="py-3 px-5 text-slate-500">Enterprise License</td>
                            <td class="py-3 px-5">
                                <!-- Success Badge Pill -->
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide bg-green-500/10 text-green-600 border border-green-500/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                    Success
                                </span>
                            </td>
                            <td class="py-3 px-5 font-medium text-slate-900">$2,400.00</td>
                            <td class="py-3 px-5">
                                <button class="text-slate-400 hover:text-slate-600 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                </button>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors group">
                            <td class="py-3 px-5">
                                <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-orange-brand shadow-sm focus:ring-orange-brand focus:ring-2 focus:ring-offset-1 transition-all cursor-pointer bg-slate-50 hover:bg-slate-100 hover:border-orange-brand/50">
                            </td>
                            <td class="py-3 px-5 font-mono text-slate-500 text-xs">#TRX-8491</td>
                            <td class="py-3 px-5 font-medium text-slate-900">Globex Inc</td>
                            <td class="py-3 px-5 text-slate-500">Pro Plan (Yearly)</td>
                            <td class="py-3 px-5">
                                <!-- Pending Badge Pill -->
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide bg-amber-500/10 text-amber-600 border border-amber-500/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    Pending
                                </span>
                            </td>
                            <td class="py-3 px-5 font-medium text-slate-900">$990.00</td>
                            <td class="py-3 px-5">
                                <button class="text-slate-400 hover:text-slate-600 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                </button>
                            </td>
                        </tr>

                        <!-- Row 3 -->
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="py-3 px-5">
                                <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-orange-brand shadow-sm focus:ring-orange-brand focus:ring-2 focus:ring-offset-1 transition-all cursor-pointer bg-slate-50 hover:bg-slate-100 hover:border-orange-brand/50">
                            </td>
                            <td class="py-3 px-5 font-mono text-slate-500 text-xs">#TRX-8490</td>
                            <td class="py-3 px-5 font-medium text-slate-900">Soylent Corp</td>
                            <td class="py-3 px-5 text-slate-500">Starter Plan (Monthly)</td>
                            <td class="py-3 px-5">
                                <!-- Refunded Badge Pill -->
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide bg-red-500/10 text-red-600 border border-red-500/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                    Refunded
                                </span>
                            </td>
                            <td class="py-3 px-5 font-medium text-slate-900">-$49.00</td>
                            <td class="py-3 px-5">
                                <button class="text-slate-400 hover:text-slate-600 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Table Footer / Pagination mock -->
            <div class="px-5 py-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Showing 1 to 3 of 12 entries</span>
                <div class="flex gap-1.5">
                    <button class="px-3 py-1.5 border border-slate-200 rounded-md hover:bg-slate-50 hover:border-slate-300 text-slate-600 font-medium transition-colors shadow-sm">Prev</button>
                    <button class="px-3 py-1.5 border border-slate-200 rounded-md hover:bg-slate-50 hover:border-slate-300 text-slate-600 font-medium transition-colors shadow-sm">Next</button>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof Chart === 'undefined') {
                console.error('Chart.js is not loaded.');
                return;
            }

            // Chart Defaults for Premium Look
            Chart.defaults.font.family = "'General Sans', 'Nunito', ui-sans-serif, system-ui, sans-serif";
            Chart.defaults.color = '#64748b'; // slate-500
            
            // 1. Sales Trend Chart (Mixed Bar & Line)
            const salesCtx = document.getElementById('salesChart').getContext('2d');

            new Chart(salesCtx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [
                        {
                            type: 'line',
                            label: 'Trend',
                            data: [14000, 22000, 16000, 28000, 32000, 19000],
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
                            label: 'Sales',
                            data: [14000, 22000, 16000, 28000, 32000, 19000],
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
                                    return 'Sales: $' + context.parsed.y.toLocaleString();
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
                                callback: function(value) {
                                    return '$' + (value / 1000) + 'k';
                                },
                                padding: 10
                            },
                            border: { display: false }
                        },
                        x: {
                            grid: { display: false },
                            ticks: {
                                font: { size: 10, weight: 'bold' },
                                color: function(context) {
                                    return context.index === 4 ? '#e8822a' : '#64748b';
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
                    labels: ['Subscriptions', 'One-time Sales', 'Services'],
                    datasets: [{
                        data: [65, 25, 10],
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
                                    return ' ' + context.label + ': ' + context.parsed + '%';
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
