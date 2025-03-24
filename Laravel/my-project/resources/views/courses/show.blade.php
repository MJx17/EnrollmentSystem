<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Course Details') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Course Details</h1>

        <div class="mb-4">
            <strong>Course Code:</strong> {{ $course->course_code }}
        </div>

        <div class="mb-4">
            <strong>Course Name:</strong> {{ $course->course_name }}
        </div>

        <div class="mb-4">
            <strong>Description:</strong> {{ $course->description ?? 'N/A' }}
        </div>

        <div class="mb-4">
            <strong>Units:</strong> {{ $course->units }}
        </div>

        <div class="mb-4">
            <strong>Department:</strong> {{ $course->department->name }}
        </div>

        <div class="mb-4">
            <a href="{{ route('courses.edit', $course->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Edit Course
            </a>
        </div>

        <div class="mb-4">
            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600" onclick="return confirm('Are you sure you want to delete this course?')">
                    Delete Course
                </button>
            </form>
        </div>

        <div>
            <a href="{{ route('courses.index') }}" class="text-blue-500 hover:underline">Back to Course List</a>
        </div>
    </div>
</x-app-layout>
