<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Enrollment Details') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <!-- Student Information -->
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-200">Student Information</h3>
                <p class="mb-2 text-gray-700 dark:text-gray-300"><strong>Name:</strong> {{ $enrollment->student->name }}</p>
                <p class="mb-4 text-gray-700 dark:text-gray-300"><strong>Student ID:</strong> {{ $enrollment->student->id }}</p>

                <!-- Enrolled Subjects -->
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-200">Enrolled Subjects</h3>
                @if($enrollment->subjects->isNotEmpty())
                    <ul class="list-disc list-inside mb-4 text-gray-700 dark:text-gray-300">
                        @foreach ($enrollment->subjects as $subject)
                            <li>{{ $subject->name }} ({{ $subject->code }})</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 dark:text-gray-400">No subjects enrolled.</p>
                @endif

                <!-- Tuition Fees -->
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-200">Tuition Fees</h3>
                @if($enrollment->fee)
                    <p class="text-gray-700 dark:text-gray-300"><strong>Total Fees:</strong> ₱{{ number_format($enrollment->fee->total, 2) }}</p>
                @else
                    <p class="text-gray-500 dark:text-gray-400">Fees have not been set for this enrollment.</p>
                @endif

                <!-- Back Link -->
                <div class="mt-6">
                    <a href="{{ route('enrollments.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                        Back to Enrollment List
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
