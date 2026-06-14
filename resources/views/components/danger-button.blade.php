<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center bg-red-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-red-700 transition-all shadow-[0_4px_14px_rgba(220,38,38,0.4)] hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
