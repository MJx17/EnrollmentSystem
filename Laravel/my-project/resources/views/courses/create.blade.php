<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Course') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <div class="max-w-lg mx-auto bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Add Course</h1>

            <form action="{{ route('courses.store') }}" method="POST">
                @csrf

                <!-- Department & Units Grouped in Row (Switches to Column on Mobile) -->
                <div class="mb-4 flex flex-col md:flex-row gap-4">
                    <!-- Department -->
                    <div class="w-full md:w-1/2">
                        <label for="department_id" class="block font-medium text-gray-700">Department</label>
                        <select name="department_id" id="department_id"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 mt-1">
                            @foreach ($departments as $department)
                            <option value="{{ $department->id }}"
                                {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('department_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Units -->
                    <div class="w-full md:w-1/2">
                        <label for="units" class="block font-medium text-gray-700">Units</label>
                        <input type="number" name="units" id="units" value="{{ old('units') }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 mt-1">
                        @error('units')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Course Code -->
                <div class="mb-4">
                    <label for="course_code" class="block font-medium text-gray-700">Course Code</label>
                    <input type="text" name="course_code" id="course_code" value="{{ old('course_code') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 mt-1">
                    @error('course_code')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Course Name -->
                <div class="mb-4">
                    <label for="course_name" class="block font-medium text-gray-700">Course Name</label>
                    <input type="text" name="course_name" id="course_name" value="{{ old('course_name') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 mt-1">
                    @error('course_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>



                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 mt-1">{{ old('description') }}</textarea>
                    @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>



                <div class="mt-6 flex justify-end space-x-2">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Save
                    </button>

                    <a href="{{ route('courses.index') }}"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>