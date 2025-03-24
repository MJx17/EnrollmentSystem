<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Grade Students for ' . $subject->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">
                    {{ $subject->name }}
                    </h3>

                    @if($subject->students->isEmpty())
                        <p>No students are enrolled in this subject.</p>
                    @else
                        <form action="{{ route('professor.updateGrades', $subject->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-200">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Student ID
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Student Name
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Current Grade
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Update Grade
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 ">
                                        @foreach($subject->students as $student)
                                            <tr class="border-y hover:bg-gray-100">
                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $student->id }}
                                                </td>
                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $student->fullname }}
                                                </td>
                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $student->pivot->grade ?? 'N/A' }}
                                                </td>
                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    <input type="number" name="grades[{{ $student->id }}]" 
                                                           value="{{ old('grades.' . $student->id, $student->pivot->grade) }}" 
                                                           class="border p-2 rounded w-20 text-center"
                                                           min="0" max="100">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4 flex justify-end gap-2">
                                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg">
                                    Save 
                                </button>
                                @php
                                // Default professor ID to null
                                $professorId = null;

                                // If the user is a professor, get their own professor ID
                                if (auth()->user()->hasRole('professor') && auth()->user()->professor) {
                                    $professorId = auth()->user()->professor->id;
                                } 
                                // If the user is an admin, no professor ID is needed
                            @endphp

                            @if(auth()->user()->hasRole('professor') && $professorId)
                                <a href="{{ route('professors.show', $professorId) }}" 
                                class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700">
                                    Cancel
                                </a>
                            @endif

                            @if(auth()->user()->hasRole('admin'))
                                <a href="javascript:history.back()"
                                class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700">
                                    Cancel
                                </a>
                            @endif



                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
