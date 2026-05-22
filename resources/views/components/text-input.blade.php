@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'block w-full px-4 py-3 bg-white text-slate-900 border border-transparent rounded-xs text-base font-bold font-sans focus:outline-none focus:ring-2 focus:ring-orange-brand/50 transition-all duration-200 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed shadow-sm']) }}>
