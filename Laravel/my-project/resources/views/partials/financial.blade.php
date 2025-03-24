<!-- Financier -->

<div class="grid grid-cols-1 md:grid-cols-2 gap-8 ">

    <div class="">
        <h3 class="text-lg font-semibold text-blue-800 dark:text-white mb-5">Financial Information</h3>

        <!-- Financier Select -->
        <div class="mb-4">
            <select name="financier" id="financier" class="mt-1 block w-full p-3 rounded-md border-gray-300 shadow-sm">
                <option value="" disabled {{ old('financier') ? '' : 'selected' }}>Select Financier</option>
                <option value="Parents" {{ old('financier') == 'Parents' ? 'selected' : '' }}>Parents</option>
                <option value="Relatives" {{ old('financier') == 'Relatives' ? 'selected' : '' }}>Relatives</option>
                <option value="Guardian" {{ old('financier') == 'Guardian' ? 'selected' : '' }}>Guardian</option>
                <option value="Myself" {{ old('financier') == 'Myself' ? 'selected' : '' }}>Myself</option>
                <option value="Myself" {{ old('financier') == 'Others' ? 'selected' : '' }}>Others</option>
            </select>
            @error('financier')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Scholarship Information -->
        <div class="mb-4">
            <input type="text" name="scholarship" id="scholarship"
                class="mt-1 block w-full p-3 rounded-md border-gray-300 shadow-sm" placeholder="Scholarship"
                value="{{ old('scholarship') }}">
            @error('scholarship')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Income Information -->
        <div class="mb-4">
            <input type="text" name="income" id="income"
                class="mt-1 block w-full p-3 rounded-md border-gray-300 shadow-sm" placeholder="Income"
                value="{{ old('income') }}">
            @error('income')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Company Name and Address -->
        <div class="mb-4">
            <input type="text" name="company_name" id="company_name"
                class="mt-1 block w-full p-3 rounded-md border-gray-300 shadow-sm" placeholder="Company Name"
                value="{{ old('company_name') }}">
            @error('company_name')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <input type="text" name="company_address" id="company_address"
                class="mt-1 block w-full p-3 rounded-md border-gray-300 shadow-sm" placeholder="Company Address"
                value="{{ old('company_address') }}">
            @error('company_address')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <input type="text" name="contact_number" id="contact_number"
                class="mt-1 block w-full p-3 rounded-md border-gray-300 shadow-sm" placeholder="Contact Number"
                value="{{ old('contact_number') }}">
            @error('contact_number')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
    </div>


    <!-- Relative Information -->
    <!-- Relative Information -->
    <div class="">
        <div class="flex justify-between items-center w-full">
            <h3 class="text-lg font-semibold text-blue-800 dark:text-white mb-5">Relative Information</h3>
            <button type="button" id="add-relative"
                class="mt-2 text-white flex justify-between items-center bg-blue-700 p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Add
            </button>
        </div>

        <div id="relative-info-container">
            @php
            // For a create form, provide one default empty row.
            $relativeNames = [''];
            $relationships = [''];
            $positionCourses = [''];
            $relativeContactNumbers = [''];
            @endphp

            <div id="relative-entries">
                @foreach($relativeNames as $index => $name)
                <div class="relative-entry flex flex-col border-b hover:bg-gray-300 bg-gray-200">
                    <!-- Accordion Button -->
                    <div class="relative-entry-header px-4 py-3 flex justify-between items-center cursor-pointer">
                        <span class="text-lg font-medium text-gray-700">Relative </span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 5.25 7.5 7.5 7.5-7.5m-15 6 7.5 7.5 7.5-7.5" />
                            </svg>

                    </div>

                    <!-- Accordion Content -->
                    <div class="relative-entry-details px-4 py-3 hidden" id="relative-entry-details-{{ $index }}">
                        <div class="px-4 py-2">
                            <input type="text" name="relative_names[{{ $index }}]"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out"
                                placeholder="Name" value="">
                        </div>
                        <div class="px-4 py-2">
                            <input type="text" name="relationships[{{ $index }}]"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out"
                                placeholder="Relationship" value="">
                        </div>
                        <div class="px-4 py-2">
                            <input type="text" name="position_courses[{{ $index }}]"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out"
                                placeholder="Position/Course" value="">
                        </div>
                        <div class="px-4 py-2">
                            <input type="text" name="relative_contact_numbers[{{ $index }}]"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out"
                                placeholder="Contact Number" value="">
                        </div>
                    </div>

                    <!-- Remove Button -->
                    <div class="px-4 py-2 text-center flex justify-end">
                        <button type="button"
                            class="remove-relative text-red-600 hover:text-red-800 font-semibold rounded-md transition duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        @error('relative_names') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        @error('relationships') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        @error('position_courses') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        @error('relative_contact_numbers') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>



</div>












<script>
document.addEventListener('DOMContentLoaded', function() {
    const addRelativeButton = document.getElementById('add-relative');
    const container = document.getElementById('relative-entries');

    // Function to handle both adding a new relative and toggling the accordion visibility
    function addRelative() {
        const firstEntry = document.querySelector('.relative-entry');
        if (!firstEntry) return; // Safety check
        const newEntry = firstEntry.cloneNode(true);
        const entryCount = container.querySelectorAll('.relative-entry').length;

        // Update each input in the cloned row with the new index
        newEntry.querySelectorAll('input').forEach((input) => {
            input.value = ''; // Clear the value
            const name = input.getAttribute('name');
            const updatedName = name.replace(/\[\d+\]/, `[${entryCount}]`);
            input.setAttribute('name', updatedName);
        });

        // Attach remove functionality
        const removeButton = newEntry.querySelector('.remove-relative');
        removeButton.addEventListener('click', function() {
            if (container.querySelectorAll('.relative-entry').length > 1) {
                newEntry.remove();
            } else {
                newEntry.querySelectorAll('input').forEach(input => input.value = '');
            }
        });

        // Add accordion functionality for new entry
        const accordionHeader = newEntry.querySelector('.relative-entry-header');
        const accordionDetails = newEntry.querySelector('.relative-entry-details');
        const accordionIcon = accordionHeader.querySelector('svg');

        accordionHeader.addEventListener('click', function() {
            accordionDetails.classList.toggle('hidden');
            accordionIcon.classList.toggle('rotate-90');
        });

        container.appendChild(newEntry);
    }

    addRelativeButton.addEventListener('click', addRelative);

    // Attach remove event for initial rows
    container.querySelectorAll('.remove-relative').forEach(button => {
        button.addEventListener('click', function() {
            const currentRows = container.querySelectorAll('.relative-entry');
            if (currentRows.length > 1) {
                button.closest('.relative-entry').remove();
            } else {
                button.closest('.relative-entry').querySelectorAll('input').forEach(input =>
                    input.value = '');
            }
        });
    });

    // Attach initial accordion functionality
    document.querySelectorAll('.relative-entry-header').forEach((header, index) => {
        const details = document.getElementById(`relative-entry-details-${index}`);
        const icon = header.querySelector('svg');

        header.addEventListener('click', function() {
            details.classList.toggle('hidden');
            icon.classList.toggle('rotate-90');
        });
    });
});
</script>