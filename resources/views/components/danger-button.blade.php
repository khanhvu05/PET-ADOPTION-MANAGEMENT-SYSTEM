<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-[#FDEBEC] dark:bg-red-950/30 border border-[#F5C2C1] dark:border-red-900/50 rounded-[6px] font-sans text-xs font-medium text-[#9F2F2D] dark:text-red-400 uppercase tracking-widest hover:bg-[#FADBD8] dark:hover:bg-red-950/50 active:scale-[0.98] focus:outline-none transition ease-in-out duration-150 disabled:opacity-50']) }}>
    {{ $slot }}
</button>

