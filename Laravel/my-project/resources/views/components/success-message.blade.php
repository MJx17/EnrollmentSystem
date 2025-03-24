@props(['success'])

@if (session('success'))
    <div {{ $attributes->merge(['class' => 'bg-green-100 border-l-4 border-green-500 text-green-700 p-4', 'role' => 'alert']) }}>
        <p>{{ session('success') }}</p>
    </div>
@endif
