@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:bg-white focus:outline-none focus:border-[#F58A3C] focus:ring-1 focus:ring-[#F58A3C] transition-colors shadow-sm disabled:opacity-50 disabled:cursor-not-allowed']) }}>
