<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student Management') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Student Management</h1>

        <!-- Table for students -->
        <div class="overflow-x-auto shadow-sm rounded-lg">
            <table class="table-auto w-full border-collapse border-t border-b border-gray-200 bg-white">
                <thead class="bg-gray-300 text-left">
                    <tr class>
                        <th class="px-4 py-4 border-t border-b ">#</th>
                        <th class="px-4 py-4 border-t border-b">Name</th>
                        <th class="px-4 py-4 border-t border-b">Email</th>
                        <th class="px-4 py-4 border-t border-b ">Mobile</th>
                        <th class="px-4 py-4 border-t border-b">Year Level</th>
                        <th class="px-4 py-4 border-t border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr class="hover:bg-gray-200 transition duration-200 border-gray-400">
                        <td class="px-4 py-4 border-t border-b ">{{ $loop->iteration }}</td>
                        <td class="px-4 py-4 border-t border-b ">{{ $student->first_name }} {{ $student->surname }}</td>
                        <td class="px-4 py-4 border-t border-b">{{ $student->email_address }}</td>
                        <td class="px-4 py-4 border-t border-b">{{ $student->mobile_number }}</td>
                        <td class="px-4 py-4 border-t border-b">
                            @php
                            $yearLevel = \App\Models\Enrollment::where('student_id', $student->id)->first()->year_level
                            ?? 'N/A';
                            @endphp
                            {{ Str::title(str_replace('_', ' ', $yearLevel)) }}
                        </td>

                        <td class="px-4 py-4 border-t border-b">
                            <!-- Styled action buttons -->
                            <a href="{{ route('student.edit', $student->id) }}"
                                class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-200">Edit</a>
                            <a href="{{ route('student.show', $student->id) }}"
                                class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-700 transition duration-200">View</a>
                            <form id="delete-form-{{ $student->id }}"
                                action="{{ route('student.destroy', $student->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-700 transition duration-200"
                                    onclick="confirmDelete({{ $student->id }})">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $students->links() }}
            <!-- Display pagination links -->
        </div>
    </div>
</x-app-layout>