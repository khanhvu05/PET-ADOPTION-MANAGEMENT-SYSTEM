<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-500 hover:shadow-md hover:-translate-y-0.5 transition-all shadow-sm disabled:opacity-50 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
