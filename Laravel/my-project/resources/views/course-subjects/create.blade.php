<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Assign Subjects for ') }} {{ $course->course_name }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-xl sm:rounded-lg p-6 bg-white">
            <h3 class="text-xl text-center font-semibold mb-4">{{ $course->course_name }}</h3>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('course-subjects.store', $course->course_code) }}" method="POST">
                @csrf

                <!-- Available Subjects Selection Using Checkboxes -->
                <h4 class="font-semibold mb-2">Select Subjects to Assign:</h4>
                <div class="border border-gray-300 rounded-md p-2 h-[400px] overflow-y-auto scrollbar-hide">
                    @foreach ($availableSubjects as $subject)
                        <div class="flex justify-between items-center border-t border-b border-gray-200 px-4 py-2 hover:bg-gray-200">
                            <span class="font-medium text-gray-700">{{ $subject->code }} - {{ $subject->name }}</span>
                            <input type="checkbox" name="add_subjects[]" value="{{ $subject->id }}" id="subject-{{ $subject->id }}" class="ml-2">
                        </div>
                    @endforeach
                </div>

                <!-- Submit Button (Fixed Alignment) -->
                <div class="mt-4 flex justify-end gap-2">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Save 
                    </button>
                    <a href="{{ route('course-subjects.index') }}" 
                       class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
