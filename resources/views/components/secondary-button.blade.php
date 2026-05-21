<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-[#F7F6F3] dark:bg-zinc-800 border border-[#EAEAEA] dark:border-zinc-700 rounded-[6px] font-sans text-xs font-medium text-[#18181B] dark:text-zinc-300 uppercase tracking-widest hover:bg-[#EEEDE9] dark:hover:bg-zinc-700 active:scale-[0.98] focus:outline-none transition ease-in-out duration-150 disabled:opacity-50']) }}>
    {{ $slot }}
</button>

