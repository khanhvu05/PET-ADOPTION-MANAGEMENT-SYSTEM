<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-700 hover:text-[#F58A3C] hover:border-[#F58A3C] hover:bg-orange-50/50 hover:shadow-md transition-all shadow-sm disabled:opacity-50 focus:outline-none focus:ring-2 focus:ring-[#F58A3C] focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
