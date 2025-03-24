<x-app-layout>
    <div class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 z-50">
        <div class="bg-white dark:bg-gray-900 shadow-lg rounded-2xl p-8 relative max-w-4xl w-full mx-6">
            
            <!-- Close Button (Inside the Card, Top-Right) -->
            <a href="{{ route('subjects.index') }}" 
                class="absolute -top-3 -right-3 bg-gray-200 dark:bg-gray-700 text-gray-500 hover:text-red-600 
                        text-2xl transition flex items-center justify-center w-8 h-8 rounded-full shadow-md">
                    ❌
                </a>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Left Side (Book Icon + Subject Overview) -->
                <div class="flex flex-col items-center text-center md:text-left">
                <div class="w-32 h-32 bg-indigo-500 text-white flex items-center justify-center rounded-full text-6xl">
                    📖
                </div>

                    <h3 class="mt-4 text-2xl font-bold text-gray-900 dark:text-gray-100">
                        {{ $subject->name }}
                    </h3>
                    <p class="text-lg text-gray-600 dark:text-gray-400">
                        {{ $subject->code }}
                    </p>
                </div>

                <!-- Right Side (Subject Details) -->
                <div class="space-y-6">
                    <div class="flex justify-between">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">👨‍🏫 Professor</h3>
                        <p class="text-lg text-gray-600 dark:text-gray-400">
                            {{ $subject->professor ? $subject->professor->full_name : 'N/A' }}
                        </p>
                    </div>
                    
                    <!-- <div class="flex justify-between">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">🏢 Block</h3>
                        <p class="text-lg text-gray-600 dark:text-gray-400">{{ $subject->block ?? 'N/A' }}</p>
                    </div> -->

                    <div class="flex justify-between">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">📆 Semester</h3>
                        <p class="text-lg text-gray-600 dark:text-gray-400">
                            {{ $subject->semester ? ucwords($subject->semester->semester) . ' Semester' : 'N/A' }}
                        </p>
                    </div>



                    <div class="flex justify-between">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">🎓 Year Level</h3>
                        <p class="text-lg text-gray-600 dark:text-gray-400">
                            {{ ucwords(str_replace('_', ' ', $subject->year_level)) }}
                        </p>
                    </div>


                    <div class="flex justify-between">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">✅ Prerequisite</h3>
                        <p class="text-lg text-gray-600 dark:text-gray-400">
                            {{ $subject->prerequisite ? $subject->prerequisite->name : 'None' }}
                        </p>
                    </div>

                    <div class="flex justify-between">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">💰 Fee</h3>
                        <p class="text-lg text-gray-600 dark:text-gray-400">{{ number_format($subject->fee, 2) }} PHP</p>
                    </div>

                    <div class="flex justify-between">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">📏 Units</h3>
                        <p class="text-lg text-gray-600 dark:text-gray-400">{{ $subject->units }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
