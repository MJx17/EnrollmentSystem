<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
  

        <!-- Success Message -->
      

        <!-- Add Course Button -->
        <div class="mb-6">
            <a href="{{ route('courses.create') }}" 
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Add Course
            </a>
        </div>

        <!-- Courses Table -->
        <div class="overflow-x-auto shadow-xl sm:rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course Code</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($courses as $course)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2  whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2  whitespace-nowrap">{{ $course->course_code }}</td>
                            <td class="px-4 py-2  whitespace-nowrap">{{ $course->course_name }}</td>
                            <td class="px-4 py-2  whitespace-nowrap">{{ $course->department->name }}</td>
                            <td class="px-4 py-2  whitespace-nowrap">
                                <!-- Edit Button -->
                                <a href="{{ route('courses.edit', $course->id) }}" 
                                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Edit
                                </a>

                                <!-- Delete Button -->
                                <form id="delete-form-{{ $course->id }}" action="{{ route('courses.destroy', $course->id) }}" method="POST" class="inline-block ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                    onclick="confirmDelete('delete-form-{{ $course->id }}')">
                                    Delete
                                </button>
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $courses->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
    @if(session('success'))
            
            @endif
</x-app-layout>
