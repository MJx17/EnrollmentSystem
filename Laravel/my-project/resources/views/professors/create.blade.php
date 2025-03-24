<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-900 p-6 rounded-lg shadow-md mt-6 border border-gray-200 dark:border-gray-800">
        <form action="{{ route('professors.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="user_id" class="block text-sm text-gray-700 dark:text-gray-300">Professor</label>
                    <select name="user_id" id="user_id" class="w-full border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white rounded-md p-2">
                        <option value="">-- Select --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->first_name }} {{ $user->surname }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="surname" class="block text-sm text-gray-700 dark:text-gray-300">Surname</label>
                    <input type="text" name="surname" id="surname" value="{{ old('surname') }}" class="w-full border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white rounded-md p-2">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="first_name" class="block text-sm text-gray-700 dark:text-gray-300">First Name</label>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="w-full border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white rounded-md p-2">
                </div>
                <div>
                    <label for="middle_name" class="block text-sm text-gray-700 dark:text-gray-300">Middle Name</label>
                    <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name') }}" class="w-full border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white rounded-md p-2">
                </div>
                <div>
                    <label for="sex" class="block text-sm text-gray-700 dark:text-gray-300">Sex</label>
                    <select name="sex" id="sex" class="w-full border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white rounded-md p-2">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="contact_number" class="block text-sm text-gray-700 dark:text-gray-300">Contact</label>
                    <input type="text" name="contact_number" id="contact_number" value="{{ old('contact_number') }}" class="w-full border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white rounded-md p-2">
                </div>
                <div>
                    <label for="email" class="block text-sm text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white rounded-md p-2">
                </div>
            </div>

            <div>
                <label for="designation" class="block text-sm text-gray-700 dark:text-gray-300">Designation</label>
                <input type="text" name="designation" id="designation" value="{{ old('designation') }}" class="w-full border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white rounded-md p-2">
            </div>

            <!-- Button aligned to the bottom right -->
            <div class="flex justify-end gap-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition">
                    Save
                </button>
                <a href="{{ route('professors.index') }}" class="px-4 py-2 bg-red-500 text-white text-sm font-semibold rounded-md hover:bg-red-600 focus:ring-2 focus:ring-gray-500">
                        Cancel
                 </a>
            </div>

        </form>
    </div>


</x-app-layout>
