@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-sans text-xs font-bold text-white uppercase tracking-widest mb-1.5 drop-shadow-sm']) }}>
    {{ $value ?? $slot }}
</label>

