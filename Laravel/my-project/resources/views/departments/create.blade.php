<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Department') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8 flex justify-center">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 w-full max-w-lg">
            <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">Add Department</h1>

            <form action="{{ route('departments.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block font-medium text-gray-700 dark:text-gray-300">Department Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                        class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6 flex justify-end space-x-2">
                    <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                        Save
                    </button>
                    <a href="{{ route('departments.index') }}" 
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
