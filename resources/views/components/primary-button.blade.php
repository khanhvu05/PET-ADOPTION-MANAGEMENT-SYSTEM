<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center bg-teal-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-teal-800 hover:shadow-md transition-all shadow-sm disabled:opacity-50 focus:outline-none focus:ring-2 focus:ring-teal-700 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
