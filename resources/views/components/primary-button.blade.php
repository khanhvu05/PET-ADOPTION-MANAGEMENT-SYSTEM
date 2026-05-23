<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center bg-orange-brand text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-orange-500 hover:shadow-md hover:-translate-y-0.5 transition-all shadow-sm disabled:opacity-50 focus:outline-none focus:ring-2 focus:ring-orange-brand focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
