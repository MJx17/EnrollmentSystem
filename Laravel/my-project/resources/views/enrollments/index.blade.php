<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Enrollment') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-4">
        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Create Button -->
        <div class="mb-6">
            <a href="{{ route('enrollments.create') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700">
                Add Enrollment
            </a>
        </div>

        <!-- Enrollments Table -->
        <div class="overflow-x-auto shadow-xl sm:rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-12">
                            #</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Student</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Course</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year
                            Level</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-40">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($enrollments as $enrollment)
                        <tr class="hover:bg-gray-200">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $enrollment->student->full_name }}</td>

                            <td class="px-6 py-4 whitespace-nowrap">{{ $enrollment->course->course_name }}</td>
                            <td class="px-4 py-2 border-t border-b">
                                {{ Str::title(str_replace('_', ' ', $enrollment->year_level)) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($enrollment->category) }}</td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('enrollments.fees', $enrollment->id) }}"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-500 border border-transparent rounded-md hover:bg-green-300 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                                    View
                                </a>
                                <a href="{{ route('enrollments.edit', $enrollment->id) }}"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-500 border border-transparent rounded-md hover:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                                    Edit
                                </a>

                                <!-- Delete Button -->
                                <form id="delete-form-{{ $enrollment->id }}"
                                    action="{{ route('enrollments.destroy', $enrollment->id) }}" method="POST"
                                    class="inline-block ">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-500 border border-transparent rounded-md hover:bg-red-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                        onclick="confirmDelete('delete-form-{{ $enrollment->id }}')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                No enrollments found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $enrollments->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-app-layout>