@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-mono text-[10px] font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-widest mb-1.5']) }}>
    {{ $value ?? $slot }}
</label>

