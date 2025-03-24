<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Student') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <h2 class="text-2xl text-center font-semibold mb-4">Student Enrollment Form</h2>
                <div class="flex flex-col md:flex-row justify-center items-center w-full gap-4">
                </div>

                <div class="flex flex-col md:flex-row justify-evenly items-center w-full gap-4">
                    <!-- Image -->
                    <div class="w-40 h-40 overflow-hidden">
                        <img
                            id="logo-preview"
                            src="/logo.jpg"
                            alt="Logo"
                            class="w-full h-full object-cover">
                    </div>

                    <!-- Text Info -->
                    <div class="text-center md:text-left">
                        <h2 class="text-2xl font-semibold">Amando Cope College</h2>
                        <p class="text-xl  mt-2">Baranghawon, Tabaco City</p>
                        <p class="text-xl ">(052) 487-4455</p>
                    </div>


                    <!-- Image Upload Section -->
                    <div class="flex flex-col items-center md:items-end justify-start gap-2 p-4 w-48">
                        <!-- Image Preview -->
                        <div class="w-40 h-40 border border-gray-200 rounded-md overflow-hidden">
                            <img
                                id="image-preview"
                                src="{{ $student->image ? asset('storage/' . $student->image) : 'https://via.placeholder.com/150' }}"
                                alt="Image Placeholder"
                                class="w-full h-full object-cover" />

                        </div>


                        <!-- Upload Button -->
                        <button
                            type="button"
                            onclick="document.getElementById('image').click()"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600 w-full ">
                            📸 Upload Image
                        </button>
                    </div>

                    <!-- Hidden File Input -->
                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/*"
                        class="hidden"
                        onchange="previewImage(event)">
                </div>


                <!-- Personal Information -->
                <h3 class="text-xl font-semibold mb-4">Personal Information</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                    <div class="flex flex-col">
                        <input type="text" id="surname" name="surname" class="mt-2 p-2 border border-gray-300 rounded-md"
                            placeholder="Surname" value="{{ old('surname', $student->surname ?? '') }}" required>
                    </div>
                    <div class="flex flex-col">
                        <input type="text" id="first_name" name="first_name" class="mt-2 p-2 border border-gray-300 rounded-md"
                            placeholder="First Name" value="{{ old('first_name', $student->first_name ?? '') }}" required>
                    </div>
                    <div class="flex flex-col">
                        <input type="text" id="middle_name" name="middle_name" class="mt-2 p-2 border border-gray-300 rounded-md"
                            placeholder="Middle Name (optional)" value="{{ old('middle_name', $student->middle_name ?? '') }}">
                    </div>
                    <div class="flex flex-col">
                        <select id="sex" name="sex" class="mt-2 p-2 border border-gray-300 rounded-md">
                            <option value="" disabled>Select Sex</option>
                            <option value="Male" {{ old('sex', $student->sex ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('sex', $student->sex ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('sex', $student->sex ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <input type="date" id="dob" name="dob" class="mt-2 p-2 border border-gray-300 rounded-md"
                            value="{{ old('dob', $student->dob ?? '') }}" required>
                    </div>
                    <div class="flex flex-col">
                        <input type="number" id="age" name="age" class="mt-2 p-2 border border-gray-300 rounded-md"
                            placeholder="Age" value="{{ old('age', $student->age ?? '') }}" required>
                    </div>
                    <div class="flex flex-col">
                        <input type="text" id="place_of_birth" name="place_of_birth" class="mt-2 p-2 border border-gray-300 rounded-md"
                            placeholder="Place of Birth" value="{{ old('place_of_birth', $student->place_of_birth ?? '') }}" required>
                    </div>
                    <div class="flex flex-col">
                        <input type="text" id="home_address" name="home_address" class="mt-2 p-2 border border-gray-300 rounded-md"
                            placeholder="Home Address" value="{{ old('home_address', $student->home_address ?? '') }}" required>
                    </div>
                    <div class="flex flex-col">
                        <input type="text" id="mobile_number" name="mobile_number" class="mt-2 p-2 border border-gray-300 rounded-md"
                            placeholder="Mobile Number" value="{{ old('mobile_number', $student->mobile_number ?? '') }}" required>
                    </div>
                    <div class="flex flex-col">
                        <input type="email" id="email_address" name="email_address" class="mt-2 p-2 border border-gray-300 rounded-md"
                            placeholder="Email Address" value="{{ old('email_address', $student->email_address ?? '') }}" required>
                    </div>
                </div>



                <!-- Father's Information -->
                <h3 class="text-xl font-semibold mb-4">Father's Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                    <div class="flex flex-col">
                        <input type="text" id="fathers_name" name="fathers_name" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Father's Name"
                            value="{{ old('fathers_name', $student->fathers_name ?? '') }}" required>
                    </div>
                    <div class="flex flex-col">
                        <input type="text" id="fathers_educational_attainment" name="fathers_educational_attainment" class="mt-2 p-2 border border-gray-300 rounded-md"
                            placeholder="Father's Educational Attainment" value="{{ old('fathers_educational_attainment', $student->fathers_educational_attainment ?? '') }}">
                    </div>
                    <div class="flex flex-col">
                        <input type="text" id="fathers_address" name="fathers_address" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Father's Address"
                            value="{{ old('fathers_address', $student->fathers_address ?? '') }}" required>
                    </div>
                    <div class="flex flex-col">
                        <input type="text" id="fathers_contact_number" name="fathers_contact_number" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Father's Contact Number"
                            value="{{ old('fathers_contact_number', $student->fathers_contact_number ?? '') }}" required>
                    </div>
                    <div class="flex flex-col">
                        <input type="text" id="fathers_occupation" name="fathers_occupation" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Father's Occupation"
                            value="{{ old('fathers_occupation', $student->fathers_occupation ?? '') }}" required>
                    </div>
                    <div class="flex flex-col">
                        <input type="text" id="fathers_employer" name="fathers_employer" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Father's Employer"
                            value="{{ old('fathers_employer', $student->fathers_employer ?? '') }}" required>
                    </div>
                    <div class="flex flex-col">
                        <input type="text" id="fathers_employer_address" name="fathers_employer_address" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Father's Employer Address"
                            value="{{ old('fathers_employer_address', $student->fathers_employer_address ?? '') }}" required>
                    </div>
                </div>

                <!-- Mother's Information -->
                <h3 class="text-xl font-semibold mb-4">Mother's Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                    <div class="flex flex-col">
                        <input type="text" id="mothers_name" name="mothers_name" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Mother's Name"
                            value="{{ old('mothers_name', $student->mothers_name ?? '') }}" required>
                    </div>
                    <div class="flex flex-col">
                        <input type="text" id="mothers_educational_attainment" name="mothers_educational_attainment" class="mt-2 p-2 border border-gray-300 rounded-md"
                            placeholder="Mother's Educational Attainment" value="{{ old('mothers_educational_attainment', $student->mothers_educational_attainment ?? '') }}">
                    </div>
                    <div class="flex flex-col">
                        <input type="text" id="mothers_address" name="mothers_address" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Mother's Address"
                            value="{{ old('mothers_address', $student->mothers_address ?? '') }}" required>
                    </div>
                    <div class="flex flex-col">
                        <input type="text" id="mothers_contact_number" name="mothers_contact_number" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Mother's Contact Number"
                            value="{{ old('mothers_contact_number', $student->mothers_contact_number ?? '') }}" required>
                    </div>
                    <div class="flex flex-col">
                        <input type="text" id="mothers_occupation" name="mothers_occupation" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Mother's Occupation"
                            value="{{ old('mothers_occupation', $student->mothers_occupation ?? '') }}" required>
                    </div>
                    <div class="flex flex-col">
                        <input type="text" id="mothers_employer" name="mothers_employer" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Mother's Employer"
                            value="{{ old('mothers_employer', $student->mothers_employer ?? '') }}" required>
                    </div>
                    <div class="flex flex-col">
                        <input type="text" id="mothers_employer_address" name="mothers_employer_address" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Mother's Employer Address"
                            value="{{ old('mothers_employer_address', $student->mothers_employer_address ?? '') }}" required>
                    </div>
                </div>



                <!-- Guardian's Information (Optional) -->
                <h3 class="text-xl font-semibold mb-4">Guardian's Information (if applicable)</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                    <div class="flex flex-col">
                        <input type="text" id="guardians_name" name="guardians_name" class="mt-2 p-2 border border-gray-300 rounded-md"
                            placeholder="Guardian's Name" value="{{ old('guardians_name', $student->guardians_name ?? '') }}">
                    </div>
                    <div class="flex flex-col">
                        <input type="text" id="guardians_educational_attainment" name="guardians_educational_attainment"
                            class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Guardian's Educational Attainment"
                            value="{{ old('guardians_educational_attainment', $student->guardians_educational_attainment ?? '') }}">
                    </div>
                    <div class="flex flex-col">
                        <input type="text" id="guardians_address" name="guardians_address" class="mt-2 p-2 border border-gray-300 rounded-md"
                            placeholder="Guardian's Address" value="{{ old('guardians_address', $student->guardians_address ?? '') }}">
                    </div>
                    <div class="flex flex-col">
                        <input type="text" id="guardians_contact_number" name="guardians_contact_number"
                            class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Guardian's Contact Number"
                            value="{{ old('guardians_contact_number', $student->guardians_contact_number ?? '') }}">
                    </div>
                    <div class="flex flex-col">
                        <input type="text" id="guardians_occupation" name="guardians_occupation"
                            class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Guardian's Occupation"
                            value="{{ old('guardians_occupation', $student->guardians_occupation ?? '') }}">
                    </div>
                </div>

                <h3 class="text-xl font-semibold mb-4">Living Situation</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">

                    <!-- Living Situation -->
                    <div class="flex flex-col">
                        <select id="living_situation" name="living_situation" class="mt-2 p-2 border border-gray-300 rounded-md">
                            <option value="" disabled {{ old('living_situation', $student->living_situation ?? '') == '' ? 'selected' : '' }}>Select Living Situation</option>
                            <option value="with_family" {{ old('living_situation', $student->living_situation ?? '') == 'with_family' ? 'selected' : '' }}>With Family</option>
                            <option value="with_relatives" {{ old('living_situation', $student->living_situation ?? '') == 'with_relatives' ? 'selected' : '' }}>With Relatives</option>
                            <option value="with_guardian" {{ old('living_situation', $student->living_situation ?? '') == 'with_guardian' ? 'selected' : '' }}>With Guardian</option>
                            <option value="boarding_house" {{ old('living_situation', $student->living_situation ?? '') == 'boarding_house' ? 'selected' : '' }}>Boarding House</option>
                        </select>
                    </div>

                    <!-- Living Address -->
                    <div class="flex flex-col">
                        <input type="text" id="living_address" name="living_address"
                            class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Living Address"
                            value="{{ old('living_address', $student->living_address ?? '') }}">
                    </div>

                    <!-- Living Contact Number -->
                    <div class="flex flex-col">
                        <input type="text" id="living_contact_number" name="living_contact_number"
                            class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Living Contact Number"
                            value="{{ old('living_contact_number', $student->living_contact_number ?? '') }}">
                    </div>

                </div>

                <!-- Submit Button -->
                <div class="mt-4 flex justify-end space-x-3">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white text-sm font-semibold rounded-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-500">
                        Update
                    </button>
                    <a href="{{ route('student.indexAdmin') }}" class="px-4 py-2 bg-gray-500 text-white text-sm font-semibold rounded-md hover:bg-gray-600 focus:ring-2 focus:ring-gray-500">
                        Cancel
                    </a>
                </div>
              
            </form>

            <!-- Show the enrollment form here -->



            <script>
                function previewImage(event) {
                    const input = event.target;
                    const preview = document.getElementById('image-preview');

                    if (input.files && input.files[0]) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            preview.src = e.target.result; // Update image preview
                        };

                        reader.readAsDataURL(input.files[0]);
                    } else {
                        preview.src = 'https://via.placeholder.com/150'; // Reset to placeholder
                    }
                }
            </script>
</x-app-layout>