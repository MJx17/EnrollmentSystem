<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
            {{ __('Edit Professor') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-4">
        <div class="max-w-2xl mx-auto bg-white shadow-md rounded-md p-4">
            <h1 class="text-xl font-semibold text-gray-800 mb-4">Edit Professor</h1>

            <form action="{{ route('professors.update', $professor->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach (['user_id' => 'User ID', 'surname' => 'Surname', 'first_name' => 'First Name', 'middle_name' => 'Middle Name (Optional)', 'sex' => 'Sex', 'contact_number' => 'Contact Number', 'email' => 'Email', 'designation' => 'Designation'] as $name => $label)
                        <div>
                            <label for="{{ $name }}" class="block text-xs font-medium text-gray-700">{{ $label }}</label>
                            @if($name === 'user_id')
                                <input type="text" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $professor->$name) }}" 
                                    class="mt-1 w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" readonly>
                            @else
                                <input type="text" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $professor->$name) }}" 
                                    class="mt-1 w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @endif
                            @error($name)
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 flex justify-end space-x-3">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white text-sm font-semibold rounded-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-500">
                        Update
                    </button>
                    <a href="{{ route('professors.index') }}" class="px-4 py-2 bg-gray-500 text-white text-sm font-semibold rounded-md hover:bg-gray-600 focus:ring-2 focus:ring-gray-500">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
