<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex w-full items-center justify-center px-6 py-3 bg-orange-brand hover:opacity-90 text-white border border-transparent rounded-sm font-sans text-base font-bold uppercase tracking-widest active:scale-95 focus:outline-none transition-all duration-200 ease-in-out shadow-glow disabled:opacity-50']) }}>
    {{ $slot }}
</button>
