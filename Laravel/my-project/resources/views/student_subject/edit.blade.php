<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Subjects for ' . $student->fullname) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">
                        Edit Subjects for {{ $student->fullname }}
                    </h3>

                    @if($student->subjects->isEmpty())
                        <p>This student is not enrolled in any subjects.</p>
                    @else
                        <form action="{{ route('student_subjects.update', $student->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Subject Code
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Subject Name
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Grade
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200">
                                        @foreach($student->subjects as $subject)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $subject->code }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $subject->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                <select name="subjects[{{ $subject->id }}][status]" 
                                                        class="status-input border p-2 rounded px-10">
                                                    <option value="enrolled" {{ old('subjects.' . $subject->id . '.status', $subject->pivot->status) == 'enrolled' ? 'selected' : '' }}>Enrolled</option>
                                                    <option value="dropped" {{ old('subjects.' . $subject->id . '.status') == 'dropped' ? 'selected' : '' }}>Dropped</option>
                                                    <option value="completed" {{ old('subjects.' . $subject->id . '.status', $subject->pivot->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                                </select>

                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    <input type="text" name="subjects[{{ $subject->id }}][grade]" 
                                                           value="{{ old('subjects.' . $subject->id . '.grade', $subject->pivot->grade) }}" 
                                                           class="grade-input border p-2 rounded">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg">
                                    Update Subjects
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
