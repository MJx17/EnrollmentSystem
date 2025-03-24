<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Enrollment Details') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6" x-data="{ activeTab: 'subjects' }">

                <!-- Tab Navigation -->
                <div class="flex border-b border-gray-300 dark:border-gray-600 mb-4">
                    <button @click="activeTab = 'subjects'"
                        :class="{ 'bg-gray-200 dark:bg-gray-700 font-semibold': activeTab === 'subjects' }"
                        class="px-4 py-2 flex-1 text-center hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                        Subjects
                    </button>

                    <button @click="activeTab = 'fees'"
                        :class="{ 'bg-gray-200 dark:bg-gray-700 font-semibold': activeTab === 'fees' }"
                        class="px-4 py-2 flex-1 text-center hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                        Fees
                    </button>

                    <button @click="activeTab = 'payment'"
                        :class="{ 'bg-gray-200 dark:bg-gray-700 font-semibold': activeTab === 'payment' }"
                        class="px-4 py-2 flex-1 text-center hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                        Payment
                    </button>


                    <button @click="activeTab = 'financial'"
                        :class="{ 'bg-gray-200 dark:bg-gray-700 font-semibold': activeTab === 'payment' }"
                        class="px-4 py-2 flex-1 text-center hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                        Financial
                    </button>
                </div>

                <!-- Subjects Tab -->
                <div x-show="activeTab === 'subjects'">


                    <!-- Iterate through students and display a download button for each -->
                    <!-- <a href="{{ route('download-subjects-pdf', $enrollment->student->id) }}">
                        <button class="bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 mb-4">
                            Download
                        </button>
                    </a> -->

                    <a href="{{ route('pdf.fees', $enrollment->id) }}"
                        class="inline-flex items-center px-4 py-2 mb-4 text-sm font-medium text-white bg-green-500 border border-transparent rounded-md hover:bg-green-300 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                        Download
                    </a>

                    <!-- <a href="{{ route('pdf.financial', $enrollment->id) }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-500 border border-transparent rounded-md hover:bg-green-300 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                        View
                    </a> -->



                    <!-- Student Information -->
                    <div
                        class="mb-4 p-4 border border-gray-300 dark:border-gray-600 rounded bg-gray-100 dark:bg-gray-800">
                        <p class="font-semibold text-lg text-gray-800 dark:text-white mb-2">Student Information</p>

                        <div class="grid grid-cols-2 gap-x-4 gap-y-2">
                            <div class="flex justify-between">
                                <span class="font-semibold">Name:</span>
                                <span>{{ $enrollment->student->surname ?? 'N/A' }},
                                    {{ $enrollment->student->first_name ?? 'N/A' }}
                                    {{ $enrollment->student->middle_name ?? '' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-semibold">Student #:</span>
                                <span>{{ $enrollment->student->id ?? 'N/A' }}</span>
                            </div>


                        </div>

                        <div class="grid grid-cols-2 gap-x-4 gap-y-2">
                            <div class="flex justify-between">
                                <span class="font-semibold">Semester:</span>
                                <span>{{ $enrollment->semester->semester_text ?? 'N/A' }}</span>
                            </div>

                            <div class="flex justify-between">
                                <span class="font-semibold">Year Level:</span>
                                <span>{{ $enrollment->formatted_year_level ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-x-4 gap-y-2">
                            <div class="flex justify-between">
                                <span class="font-semibold">Category:</span>
                                <span>{{ $enrollment->category ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-semibold">School Year:</span>
                                <span>{{ $enrollment->semester->academic_year ?? 'N/A' }}</span>
                            </div>
                        </div>

                        <!-- Course & Major in one full-width column -->
                        <div class="grid grid-cols-2 gap-x-4 gap-y-2">
                            <div class="flex justify-between">
                                <span class="font-semibold">Course:</span>
                                <span>{{ $enrollment->course->course_name ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-semibold">Major:</span>
                                <span>{{ $enrollment->course->major ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>


                    @if($enrollment->subjects->isNotEmpty())
                    <table class="w-full border-collapse border border-gray-300 dark:border-gray-600">
                        <thead class="bg-gray-200 dark:bg-gray-700">
                            <tr>
                                <th class="border px-4 py-2 text-left">Code</th>
                                <th class="border px-4 py-2 text-left">Units</th>
                                <th class="border px-4 py-2 text-left">Days</th>
                                <th class="border px-4 py-2 text-left">Time</th>
                                <th class="border px-4 py-2 text-left">Room</th>
                                <th class="border px-4 py-2 text-left">Professor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($enrollment->subjects as $subject)
                            <tr>
                                <td class="border px-4 py-2">{{ $subject->code }}</td>
                                <td class="border px-4 py-2">{{ $subject->units }}</td>
                                <td class="border px-4 py-2">{{ $subject->formatted_days }}</td>
                                <td class="border px-4 py-2">{{ $subject->class_time }}</td>
                                <td class="border px-4 py-2">{{ $subject->room }}</td>
                                <td class="border px-4 py-2">
                                    {{ $subject->professor->fullname ?? 'N/A' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-gray-500 dark:text-gray-400">No subjects enrolled.</p>
                    @endif
                </div>


                <!-- Fees Tab -->
                <div x-show="activeTab === 'fees'" class="mt-4">
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-200">Tuition Fees Breakdown</h3>
                    @if($enrollment->fees)
                    <table class="w-full border-collapse border border-gray-300 dark:border-gray-600">
                        <thead class="bg-gray-200 dark:bg-gray-700">
                            <tr>
                                <th class="border px-4 py-2 text-left">Fee Type</th>
                                <th class="border px-4 py-2 text-right">Amount (₱)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border px-4 py-2">Tuition Fee</td>
                                <td class="border px-4 py-2 text-right">
                                    {{ number_format($enrollment->fees->tuition_fee, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">Lab Fee</td>
                                <td class="border px-4 py-2 text-right">
                                    {{ number_format($enrollment->fees->lab_fee, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">Miscellaneous Fee</td>
                                <td class="border px-4 py-2 text-right">
                                    {{ number_format($enrollment->fees->miscellaneous_fee, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">Other Fee</td>
                                <td class="border px-4 py-2 text-right">
                                    {{ number_format($enrollment->fees->other_fee, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">Initial Payment</td>
                                <td class="border px-4 py-2 text-right">
                                    -{{ number_format($enrollment->fees->initial_payment, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">Discount</td>
                                <td class="border px-4 py-2 text-right">
                                    -{{ number_format($enrollment->fees->discount, 2) }}</td>
                            </tr>
                        </tbody>
                        <tfoot class="bg-gray-200 dark:bg-gray-700">
                            <tr>
                                <td class="border px-4 py-2 font-bold">Total Fees</td>
                                <td class="border px-4 py-2 font-bold text-right">₱{{ number_format($balance, 2) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    @else
                    <p class="text-gray-500 dark:text-gray-400">Fees have not been set for this enrollment.</p>
                    @endif
                </div>

                <!-- Payment Tab -->
                <div x-show="activeTab === 'payment'" class="mt-4">
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-200">Payment Details</h3>
                    @if($enrollment->fees && $payment)
                    <table class="w-full border-collapse border border-gray-300 dark:border-gray-600">
                        <thead class="bg-gray-200 dark:bg-gray-700">
                            <tr>
                                <th class="border px-4 py-2 text-left">Payment Type</th>
                                <th class="border px-4 py-2 text-right">Amount (₱)</th>
                                <th class="border px-4 py-2 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border px-4 py-2">Prelims Payment</td>
                                <td class="border px-4 py-2 text-right">
                                    {{ number_format($payment->prelims_payment ?? 0, 2) }}</td>
                                <td class="border px-4 py-2 text-center">
                                    {{ $payment->prelims_paid ? 'Paid' : 'Pending' }}</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">Midterms Payment</td>
                                <td class="border px-4 py-2 text-right">
                                    {{ number_format($payment->midterms_payment ?? 0, 2) }}</td>
                                <td class="border px-4 py-2 text-center">
                                    {{ $payment->midterms_paid ? 'Paid' : 'Pending' }}</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">Pre-final Payment</td>
                                <td class="border px-4 py-2 text-right">
                                    {{ number_format($payment->pre_final_payment ?? 0, 2) }}</td>
                                <td class="border px-4 py-2 text-center">
                                    {{ $payment->pre_final_paid ? 'Paid' : 'Pending' }}</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">Final Payment</td>
                                <td class="border px-4 py-2 text-right">
                                    {{ number_format($payment->final_payment ?? 0, 2) }}</td>
                                <td class="border px-4 py-2 text-center">{{ $payment->final_paid ? 'Paid' : 'Pending' }}
                                </td>
                            </tr>

                            <!-- Remaining Balance Calculation -->
                            <tr>
                                <td class="border px-4 py-2 font-bold">Remaining Balance</td>
                                <td class="border px-4 py-2 font-bold text-right">
                                    ₱{{ number_format($remainingBalance ?? 0, 2) }}</td>
                                <td class="border px-4 py-2 font-bold text-center">{{ $overallStatus }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @else
                    <p class="text-gray-500 dark:text-gray-400">No payments recorded.</p>
                    @endif
                </div>



                <div x-show="activeTab === 'financial'" class="mt-4">
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-200">Financial Information</h3>
                    @if($enrollment->financialInformation)
                    <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-md">
                        <thead>
                            <tr class="bg-gray-100 text-black">
                                <th class="py-2 px-4 border">Description</th>
                                <th class="py-2 px-4 border">Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border">Financier</td>
                                <td class="py-2 px-4 border">{{ $enrollment->financialInformation->financier ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border">Company Name</td>
                                <td class="py-2 px-4 border">
                                    {{ $enrollment->financialInformation->company_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border">Company Address</td>
                                <td class="py-2 px-4 border">
                                    {{ $enrollment->financialInformation->company_address ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border">Income</td>
                                <td class="py-2 px-4 border">{{ $enrollment->financialInformation->income ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border">Scholarship</td>
                                <td class="py-2 px-4 border">
                                    {{ $enrollment->financialInformation->scholarship ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Separate Table for Relatives -->
                    <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-md mt-4">
                        <thead>
                            <tr class="bg-gray-100 text-black">
                                <th class="py-2 px-4 border">Relative Name</th>
                                <th class="py-2 px-4 border">Relationship</th>
                                <th class="py-2 px-4 border">Position Course</th>
                                <th class="py-2 px-4 border">Contact Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $relativeNames = explode(', ', $enrollment->financialInformation->relative_names ?? '');
                            $relationships = explode(', ', $enrollment->financialInformation->relationships ?? '');
                            $positionCourses = explode(', ', $enrollment->financialInformation->position_courses ?? '');
                            $relativeContactNumbers = explode(', ',
                            $enrollment->financialInformation->relative_contact_numbers ?? '');
                            $maxRows = max(count($relativeNames), count($relationships), count($positionCourses),
                            count($relativeContactNumbers));
                            @endphp

                            @for ($i = 0; $i < $maxRows; $i++) <tr>
                                <td class="py-2 px-4 border">{{ $relativeNames[$i] ?? 'N/A' }}</td>
                                <td class="py-2 px-4 border">{{ $relationships[$i] ?? 'N/A' }}</td>
                                <td class="py-2 px-4 border">{{ $positionCourses[$i] ?? 'N/A' }}</td>
                                <td class="py-2 px-4 border">{{ $relativeContactNumbers[$i] ?? 'N/A' }}</td>
                                </tr>
                                @endfor
                        </tbody>
                    </table>


                    @else
                    <p class="text-gray-500 dark:text-gray-400">Fees have not been set for this enrollment.</p>
                    @endif
                </div>



                <!-- Back Link -->
                <div class="mt-6 flex justify-end">
                    <a href="{{ auth()->user()->hasRole('admin') ? route('enrollments.index') : route('dashboard') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                        Back
                    </a>
                </div>


            </div>
        </div>
</x-app-layout>