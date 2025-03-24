<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Enrollment') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4 mt-6 max-w-3xl">

       
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="flex flex-col items-center sm:flex-row bg-primary text-white p-6">
        <!-- Left Section (Image, Name, Status) -->
        <div class="sm:w-1/3 flex flex-col items-center">
            @if($student->image)
                <img src="{{ asset('storage/'.$student->image) }}" alt="Student Image"
                    class="w-48 h-48 object-cover rounded-full border-4 border-white">
            @else
                <p class="text-gray-300">No image available</p>
            @endif

            <!-- Name Below Image -->
            <h3 class="text-xl font-bold mt-4">{{ $student->first_name }} {{ $student->middle_name }} {{ $student->surname }}</h3>

            <!-- Status Below Image with Conditional Styling -->
            @php
                $statusColors = [
                    'active' => 'bg-green-500',
                    'inactive' => 'bg-red-500',
                    'enrolled' => 'bg-blue-500',
                    'not_enrolled' => 'bg-gray-400'
                ];
                $formattedStatus = ucfirst(str_replace('_', ' ', $student->status));
            @endphp

            <p class="mt-2 px-4 py-2 text-sm font-semibold text-white rounded-lg {{ $statusColors[$student->status] ?? 'bg-gray-400' }}">
                {{ $formattedStatus }}
            </p>
        </div>

        <!-- Right Section (Details) -->
        <div class="sm:w-2/3 px-6 py-4">
            <h3 class="text-black text-2xl font-bold mb-4">Student Profile</h3>

            <!-- Personal Details in One Column -->
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <label class="text-gray-600 font-medium">Mobile Number:</label>
                    <p class="text-gray-700">{{ $student->mobile_number }}</p>
                </div>
                <div class="flex justify-between items-center">
                    <label class="text-gray-600 font-medium">Email:</label>
                    <p class="text-gray-700">{{ $student->email_address }}</p>
                </div>
                <div class="flex justify-between items-center">
                    <label class="text-gray-600 font-medium">Sex:</label>
                    <p class="text-gray-700">{{ $student->sex }}</p>
                </div>
                <div class="flex justify-between items-center">
                    <label class="text-gray-600 font-medium">DOB:</label>
                    <p class="text-gray-700">{{ \Carbon\Carbon::parse($student->dob)->format('F d, Y') }}</p>
                </div>
                <div class="flex justify-between items-center">
                    <label class="text-gray-600 font-medium">Age:</label>
                    <p class="text-gray-700">{{ $student->age }}</p>
                </div>
                <div class="flex justify-between items-center">
                    <label class="text-gray-600 font-medium">Place of Birth:</label>
                    <p class="text-gray-700">{{ $student->place_of_birth }}</p>
                </div>
                <div class="flex justify-between items-center">
                    <label class="text-gray-600 font-medium">Address:</label>
                    <p class="text-gray-700">{{ $student->home_address }}</p>
                </div>
            </div>
        </div>
    </div>



    
    <div class="p-6">
    <div class="space-y-4">
        <!-- Tab Navigation -->
        <div class="border-b border-gray-300">
            <ul class="flex flex-wrap space-x-2 sm:space-x-4 overflow-x-auto">
                <li class="cursor-pointer py-2 px-4 hover:bg-gray-200" id="motherTab">Mother</li>
                <li class="cursor-pointer py-2 px-4 hover:bg-gray-200" id="fatherTab">Father</li>
                <li class="cursor-pointer py-2 px-4 hover:bg-gray-200" id="guardianTab">Guardian</li>
                <li class="cursor-pointer py-2 px-4 hover:bg-gray-200" id="livingTab">Living Situation</li>
            </ul>
        </div>

        <!-- Responsive Table -->
        <div id="motherShelf" class="mt-4 overflow-x-auto">
            <table class="w-full border-collapse min-w-[300px] sm:min-w-full">
                <tbody>
                <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Mother's Name</td>
                        <td class="p-4 text-gray-700">{{ $student->mothers_name }}</td>
                    </tr>
                    <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Educational Attainment</td>
                        <td class="p-4 text-gray-700">{{ $student->mothers_educational_attainment }}</td>
                    </tr>
                    <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Address</td>
                        <td class="p-4 text-gray-700">{{ $student->mothers_address }}</td>
                    </tr>
                    <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Contact Number</td>
                        <td class="p-4 text-gray-700">{{ $student->mothers_contact_number }}</td>
                    </tr>
                    <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Occupation</td>
                        <td class="p-4 text-gray-700">{{ $student->mothers_occupation }}</td>
                    </tr>
                    <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Employer</td>
                        <td class="p-4 text-gray-700">{{ $student->mothers_employer }}</td>
                    </tr>
                    <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Employer's Address</td>
                        <td class="p-4 text-gray-700">{{ $student->mothers_employer_address }}</td>
                    </tr>
                 
                </tbody>
            </table>
        </div>


        <div id="fatherShelf" class="mt-4 overflow-x-auto " style="display: none;">
            <table class="w-full border-collapse min-w-[300px] sm:min-w-full">
                <tbody>
                <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Fathers's Name</td>
                        <td class="p-4 text-gray-700">{{ $student->fathers_name }}</td>
                    </tr>
                    <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Educational Attainment</td>
                        <td class="p-4 text-gray-700">{{ $student->fathers_educational_attainment }}</td>
                    </tr>
                    <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Address</td>
                        <td class="p-4 text-gray-700">{{ $student->fathers_address }}</td>
                    </tr>
                    <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Contact Number</td>
                        <td class="p-4 text-gray-700">{{ $student->fathers_contact_number }}</td>
                    </tr>
                    <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Occupation</td>
                        <td class="p-4 text-gray-700">{{ $student->fathers_occupation }}</td>
                    </tr>
                    <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Employer</td>
                        <td class="p-4 text-gray-700">{{ $student->fathers_employer }}</td>
                    </tr>
                    <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Employer's Address</td>
                        <td class="p-4 text-gray-700">{{ $student->fathers_employer_address }}</td>
                    </tr>
                </tbody>
            </table>
        </div>


        <div id="guardianShelf" class="mt-4 overflow-x-auto " style="display: none;">
            <table class="w-full border-collapse min-w-[300px] sm:min-w-full">
                <tbody>
                <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Guardians's Name</td>
                        <td class="p-4 text-gray-700">{{ $student->guardians_name }}</td>
                    </tr>
                    <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Educational Attainment</td>
                        <td class="p-4 text-gray-700">{{ $student->guardians_educational_attainment }}</td>
                    </tr>
                    <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Address</td>
                        <td class="p-4 text-gray-700">{{ $student->guardians_address }}</td>
                    </tr>
                    <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Contact Number</td>
                        <td class="p-4 text-gray-700">{{ $student->guardians_contact_number }}</td>
                    </tr>
                    <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Occupation</td>
                        <td class="p-4 text-gray-700">{{ $student->guardians_occupation }}</td>
                    </tr>
                    <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Employer</td>
                        <td class="p-4 text-gray-700">{{ $student->guardians_employer }}</td>
                    </tr>
                    <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Employer's Address</td>
                        <td class="p-4 text-gray-700">{{ $student->guardians_employer_address }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="livingShelf" class="mt-4 overflow-x-auto " style="display: none;">
            <table class="w-full border-collapse min-w-[300px] sm:min-w-full">
                <tbody>
                <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Guardians's Name</td>
                        <td class="p-4 text-gray-700">{{ $student->formatted_living_situation }}</td>
                    </tr>
                    <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Educational Attainment</td>
                        <td class="p-4 text-gray-700">{{ $student->living_address }}</td>
                    </tr>
                    <tr class="hover:bg-gray-100 border-t border-gray-300">
                        <td class="p-4 text-gray-600 font-medium whitespace-nowrap">Address</td>
                        <td class="p-4 text-gray-700">{{ $student->living_contact_number }}</td>
                    </tr>
                 
                </tbody>
            </table>
        </div>


        <!-- Repeat for Father, Guardian, and Living Situation with appropriate IDs -->
    </div>
</div>





          
        </div>
    </div>
</div>


<script>
    document.getElementById('motherTab').addEventListener('click', function() {
        switchShelf('motherShelf');
    });
    document.getElementById('fatherTab').addEventListener('click', function() {
        switchShelf('fatherShelf');
    });
    document.getElementById('guardianTab').addEventListener('click', function() {
        switchShelf('guardianShelf');
    });
    document.getElementById('livingTab').addEventListener('click', function() {
        switchShelf('livingShelf');
    });

    function switchShelf(shelfId) {
        // Hide all shelves by setting display to none
        const shelves = document.querySelectorAll('[id$="Shelf"]');
        shelves.forEach(shelf => shelf.style.display = 'none');

        // Show the selected shelf
        document.getElementById(shelfId).style.display = 'block';
    }
</script>
</x-app-layout>
 