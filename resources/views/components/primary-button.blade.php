<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center bg-[#F58A3C] text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-[#E07A30] transition-all shadow-[0_4px_14px_rgba(245,138,60,0.4)] hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-[#F58A3C] focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
