<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Permissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <x-success-message class="mb-5" />
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <span class="flex justify-end">
                        <a href="{{ route('permissions.create') }}" class="inline-block">
                            <x-button href="">Create Permission</x-button>
                        </a>
                    </span>
                    <hr class="my-6 border-gray-700 dark:border-gray-300">
                    <ul role="list" class="divide-y divide-gray-100">
                        @foreach ($permissions as $permission)
                            <a href="{{ route('permissions.edit', $permission->id) }}">
                                <li class="flex justify-between gap-x-6 py-5">
                                    <div class="flex min-w-0 gap-x-4">
                                        <div class="min-w-0 flex-auto">
                                            <p class="text-lg/6 font-semibold text-gray-900">{{ $permission->name }}</p>
                                        </div>
                                    </div>
                                    <div class="hidden shrink-0 lg:flex lg:flex-col lg:items-end">
                                        {{-- <p class="text-lg/6 text-gray-900">{{ $account->role->name }}</p> --}}
                                        <p class="mt-1 text-sm/5 text-gray-500">Created At <time
                                                datetime="2023-01-23T13:23Z">{{ $permission->created_at->format('Y-m-d') }}</time>
                                        </p>
                                    </div>
                                </li>
                            </a>
                        @endforeach
                    </ul>
                    {{ $permissions->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
