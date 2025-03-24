<!-- resources/views/livewire/dual-listbox.blade.php -->

<div class="flex space-x-4">
    <!-- Available List -->
    <div class="w-1/2">
        <label class="block text-sm font-medium text-gray-700">Available Subjects</label>
        <select multiple size="8" class="w-full form-select">
            @foreach ($subjects as $id => $name)
                <option value="{{ $id }}" wire:click="moveToSelected({{ $id }})">{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Controls -->
    <div class="flex flex-col justify-center space-y-2">
        <button type="button" class="bg-blue-500 text-white rounded-md px-4 py-2" wire:click="moveToSelected($event.target.previousElementSibling.value)">Add</button>
        <button type="button" class="bg-blue-500 text-white rounded-md px-4 py-2" wire:click="moveToAvailable($event.target.previousElementSibling.value)">Remove</button>
    </div>

    <!-- Selected List -->
    <div class="w-1/2">
        <label class="block text-sm font-medium text-gray-700">Selected Subjects</label>
        <select multiple size="8" class="w-full form-select">
            @foreach ($selectedSubjects as $id)
                <option value="{{ $id }}">{{ $subjects[$id] ?? '' }}</option>
            @endforeach
        </select>
    </div>
</div>
