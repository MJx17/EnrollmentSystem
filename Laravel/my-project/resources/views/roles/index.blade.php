<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-success-message class="mb-5" />
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <span class="flex justify-end">
                        <a href="{{ route('roles.create') }}">
                            <x-button href="">Create Role</x-button></a>
                        {{-- <a href="{{ route('roles.create') }}">asdsa</a> --}}
                    </span>
                    <hr class="my-6 border-gray-700 dark:border-gray-300">
                    <ul role="list" class="divide-y divide-gray-100">
                        @foreach ($roles as $role)
                            <a href="{{ route('roles.edit', $role->id) }}">
                                <li class="flex justify-between gap-x-6 py-5">
                                    <div class="flex min-w-0 gap-x-4">
                                        <div class="min-w-0 flex-auto">
                                            <p class="text-lg/6 font-semibold text-gray-900">{{ $role->name }}</p>
                                        </div>
                                    </div>
                                    <div class="hidden shrink-0 lg:flex lg:flex-col lg:items-end">
                                        {{-- <p class="text-lg/6 text-gray-900">{{ $account->role->name }}</p> --}}
                                        <p class="mt-1 text-sm/5 text-gray-500">Created At <time
                                                datetime="2023-01-23T13:23Z">{{ $role->created_at->format('Y-m-d') }}</time>
                                        </p>
                                    </div>
                                </li>
                            </a>
                        @endforeach
                    </ul>
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
