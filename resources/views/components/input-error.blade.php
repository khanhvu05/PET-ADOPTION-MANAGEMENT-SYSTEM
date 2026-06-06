@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'auth-error-message text-sm text-red-500 font-bold space-y-1 mt-1.5 list-none pl-0']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif

