<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">User Management</h1>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('users.index') }}" class="mb-4 flex space-x-4">
            <!-- Search Input -->
            <input type="text" name="search" placeholder="Search by name or email" 
                   value="{{ old('search', request('search')) }}"
                   class="border-gray-300 rounded p-2 w-64"
            />

            <!-- Role Filter -->
            <select name="role" class="border-gray-300 rounded p-2 px-6">
                <option value="">All Roles</option>
                @foreach (['admin', 'professor', 'student'] as $role)
                    <option value="{{ $role }}" {{ request('role') == $role ? 'selected' : '' }}>
                        {{ ucfirst($role) }}
                    </option>
                @endforeach
            </select>

            <!-- Apply Filters Button -->
            <button type="submit" class="px-8 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition">
                Apply Filters
            </button>

            <!-- Reset Button -->
            <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-600 transition">
                Reset
            </a>
        </form>

        <!-- Table visible on large screens -->
        <div class="hidden lg:block">
            <table class="table-auto w-full border-t border-b border-gray-300 shadow-sm bg-white">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="px-4 py-4 border-b border-gray-300">#</th>
                        <th class="px-4 py-4 border-b border-gray-300">Name</th>
                        <th class="px-4 py-4 border-b border-gray-300">Email</th>
                        <th class="px-4 py-4 border-b border-gray-300">Username</th>
                        <th class="px-4 py-4 border-b border-gray-300">Roles</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-200 transition duration-200 border-gray-40">
                            <td class="px-4 py-4 border-b border-gray-300">
                                {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                            </td>
                            <td class="px-4 py-4 border-b border-gray-300">{{ $user->name }}</td>
                            <td class="px-4 py-4 border-b border-gray-300">{{ $user->email }}</td>
                            <td class="px-4 py-4 border-b border-gray-300">{{ $user->username }}</td>
                            <td class="px-4 py-4 border-b border-gray-300">
                                @foreach ($user->roles as $role)
                                    @php
                                        // Define background colors for each role
                                        $roleColors = [
                                            'admin' => 'bg-red-500',       // Red for Admin
                                            'professor' => 'bg-blue-500',  // Blue for Professor
                                            'student' => 'bg-green-500',   // Green for Student
                                        ];
                                        // Assign default gray if role is not listed
                                        $bgColor = $roleColors[$role->name] ?? 'bg-gray-500';
                                    @endphp

                                    <span class="inline-block {{ $bgColor }} text-white text-sm px-2 rounded">
                                        {{ $role->name }}
                                    </span>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Cards visible on small screens -->
        <div class="sm:hidden">
            <div class="grid gap-6">
                @foreach ($users as $user)
                    <div class="border border-gray-300 p-4 rounded-lg shadow-sm bg-white">
                        <h3 class="text-xl font-semibold">{{ $user->name }}</h3>
                        <p class="text-gray-600">Email: {{ $user->email }}</p>
                        <p class="text-gray-600">Username: {{ $user->username }}</p>
                        <div class="mt-2">
                            @foreach ($user->roles as $role)
                                <span class="inline-block bg-blue-500 text-white text-sm px-2 py-1 rounded mb-2">
                                    {{ $role->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $users->appends(request()->query())->links() }} <!-- Display pagination links -->
        </div>

    </div>
</x-app-layout>
