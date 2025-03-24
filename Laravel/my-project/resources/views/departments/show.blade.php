<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Department Details') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Department Details</h1>

        <div class="mb-4">
            <h2 class="font-bold">Name:</h2>
            <p>{{ $department->name }}</p>
        </div>

        <a href="{{ route('departments.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            Back
        </a>
    </div>
</x-app-layout>
