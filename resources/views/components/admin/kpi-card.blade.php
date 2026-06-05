@props([
    'title',
    'value' => '0',
    'percent' => 0,
    'footerText' => 'so với tháng trước'
])

@php
    $percent = floatval($percent);
    $isPositive = $percent > 0;
    $isNegative = $percent < 0;
    $isNeutral = $percent == 0;
    
    if ($isPositive) {
        $heights = ['40%', '50%', '60%', '80%', '100%'];
        $colorClass = 'text-green-500';
        $iconPath = 'M5 10l7-7m0 0l7 7m-7-7v18'; // up arrow
    } elseif ($isNegative) {
        $heights = ['100%', '80%', '60%', '50%', '40%'];
        $colorClass = 'text-red-500';
        $iconPath = 'M19 14l-7 7m0 0l-7-7m7 7V3'; // down arrow
    } else {
        $heights = ['50%', '50%', '50%', '50%', '50%'];
        $colorClass = 'text-slate-500';
        $iconPath = 'M5 12h14'; // flat line (minus)
    }
@endphp

<div class="bg-white border border-slate-200 rounded-xl p-4 flex flex-col justify-between shadow hover:shadow-md transition-shadow">
    <span class="text-[10px] xl:text-xs font-bold uppercase tracking-widest text-slate-500 mb-2 truncate">{{ $title }}</span>
    <div class="flex items-end justify-between mb-4 gap-2">
        <span class="text-2xl xl:text-3xl font-bold text-slate-800 leading-none mb-1 truncate min-w-0" title="{{ $value }}">{{ $value }}</span>
        
        <!-- Sparkline -->
        <div class="flex items-end gap-0.5 h-8 shrink-0">
            <div class="w-[5px] bg-orange-brand/40 rounded-sm transition-all duration-500" style="height: {{ $heights[0] }}"></div>
            <div class="w-[5px] bg-orange-brand/50 rounded-sm transition-all duration-500" style="height: {{ $heights[1] }}"></div>
            <div class="w-[5px] bg-orange-brand/70 rounded-sm transition-all duration-500" style="height: {{ $heights[2] }}"></div>
            <div class="w-[5px] bg-orange-brand rounded-sm transition-all duration-500" style="height: {{ $heights[3] }}"></div>
            <div class="w-[5px] bg-orange-brand rounded-sm transition-all duration-500" style="height: {{ $heights[4] }}"></div>
        </div>
    </div>
    <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
        <div class="flex items-center gap-1 text-[10px] xl:text-xs font-medium {{ $colorClass }}">
            <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $iconPath }}"></path>
            </svg>
            {{ $isNeutral ? '0' : abs($percent) }}% {{ $footerText }}
        </div>
    </div>
</div>
