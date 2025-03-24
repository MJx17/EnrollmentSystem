<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Professor Profile
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center w-full bg-gray-100"> 
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 text-center 
                    w-full min-w-52 sm:max-w-md md:max-w-2xl lg:max-w-xl border-4 border-blue-500">
            <div class="mb-4">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($professor->first_name.' '.$professor->surname) }}&size=128"
                     alt="Profile Image"
                     class="w-24 h-24 rounded-full mx-auto">
            </div>

            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                {{ $professor->first_name }} {{ $professor->surname }}
            </h3>
            <p class="text-gray-500 dark:text-gray-300 text-sm">{{ $professor->designation }}</p>
            
            <div class="mt-4 text-gray-700 dark:text-gray-200">
            <div class="flex flex-col sm:flex-row justify-between border-b py-2">
                <span class="font-semibold">Email:</span>
                <span class="sm:text-right">{{ $professor->email }}</span>
            </div>
            <div class="flex flex-col sm:flex-row justify-between border-b py-2">
                <span class="font-semibold">Contact:</span>
                <span class="sm:text-right">{{ $professor->contact_number }}</span>
            </div>
            <div class="flex flex-col sm:flex-row justify-between py-2">
                <span class="font-semibold">Gender:</span>
                <span class="sm:text-right">{{ ucfirst($professor->sex) }}</span>
            </div>
        </div>

        </div>
    </div>
</x-app-layout>
