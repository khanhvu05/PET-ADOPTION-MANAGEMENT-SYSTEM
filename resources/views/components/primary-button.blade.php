<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-[#18181B] dark:bg-zinc-100 hover:bg-zinc-800 dark:hover:bg-zinc-200 text-white dark:text-zinc-900 border border-transparent rounded-[6px] font-sans text-xs font-medium uppercase tracking-widest active:scale-[0.98] focus:outline-none transition duration-150 ease-in-out disabled:opacity-50']) }}>
    {{ $slot }}
</button>
