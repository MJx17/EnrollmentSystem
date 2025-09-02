<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student Management') }}
        </h2>
    </x-slot>

        <div class="container mx-auto py-8">
                <h1 class="text-2xl font-bold mb-6">Student Management</h1>

                <!-- Filter Form -->
                <form method="GET" action="{{ route('student.indexAdmin') }}" class="mb-4 flex space-x-4">
            <!-- Search Student Name -->
            <input type="text" name="search" placeholder="Search by name"
                value="{{ request('search') }}"
                class="border-gray-300 rounded p-2 w-64"
            />

            <!-- Year Level Filter -->
            <select name="year_level" class="border-gray-300 rounded p-2  px-6">
                <option value="">All Year Levels</option>
                @foreach ($yearLevels as $level)
                    <option value="{{ $level }}" {{ request('year_level') == $level ? 'selected' : '' }}>
                        {{ Str::title(str_replace('_', ' ', $level)) }}
                    </option>
                @endforeach
            </select>

            <!-- Enrollment Status Filter -->
     
                <select name="status" class="border-gray-300 rounded p-2 px-4">
                    <option value="">All Statuses</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                        {{ Str::title(str_replace('_', ' ', $status  )) }}
                        </option>
                    @endforeach
                </select>

            <!-- Apply Filters Button -->
            <button type="submit" class="px-8   py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition">
                Apply Filters
            </button>

            <!-- Reset Button -->
            <a href="{{ route('student.indexAdmin') }}" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-600 transition">
                Reset
            </a>
        </form>


        <!-- Table for students -->
        <div class="overflow-x-auto shadow-sm rounded-lg">
            <table class="table-auto w-full border-collapse border-t border-b border-gray-200 bg-white">
                <thead class="bg-gray-300 text-left">
                    <tr>
                        <th class="px-4 py-4 border-t border-b">#</th>
                        <th class="px-4 py-4 border-t border-b">Name</th>
                        <th class="px-4 py-4 border-t border-b">Email</th>
                        <th class="px-4 py-4 border-t border-b">Mobile</th>
                        <th class="px-4 py-4 border-t border-b">Year Level</th>
                        <th class="px-4 py-4 border-t border-b">Enrollment Status</th>
                        <th class="px-4 py-4 border-t border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr class="hover:bg-gray-200 transition duration-200 border-gray-400">
                        <td class="px-4 py-4 border-t border-b">{{ $loop->iteration }}</td>
                        <td class="px-4 py-4 border-t border-b">{{ $student->first_name }} {{ $student->surname }}</td>
                        <td class="px-4 py-4 border-t border-b">{{ $student->email_address }}</td>
                        <td class="px-4 py-4 border-t border-b">{{ $student->mobile_number }}</td>
                        <td class="px-4 py-4 border-t border-b">
                                {{ $student->formatted_year_level }}  <!-- This now uses the accessor -->
                        </td>
                           
                        </td>
                        <td class="px-4 py-4 border-t border-b">{{ $student->getFormattedStatus() }}</td>


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
            {{ $students->appends(request()->query())->links() }}
        </div>
    </div>
</x-app-layout>
