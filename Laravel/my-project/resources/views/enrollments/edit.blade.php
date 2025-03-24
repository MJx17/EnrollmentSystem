<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Enrollment') }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-12 px-6 sm:px-8 lg:px-10">
        <div class="bg-white dark:bg-gray-900 shadow-lg rounded-lg p-8">
            <form method="POST" action="{{ route('enrollments.update', $enrollment->id) }}"
                class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @csrf
                @method('PUT')

                <!-- Student & Course Selection -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-blue-800 dark:text-white">Student & Course</h3>
                    <div class="grid grid-cols-1 gap-4">
                        <select name="student_id" required
                            class="w-full p-3 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500"
                            disabled>
                            <option value="" disabled>Select Student</option>
                            @foreach($students as $student)
                            <option value="{{ $student->id }}"
                                {{ $enrollment->student_id == $student->id ? 'selected' : '' }}>{{ $student->fullname }}
                            </option>
                            @endforeach
                        </select>

                        <select id="category" name="category"
                            class="w-full p-3 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="old" {{ $enrollment->category == 'old' ? 'selected' : '' }}>Old</option>
                            <option value="new" {{ $enrollment->category == 'new' ? 'selected' : '' }}>New</option>
                            <option value="shifter" {{ $enrollment->category == 'shifter' ? 'selected' : '' }}>Shifter
                            </option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <select name="semester_id" id="semester_id"
                            class="w-full p-3 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="" disabled>Select Semester</option>
                            @foreach($semesters as $semester)
                            <option value="{{ $semester->id }}"
                                {{ $enrollment->semester_id == $semester->id ? 'selected' : '' }}>
                                {{ $semester->semester }} Semester
                            </option>
                            @endforeach
                        </select>

                        <select id="year_level" name="year_level"
                            class="w-full p-3 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="first_year" {{ $enrollment->year_level == 'first_year' ? 'selected' : '' }}>
                                First Year</option>
                            <option value="second_year"
                                {{ $enrollment->year_level == 'second_year' ? 'selected' : '' }}>
                                Second Year</option>
                            <option value="third_year" {{ $enrollment->year_level == 'third_year' ? 'selected' : '' }}>
                                Third Year</option>
                            <option value="fourth_year"
                                {{ $enrollment->year_level == 'fourth_year' ? 'selected' : '' }}>
                                Fourth Year</option>
                            <option value="5th_year" {{ $enrollment->year_level == '5th_year' ? 'selected' : '' }}>Fifth
                                Year</option>
                            <option value="irregular" {{ $enrollment->year_level == 'irregular' ? 'selected' : '' }}>
                                Irregular</option>
                        </select>
                    </div>

                    <select name="course_id" required
                        class="w-full p-3 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="" disabled>Select Course</option>
                        @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ $enrollment->course_id == $course->id ? 'selected' : '' }}>
                            {{ $course->course_name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tuition & Fees -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-blue-800 dark:text-white">Tuition & Fees</h3>

                    <div class="grid grid-cols-1 gap-4">
                        <input type="number" name="tuition_fee" id="tuition_fee" placeholder="Tuition Fee"
                            class="w-full p-3 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500"
                            value="{{ old('tuition_fee', $enrollment->fees->tuition_fee) }}" required>
                        <input type="number" name="lab_fee" id="lab_fee" placeholder="Lab Fee"
                            class="w-full p-3 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500"
                            value="{{ old('lab_fee', $enrollment->fees->lab_fee) }}">
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <input type="number" name="miscellaneous_fee" id="miscellaneous_fee"
                            placeholder="Miscellaneous Fee"
                            class="w-full p-3 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500"
                            value="{{ old('miscellaneous_fee', $enrollment->fees->miscellaneous_fee) }}">
                        <input type="number" name="other_fee" id="other_fee" placeholder="Other Fee"
                            class="w-full p-3 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500"
                            value="{{ old('other_fee', $enrollment->fees->other_fee) }}">
                    </div>

                    <input type="number" name="discount" id="discount" placeholder="Discount"
                        class="w-full p-3 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500"
                        value="{{ old('discount', $enrollment->fees->discount) }}">
                    <input type="number" name="initial_payment" id="initial_payment" placeholder="Initial Payment"
                        class="w-full p-3 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500"
                        value="{{ old('initial_payment', $enrollment->fees->initial_payment) }}">
                </div>

                <!-- Payment Status Section -->


                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-blue-800 dark:text-white">Payment Status</h3>
                    <div class="grid grid-cols-1 gap-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="prelims_paid" value="1"
                                {{ old('prelims_paid', $payment->prelims_paid == 1) ? 'checked' : '' }}
                                class="form-checkbox">
                            <span class="ml-2">Prelims Paid</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="midterms_paid" value="1"
                                {{ old('midterms_paid', $payment->midterms_paid == 1) ? 'checked' : '' }}
                                class="form-checkbox">
                            <span class="ml-2">Midterms Paid</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="pre_final_paid" value="1"
                                {{ old('pre_final_paid', $payment->pre_final_paid == 1) ? 'checked' : '' }}
                                class="form-checkbox">
                            <span class="ml-2">Pre-Final Paid</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="final_paid" value="1"
                                {{ old('final_paid', $payment->final_paid == 1) ? 'checked' : '' }}
                                class="form-checkbox">
                            <span class="ml-2">Final Paid</span>
                        </label>
                    </div>
                </div>



                <!-- Subjects Section -->
                <div id="subjects-container" class="col-span-1 md:col-span-2 dark:bg-gray-800  rounded-lg mt-3">
                    <h3 class="text-lg font-semibold text-blue-800 dark:text-white">Subjects</h3>
                    <p class="text-gray-500 dark:text-gray-400">
                        Select a course, semester, and year level to see subjects.
                    </p>

                    <div class="grid grid-cols-1 gap-4 border p-2 rounded-lg bg-white dark:bg-gray-900 shadow w-1/2">
                        @foreach($enrollment->subjects as $subject)
                        <label class="flex items-center justify-between w-full">
                            <span>{{ $subject->name }}</span>
                            <input type="checkbox" name="subjects[]" value="{{ $subject->id }}" checked
                                class="form-checkbox">
                        </label>
                        @endforeach
                    </div>
                </div>



                <div class="cols-span-1 md:col-span-2  flex-1 ">

                    @include('partials.financial-edit')

                </div>

















                <!-- Submit & Cancel Buttons -->
                <div class="col-span-1 md:col-span-2 flex justify-end gap-4 mt-6">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300">
                        Update
                    </button>
                    <a href="{{ route('enrollments.index') }}"
                        class="bg-gray-400 hover:bg-gray-500 text-white font-medium py-3 px-6 rounded-lg focus:outline-none focus:ring-4 focus:ring-gray-300">
                        Cancel
                    </a>
                </div>









            </form>
        </div>
    </div>










    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const courseSelect = document.querySelector('select[name="course_id"]');
        const semesterSelect = document.querySelector('select[name="semester_id"]');
        const yearLevelSelect = document.querySelector('select[name="year_level"]');
        const subjectsContainer = document.getElementById('subjects-container');

        function fetchSubjects() {
            const courseId = courseSelect.value;
            const semesterId = semesterSelect.value;
            const yearLevel = yearLevelSelect.value;

            if (!courseId || !semesterId || !yearLevel) {
                subjectsContainer.innerHTML = ''; // Clear subjects if selections are incomplete
                return;
            }

            fetch(
                    `{{ route('get.subjects') }}?course_id=${courseId}&semester_id=${semesterId}&year_level=${yearLevel}`
                )
                .then(response => response.json())
                .then(data => {
                    subjectsContainer.innerHTML = '';

                    if (Object.keys(data).length === 0) {
                        subjectsContainer.innerHTML = '<p class="text-gray-500">No subjects available.</p>';
                    } else {
                        const wrapper = document.createElement('div');
                        wrapper.className =
                            'grid grid-cols-1 md:grid-cols-2 gap-4'; // Two columns on larger screens

                        Object.keys(data).forEach(year => {
                            // Year container (flex item)
                            const yearContainer = document.createElement('div');
                            yearContainer.className =
                                'border p-4 rounded-lg bg-white dark:bg-gray-900 shadow';

                            // Year level header
                            const yearHeader = document.createElement('h3');
                            yearHeader.textContent = year.replace('_', ' ').toUpperCase();
                            yearHeader.className = 'text-lg font-semibold mb-2';

                            // Subject list container
                            const subjectList = document.createElement('div');
                            subjectList.className = 'flex flex-col gap-2';

                            data[year].forEach(subject => {
                                const label = document.createElement('label');
                                label.className =
                                    'flex items-center justify-between w-full';

                                const span = document.createElement('span');
                                span.textContent = subject.name;

                                const checkbox = document.createElement('input');
                                checkbox.type = 'checkbox';
                                checkbox.name = 'subjects[]';
                                checkbox.value = subject.id;
                                checkbox.className = 'form-checkbox';

                                label.appendChild(span);
                                label.appendChild(checkbox);
                                subjectList.appendChild(label);
                            });

                            // Append header and subject list to container
                            yearContainer.appendChild(yearHeader);
                            yearContainer.appendChild(subjectList);
                            wrapper.appendChild(yearContainer);
                        });

                        subjectsContainer.appendChild(wrapper);
                    }
                })
                .catch(error => console.error('Error fetching subjects:', error));
        }

        courseSelect.addEventListener('change', fetchSubjects);
        semesterSelect.addEventListener('change', fetchSubjects);
        yearLevelSelect.addEventListener('change', fetchSubjects);
    });
    </script>


</x-app-layout>