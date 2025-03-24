<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Subject') }}
        </h2>
    </x-slot>

    <div class="py-10 flex justify-center">
        <div class="max-w-3xl w-full bg-white shadow-md rounded-xl p-6">

            <form method="POST" action="{{ route('subjects.store') }}">
               
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Subject Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Subject Name</label>
                        <input type="text" name="name" id="name" 
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300"
                            value="{{ old('name') }}" required>
                    </div>

                    <!-- Subject Code -->
                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700">Subject Code</label>
                        <input type="text" name="code" id="code"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300"
                            value="{{ old('code') }}" required>
                    </div>

                    <div>
                        <label for="room" class="block text-sm font-medium text-gray-700">Room</label>
                        <input type="text" name="room" id="room"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300"
                            value="{{ old('room') }}" required>
                    </div>


                    <div>
                        <label for="block" class="block text-sm font-medium text-gray-700">block</label>
                        <input type="text" name="block" id="block"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300"
                            value="{{ old('block') }}" required>
                    </div>

                    <!-- Semester & Year Level -->
                    <div>
                        <label for="semester_id" class="block text-sm font-medium text-gray-700">Semester</label>
                        <select name="semester_id" id="semester_id"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300" required>
                            <option value="">Select Semester</option>
                            @foreach($semesters as $semester)
                                <option value="{{ $semester->id }}" {{ old('semester_id') == $semester->id ? 'selected' : '' }}>
                                    {{ $semester->semester }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="year_level" class="block text-sm font-medium text-gray-700">Year Level</label>
                        <select id="year_level" name="year_level"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300" required>
                            <option value="" disabled selected>Select Year Level</option>
                            <option value="first_year">First Year</option>
                            <option value="second_year">Second Year</option>
                            <option value="third_year">Third Year</option>
                            <option value="fourth_year">Fourth Year</option>
                            <option value="fifth_year">Fifth Year</option>
                        </select>
                    </div>

                        <!-- Prerequisite -->
                        <div>
                        <label for="prerequisite_id" class="block text-sm font-medium text-gray-700">Prerequisite</label>
                        <select name="prerequisite_id" id="prerequisite_id"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                            <option value="">None</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('prerequisite_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Professor -->
                    <div>
                        <label for="professor_id" class="block text-sm font-medium text-gray-700">Professor</label>
                        <select name="professor_id" id="professor_id"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300" required>
                            <option value="">Select Professor</option>
                            @foreach($professors as $professor)
                                <option value="{{ $professor->id }}" {{ old('professor_id') == $professor->id ? 'selected' : '' }}>
                                    {{ $professor->user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Fee, Units, Start Time, End Time in One Row -->
                    <div class="grid grid-cols-4 gap-4 col-span-2">
                        <div>
                            <label for="fee" class="block text-sm font-medium text-gray-700">Fee</label>
                            <input type="number" name="fee" id="fee"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300"
                                value="{{ old('fee') }}" required>
                        </div>

                        <div>
                            <label for="units" class="block text-sm font-medium text-gray-700">Units</label>
                            <input type="number" name="units" id="units"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300"
                                value="{{ old('units') }}" step="0.1" min="0.1" max="10" required>
                        </div>

                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                            <input type="time" name="start_time" id="start_time"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300" required>
                        </div>

                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                            <input type="time" name="end_time" id="end_time"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300" required>
                        </div>
                    </div>

                
           
                    </div>
                  <!-- Days & Courses in a Responsive Grid -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 col-span-2 py-5">


                  <div>
                        <label for="course_ids" class="block text-sm font-medium text-gray-700">Courses</label>
                        <div class="grid grid-cols-1 gap-2 mt-2">
                            @foreach($courses as $course)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="course_ids[]" value="{{ $course->id }}" class="rounded border-gray-300">
                                    <span class="text-gray-700">{{ $course->course_name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <!-- Days -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Days</label>
                        <div class="flex flex-col space-y-2 mt-2">
                            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="days[]" value="{{ $day }}" class="rounded border-gray-300">
                                    <span class="text-gray-700">{{ $day }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Courses -->
               
                </div>



            

                <!-- Submit Button -->
                <div class="mt-6 flex justify-end gap-2">
                    <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                        Create
                    </button>
                    <a href="{{ route('subjects.index') }}" 
                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700">
                    Cancel
                </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
