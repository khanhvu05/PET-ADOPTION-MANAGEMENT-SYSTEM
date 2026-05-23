@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-900 focus:bg-white focus:outline-none focus:border-orange-brand focus:ring-4 focus:ring-orange-brand/10 transition-all shadow-sm disabled:opacity-50 disabled:cursor-not-allowed']) }}>
