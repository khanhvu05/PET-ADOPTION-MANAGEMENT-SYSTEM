@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'block w-full px-3 py-2 bg-white dark:bg-zinc-900 text-[#18181B] dark:text-zinc-100 border border-[#EAEAEA] dark:border-zinc-800 rounded-[6px] text-sm font-sans focus:outline-none focus:border-[#18181B] dark:focus:border-zinc-300 focus:ring-0 transition duration-150 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed']) }}>
