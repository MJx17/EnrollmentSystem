<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Subjects Enrolled by ' . $student->fullname) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" dark:bg-gray-800 overflow-hidden shadow-sm sm:">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 border shadow">
                        <div class="">
                            <h3 class="text-lg font-medium">
                                <strong>{{ $student->fullname }}</strong>
                            </h3>
                        </div>
                        <div>
                            <p><strong>Year Level:</strong>
                                {{ Str::title(str_replace('_', ' ', $student->enrollment->year_level ?? 'N/A')) }}
                            </p>
                        </div>



                        <div>
                            <p><strong>Semester:</strong>
                                {{ $student->subjects->first()->semester->fullsemester ?? 'N/A' }}</p>
                        </div>

                    </div>





                    <!-- Subject Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 ">
                            <thead class="bg-gray-300 dark:bg-gray-700 ">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subject Code
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subject Name
                                    </th>

                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Units
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Schedule
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Time
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Professor
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Grade
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200">
                                @foreach($student->subjects as $subject)
                                <tr class="hover:bg-gray-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $subject->code }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $subject->name }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $subject->units }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        @php
                                        $dayMap = [
                                        'Monday' => 'M',
                                        'Tuesday' => 'T',
                                        'Wednesday' => 'W',
                                        'Thursday' => 'Th',
                                        'Friday' => 'F',
                                        'Saturday' => 'S',
                                        'Sunday' => 'Su'
                                        ];
                                        $scheduleDays = json_decode($subject->days, true) ?? [];
                                        $shortDays = array_map(fn($day) => $dayMap[$day] ?? $day, $scheduleDays);
                                        @endphp
                                        {{ implode('', $shortDays) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $subject->start_time }} - {{ $subject->end_time }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $subject->professor->fullname }}
                                    </td>


                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $subject->pivot->status }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $subject->pivot->grade }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($student->subjects->isEmpty())
    <p>This student is not enrolled in any subjects.</p>
    @else
    {{ $subjects->links() }}

</x-app-layout>