<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Permissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-success-message />
            <x-input-error :messages="$errors->all()" />

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-5">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="space-y-12">


                            <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-base/7 font-semibold text-gray-900">Permission</h2>
                                <p class="mt-1 text-sm/6 text-gray-600">This information will be displayed publicly so
                                    be
                                    careful what you share.</p>

                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="name"
                                            class="block text-sm/6 font-medium text-gray-900">Name</label>
                                        <div class="mt-2">
                                            <input type="text" name="name" id="name"
                                                autocomplete="given-name" value="{{ $permission->name }}"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                        </div>
                                    </div>


                                    {{-- <div class="sm:col-span-3">
                                        <label for="permissions"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                                            Permissions</label>
                                        <select multiple id="permissions" name="permissions[]"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option disabled>Choose permissions</option>
                                            @foreach ($permissions as $permission)
                                                <option value="{{ $permission->id }}"
                                                    {{ in_array($permission->id, old('permissions', $permission->permissions->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                    {{ $permission->name }}</option>
                                            @endforeach

                                        </select>
                                    </div> --}}

                                </div>
                            </div>

                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <x-cancel-button>Cancel</x-cancel-button>
                            <x-delete-button form="delete-form">Delete</x-delete-button>
                            <x-button>Save</x-button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('permissions.destroy', $permission->id) }}" id="delete-form" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
