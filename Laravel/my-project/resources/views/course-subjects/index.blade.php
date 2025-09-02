<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Course Subjects') }}
        </h2>
    </x-slot>

    <div class="max-w-8xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-xl sm:rounded-lg p-6">
            <!-- Dynamic Course Name -->
            <h3 id="courseName" class="text-xl text-center font-semibold mb-4">
                {{ optional($groupedCourses->first())['course_name'] ?? 'Select a Course' }}
            </h3>

            <!-- Course Selection Tabs -->
            <div class="overflow-x-auto whitespace-nowrap mb-4 scrollbar-hidden h-50">
                <div class="flex justify-center space-x-4 mb-4" id="courseTabs">
                    @foreach ($groupedCourses as $courseCode => $courseData)
                        <button
                            class="course-tab px-4 py-2 rounded-md transition duration-300 bg-gray-200 text-gray-700"
                            data-course="{{ $courseCode }}"
                            data-course-name="{{ $courseData['course_name'] }}">
                            {{ $courseCode }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Shelves (Only Render Active Shelf) -->
            @foreach ($groupedCourses as $courseCode => $courseData)
                <div class="course-shelf p-4 hidden" id="shelf-{{ $courseCode }}">
                    <h4 class="text-lg font-semibold mb-4">{{ $courseData['course_name'] }} - Subjects Grouped by Year Level:</h4>
                    
                    <!-- Loop through year_levels and create a table for each -->
                    @foreach ($courseData['subjects_by_year_level'] as $yearLevel => $subjects)
                        <div class="year-level-section mb-6">
                            
                            <!-- Table for displaying subjects -->
                            <table class="min-w-full table-auto border-collapse border border-gray-300 mb-4">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th class="py-2 px-4 border border-gray-300 text-left">Subject Code</th>
                                        <th class="py-2 px-4 border border-gray-300 text-left">Subject Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subjects as $courseSubject)
                                        <tr class="bg-gray-100 hover:bg-gray-200">
                                            <td class="py-2 px-4 border border-gray-300">{{ $courseSubject->subject->code }}</td>
                                            <td class="py-2 px-4 border border-gray-300">{{ $courseSubject->subject->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach

                    <!-- Manage Subjects Button -->
                    <div class="mt-4 flex justify-end gap-2">
                        <a href="{{ route('course-subjects.edit', $courseCode) }}"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                             Edit
                        </a>
                        <a href="{{ route('course-subjects.create', $courseCode) }}"
                            class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-700">
                            Add
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let tabs = document.querySelectorAll(".course-tab");
            let shelves = document.querySelectorAll(".course-shelf");
            let courseNameHeader = document.getElementById("courseName");

            function showCourse(courseCode, courseName) {
                shelves.forEach(shelf => {
                    shelf.classList.toggle("hidden", shelf.id !== `shelf-${courseCode}`);
                });

                tabs.forEach(tab => {
                    let isActive = tab.getAttribute("data-course") === courseCode;
                    tab.classList.toggle("bg-blue-500", isActive);
                    tab.classList.toggle("text-white", isActive);
                    tab.classList.toggle("bg-gray-200", !isActive);
                    tab.classList.toggle("text-gray-700", !isActive);
                });

                courseNameHeader.textContent = courseName;
            }

            tabs.forEach(tab => {
                tab.addEventListener("click", function() {
                    showCourse(this.getAttribute("data-course"), this.getAttribute("data-course-name"));
                });
            });

            if (tabs.length > 0) {
                showCourse(tabs[0].getAttribute("data-course"), tabs[0].getAttribute("data-course-name"));
            }
        });
    </script>
</x-app-layout>
