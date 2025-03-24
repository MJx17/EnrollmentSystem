<div id="sidebar"
    class="sidebar fixed inset-0 bg-gray-900 bg-opacity-75 z-50 transform -translate-x-full transition-transform duration-300 ease-in-out">
    <div class="w-64 bg-green-700 h-full text-white p-5">
        <button id="sidebar-close-button" class="text-gray-400 hover:text-white mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <h1 class="text-xl font-semibold mb-6 text-center">Sidebar Menu</h1>
        <ul class="space-y-4">
            <!-- Home Page - Accessible to All Authenticated Users -->
            <li>
                <a href="{{ route('home') }}"
                    class="block py-2 px-4 w-full text-center font-medium text-white rounded-lg transition-all duration-200 ease-in-out hover:bg-green-500 {{ Route::currentRouteName() == 'home' ? 'bg-gray-700' : '' }}">
                    Home
                </a>
            </li>

            <!-- Enrollment Page - Accessible to Admins and Students Only -->
            @if(auth()->check() && (auth()->user()->hasRole('') || auth()->user()->hasRole('student')))
            <li>
                <a href="{{ route('student.create') }}"
                    class="block py-2 px-4 w-full text-center font-medium text-white rounded-lg transition-all duration-200 ease-in-out hover:bg-green-500 {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-gray-700' : '' }}">
                    Details
                </a>
                <a href="{{ route('student_subject.subjects', auth()->user()->student->id) }}"
                    class="block py-2 px-4 w-full text-center font-medium text-white rounded-lg transition-all duration-200 ease-in-out hover:bg-green-500 {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-gray-700' : '' }}">
                    Subjects
                </a>
                <a href="{{ route('enrollments.fees', auth()->user()->student->id) }}"
                    class="block py-2 px-4 w-full text-center font-medium text-white rounded-lg transition-all duration-200 ease-in-out hover:bg-green-500 {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-gray-700' : '' }}">
                    Enrollment
                </a>


            </li>

            @endif


            <!-- Admin Page - Accessible to Admins Only -->
            @if(auth()->user()->hasRole('admin'))
            <li>
                <!-- <a href="{{ route('roles.index') }}" 
                   class="block py-2 px-4 w-full text-center font-medium text-white rounded-lg transition-all duration-200 ease-in-out hover:bg-green-500 {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-gray-700' : '' }}">
                   Roles
                </a>
                <a href="{{ route('permissions.index') }}" 
                   class="block py-2 px-4 w-full text-center font-medium text-white rounded-lg transition-all duration-200 ease-in-out hover:bg-green-500 {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-gray-700' : '' }}">
                   Permissions
                </a> -->
                <a href="{{ route('users.index') }}"
                    class="block py-2 px-4 w-full text-center font-medium text-white rounded-lg transition-all duration-200 ease-in-out hover:bg-green-500 {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-gray-700' : '' }}">
                    Users
                </a>

                <a href="{{ route('courses.index') }}"
                    class="block py-2 px-4 w-full text-center font-medium text-white rounded-lg transition-all duration-200 ease-in-out hover:bg-green-500{{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-gray-700' : '' }}">
                    Courses
                </a>
                <a href="{{ route('subjects.index') }}"
                    class="block py-2 px-4 w-full text-center font-medium text-white rounded-lg transition-all duration-200 ease-in-out hover:bg-green-500 {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-gray-700' : '' }}">
                    Subjects
                </a>
                <a href="{{ route('professors.index') }}"
                    class="block py-2 px-4 w-full text-center font-medium text-white rounded-lg transition-all duration-200 ease-in-out hover:bg-green-500 {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-gray-700' : '' }}">
                    Professors
                </a>

                <a href="{{ route('enrollments.index') }}"
                    class="block py-2 px-4 w-full text-center font-medium text-white rounded-lg transition-all duration-200 ease-in-out hover:bg-green-500 {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-gray-700' : '' }}">
                    Enrollment
                </a>

                <a href="{{ route('student.indexAdmin') }}"
                    class="block py-2 px-4 w-full text-center font-medium text-white rounded-lg transition-all duration-200 ease-in-out hover:bg-green-500 {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-gray-700' : '' }}">
                    Student List
                </a>
                <a href="{{ route('departments.index') }}"
                    class="block py-2 px-4 w-full text-center font-medium text-white rounded-lg transition-all duration-200 ease-in-out hover:bg-green-500 {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-gray-700' : '' }}">
                    Departments
                </a>
                <a href="{{ route('course-subjects.index') }}"
                    class="block py-2 px-4 w-full text-center font-medium text-white rounded-lg transition-all duration-200 ease-in-out hover:bg-green-500 {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-gray-700' : '' }}">
                    Course Subjects
                </a>

            </li>
            @endif

            @if(auth()->user()->hasRole('professor'))
            <li>
                <a href="{{ route('professors.subjects', auth()->user()->professor->id) }}"
                    class="block py-2 px-4 w-full text-center font-medium text-white rounded-lg transition-all duration-200 ease-in-out hover:bg-green-500 {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-gray-700' : '' }}">
                    Subjects
                </a>
                <a href="{{ route('professors.show', auth()->user()->professor->id) }}"
                    class="block py-2 px-4 w-full text-center font-medium text-white rounded-lg transition-all duration-200 ease-in-out hover:bg-green-500 {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-gray-700' : '' }}">
                    Assement
                </a>
                <a href="{{ route('professors.profile', auth()->user()->professor->id) }}"
                    class="block py-2 px-4 w-full text-center font-medium text-white rounded-lg transition-all duration-200 ease-in-out hover:bg-green-500 {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-gray-700' : '' }}">
                    Details
                </a>
            </li>
            @endif


        </ul>
    </div>
</div>