<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student') }}
        </h2>
    </x-slot>

    @if($user->student)
    <p>You are already signed up. <a href="{{ route('student.indexStudent') }}" class="text-blue-500 underline">Go to Student Info</a></p>
    @else
    <p>You are not signed up yet.</p>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('student.store') }}" method="POST" class="form-container w-full  mx-auto p-12 bg-white shadow-lg rounded-lg" enctype="multipart/form-data">
            @csrf
            <h2 class="text-2xl text-center font-semibold mb-4">Student Enrollment Form</h2>




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
                            src="{{ $image ?? 'https://via.placeholder.com/150' }}"
                            alt="Image Placeholder"
                            class="w-full h-full object-cover">
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
                    <input type="text" id="surname" name="surname" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Surname" required>
                </div>
                <div class="flex flex-col">
                    <input type="text" id="first_name" name="first_name" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="First Name" required>
                </div>
                <div class="flex flex-col">
                    <input type="text" id="middle_name" name="middle_name" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Middle Name (optional)">
                </div>
                <div class="flex flex-col">
                    <select id="sex" name="sex" class="mt-2 p-2 border border-gray-300 rounded-md">
                        <option value="" disabled selected>Select Sex</option> <!-- Placeholder option -->
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="flex flex-col">
                    <input type="date" id="dob" name="dob" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Date of Birth" required>
                </div>
                <div class="flex flex-col">
                    <input type="number" id="age" name="age" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Age" required>
                </div>
                <div class="flex flex-col">
                    <input type="text" id="place_of_birth" name="place_of_birth" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Place of Birth" required>
                </div>
                <div class="flex flex-col">
                    <input type="text" id="home_address" name="home_address" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Home Address" required>
                </div>
                <div class="flex flex-col">
                    <input type="text" id="mobile_number" name="mobile_number" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Mobile Number" required>
                </div>
                <div class="flex flex-col">
                    <input type="email" id="email_address" name="email_address" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Email Address" required>
                </div>





            </div>

            <!-- Father's Information -->
            <h3 class="text-xl font-semibold mb-4">Father's Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                <div class="flex flex-col">
                    <input type="text" id="fathers_name" name="fathers_name" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Father's Name" required>
                </div>
                <div class="flex flex-col">
                    <input type="text" id="fathers_educational_attainment" name="fathers_educational_attainment" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Father's Educational Attainment" required>
                </div>
                <div class="flex flex-col">
                    <input type="text" id="fathers_address" name="fathers_address" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Father's Address" required>
                </div>
                <div class="flex flex-col">
                    <input type="text" id="fathers_contact_number" name="fathers_contact_number" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Father's Contact Number" required>
                </div>
                <div class="flex flex-col">
                    <input type="text" id="fathers_occupation" name="fathers_occupation" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Father's Occupation" required>
                </div>
                <div class="flex flex-col">
                    <input type="text" id="fathers_employer" name="fathers_employer" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Father's Employer" required>
                </div>
                <div class="flex flex-col">
                    <input type="text" id="fathers_employer_address" name="fathers_employer_address" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Father's Employer Address" required>
                </div>
            </div>


            <!-- Mother's Information -->
            <h3 class="text-xl font-semibold mb-4">Mother's Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                <div class="flex flex-col">
                    <input type="text" id="mothers_name" name="mothers_name" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Mother's Name" required>
                </div>
                <div class="flex flex-col">
                    <input type="text" id="mothers_educational_attainment" name="mothers_educational_attainment" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Mother's Educational Attainment" required>
                </div>
                <div class="flex flex-col">
                    <input type="text" id="mothers_address" name="mothers_address" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Mother's Address" required>
                </div>
                <div class="flex flex-col">
                    <input type="text" id="mothers_contact_number" name="mothers_contact_number" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Mother's Contact Number" required>
                </div>
                <div class="flex flex-col">
                    <input type="text" id="mothers_occupation" name="mothers_occupation" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Mother's Occupation" required>
                </div>
                <div class="flex flex-col">
                    <input type="text" id="mothers_employer" name="mothers_employer" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Mother's Employer" required>
                </div>
                <div class="flex flex-col">
                    <input type="text" id="mothers_employer_address" name="mothers_employer_address" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Mother's Employer Address" required>
                </div>
            </div>

            <!-- Guardian's Information (Optional) -->
            <h3 class="text-xl font-semibold mb-4">Guardian's Information (if applicable)</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                <div class="flex flex-col">
                    <input type="text" id="guardians_name" name="guardians_name" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Guardian's Name">
                </div>
                <div class="flex flex-col">
                    <input type="text" id="guardians_educational_attainment" name="guardians_educational_attainment" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Guardian's Educational Attainment">
                </div>
                <div class="flex flex-col">
                    <input type="text" id="guardians_address" name="guardians_address" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Guardian's Address">
                </div>
                <div class="flex flex-col">
                    <input type="text" id="guardians_contact_number" name="guardians_contact_number" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Guardian's Contact Number">
                </div>
                <div class="flex flex-col">
                    <input type="text" id="guardians_occupation" name="guardians_occupation" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Guardian's Occupation">
                </div>
            </div>

            <h3 class="text-xl font-semibold mb-4">Living Situation</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">

                <!-- Living Situation -->
                <div class="flex flex-col">
                    <select id="living_situation" name="living_situation" class="mt-2 p-2 border border-gray-300 rounded-md">
                        <option value="" disabled selected>Select Living Situation</option> <!-- Default placeholder -->
                        <option value="with_family">With Family</option>
                        <option value="with_relatives">With Relatives</option>
                        <option value="with_guardian">With Guardian</option>
                        <option value="boarding_house">Boarding House</option>
                    </select>
                </div>

                <!-- Living Address -->
                <div class="flex flex-col">
                    <input type="text" id="living_address" name="living_address" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Living Address">
                </div>

                <!-- Living Contact Number -->
                <div class="flex flex-col">
                    <input type="text" id="living_contact_number" name="living_contact_number" class="mt-2 p-2 border border-gray-300 rounded-md" placeholder="Living Contact Number">
                </div>

            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Submit</button>
            </div>

        </form>
        @endif
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