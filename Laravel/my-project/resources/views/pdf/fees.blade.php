<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrolled Subjects</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo {
            flex: 1;
            text-align: left;
        }

        .logo img {
            max-height: 80px;
            max-width: 100%;
            object-fit: contain;
        }

        .section-title {
            text-align: center;
            font-weight: bold;
            color: black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        /* Add this to your existing CSS for better styling and separation of td and th */
        td {
            padding: 10px;
            vertical-align: top;
            border: 1px solid #ddd;
            /* Add border for td */
        }

        th {
            padding: 10px;
            background-color: #f2f2f2;
            text-align: left;
            border: 1px solid #ddd;
            /* Add border for th */
        }

        /* Specific styles for each type of td */
        .logo-cell {
            text-align: left;
            width: 33%;
            border: none
        }

        .college-info-cell {
            text-align: center;
            width: 34%;
            border: none
        }

        .student-photo-cell {
            text-align: right;
            width: 33%;
            border: none
        }

        /* Adjust border color as needed */
        table {
            width: 100%;
            border-collapse: collapse;
            border-color: gray;
        }

        th {
            background-color: #f2f2f2;
        }

        .info-grid {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .info-item {
            width: 48%;
        }

        /* Remove border for header table */
        .header-section table {
            border: none;
        }

        /* Table container */
        .student-info-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            margin-bottom: 40px;
            /* Add border width and color */
        }

        /* Label styling */
        .student-info-table .label {
            text-align: left;
            font-weight: bold;
            color: #333;
            padding-bottom: 5px;
            padding-right: 20px;
            /* Adds space between label and data */
            display: block;

        }

        /* Data styling */
        .student-info-table .data {
            text-align: left;
            color: #444;
            padding-bottom: 5px;
            position: relative;

        }

        /* Underline for data */
      


        .page-break {
            page-break-before: always;
            /* or page-break-after: always; */
            break-before: always;
            /* For modern browsers supporting the CSS 'break' property */
        }
    </style>
</head>

<body>

    <div class="header-section">
        <table style="width: 100%; border-spacing: 0;">
            <tr>
                <td class="logo-cell" style="width: 33%; text-align: left; padding: 10px;">
                    <img src="{{ $studentInfo['logo'] }}" alt="Logo" style="max-height: 180px; width: auto;">
                </td>

                <td class="college-info-cell" style="width: 34%; text-align: center; padding: 10px; padding-top: 50px;">
                    <h2 class="college-name" style="font-size: 18px; margin: 0 0 5px 0;">Amando Cope College</h2>
                    <p class="address" style="margin: 0 0 5px 0; font-size: 14px;">Baranghawon, Tabaco City</p>
                    <p class="contact" style="margin: 0; font-size: 14px;">(052) 487-4455</p>
                </td>

                <td class="student-photo-cell" style="width: 33%; text-align: right; padding: 10px;">
                    @if ($studentInfo['image'])
                        <img src="{{ $studentInfo['image'] }}" alt="Student Image"
                            style="width: 140px; height: 140px; object-fit: cover; margin-top: 20px;">
                    @else
                        <div
                            style="width: 140px; height: 140px; background-color: #ccc; display: flex; justify-content: center; margin-left: 60px;  align-items: center;  margin-top: 20px;">
                            <span style="color: #fff; font-size: 12px; font-weight: bold;">Student Photo</span>
                        </div>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <div class="student-info-details">
        <p class="section-title">Enrollment Details</p>

        <!-- Updated table for student info -->
        <table class="student-info-table">
            <!-- First Row with grouped data (Surname, First Name, Middle Name) -->
            <tr>
                <td class="label">Surname</td>
                <td class="data">{{ $studentInfo['surname'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">First Name</td>
                <td class="data">{{ $studentInfo['first_name'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Middle Name</td>
                <td class="data">{{ $studentInfo['middle_name'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Student Number</td>
                <td class="data">{{ $studentInfo['student_id'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Semester</td>
                <td class="data">{{ $studentInfo['semester'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Year Level</td>
                <td class="data">{{ $studentInfo['year_level'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">School Year</td>
                <td class="data">{{ $studentInfo['academic_year'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Category</td>
                <td class="data">{{ $studentInfo['category'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Course</td>
                <td class="data">{{ $studentInfo['course'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Major</td>
                <td class="data">{{ $studentInfo['major'] ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    <!-- Subjects Table -->
    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Units</th>
                <th>Days</th>
                <th>Time</th>
                <th>Room</th>
                <th>Professor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $subject)
                <tr>
                    <td>{{ $subject->code }}</td>
                    <td>{{ $subject->units }}</td>
                    <td>{{ $subject->formatted_days }}</td>
                    <td>{{ $subject->class_time }}</td>
                    <td>{{ $subject->room }}</td>
                    <td>{{ $subject->professor->fullname ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>

    </table>



    <!-- Page Break before Fees Information -->
    <div class="page-break">

        <!-- Fees Information -->
        @if($fees)
            <table class="w-full border-collapse border border-gray-300 dark:border-gray-600">
                <thead class="bg-gray-200 dark:bg-gray-700">
                    <tr>
                        <th class="border px-4 py-2 text-left">Fee Type</th>
                        <th style="font-family: DejaVu Sans;" class="border px-4 py-2 text-right">Amount (₱)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">Tuition Fee</td>
                        <td class="border px-4 py-2 text-right">{{ number_format($fees->tuition_fee, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Lab Fee</td>
                        <td class="border px-4 py-2 text-right">{{ number_format($fees->lab_fee, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Miscellaneous Fee</td>
                        <td class="border px-4 py-2 text-right">{{ number_format($fees->miscellaneous_fee, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Other Fee</td>
                        <td class="border px-4 py-2 text-right">{{ number_format($fees->other_fee, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Initial Payment</td>
                        <td class="border px-4 py-2 text-right">-{{ number_format($fees->initial_payment, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Discount</td>
                        <td class="border px-4 py-2 text-right">-{{ number_format($fees->discount, 2) }}</td>
                    </tr>
                </tbody>
                <tfoot class="bg-gray-200 dark:bg-gray-700">
                    <tr>
                        <td class="border px-4 py-2 font-bold">Total Fees</td>
                        <td style="font-family: DejaVu Sans;" class="border px-4 py-2 font-bold text-right">
                            ₱{{ number_format($balance, 2) }}</tddecimals:>
                    </tr>
                </tfoot>
            </table>
        @else
            <p class="text-gray-500 dark:text-gray-400">No fee details available.</p>
        @endif







        @if($payment)
            <h3 style="padding-top: 10px;" class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-200">Payment
                Details
            </h3>
            <table class="w-full border-collapse border border-gray-300 dark:border-gray-600">
                <thead class="bg-gray-200 dark:bg-gray-700">
                    <tr>
                        <th class="border px-4 py-2 text-left">Payment Type</th>
                        <th style="font-family: DejaVu Sans;" class="border px-4 py-2 text-right">Amount (₱)</th>
                        <th class="border px-4 py-2 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">Prelims Payment</td>
                        <td class="border px-4 py-2 text-right">{{ number_format($payment->prelims_payment, 2) }}</td>
                        <td class="border px-4 py-2 text-center">{{ $payment->prelims_paid ? 'Paid' : 'Pending' }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Midterms Payment</td>
                        <td class="border px-4 py-2 text-right">{{ number_format($payment->midterms_payment, 2) }}</td>
                        <td class="border px-4 py-2 text-center">{{ $payment->midterms_paid ? 'Paid' : 'Pending' }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Pre-final Payment</td>
                        <td class="border px-4 py-2 text-right">{{ number_format($payment->pre_final_payment, 2) }}</td>
                        <td class="border px-4 py-2 text-center">{{ $payment->pre_final_paid ? 'Paid' : 'Pending' }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Final Payment</td>
                        <td class="border px-4 py-2 text-right">{{ number_format($payment->final_payment, 2) }}</td>
                        <td class="border px-4 py-2 text-center">{{ $payment->final_paid ? 'Paid' : 'Pending' }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2 font-bold">Remaining Balance</td>
                        <td style="font-family: DejaVu Sans;" class="border px-4 py-2 font-bold text-right">
                            ₱{{ number_format($remainingBalance, 2) }}</td>
                        <td class="border px-4 py-2 font-bold text-center">{{ $overallStatus }}</td>
                    </tr>
                </tbody>
            </table>
        @else
            <p class="text-gray-500 dark:text-gray-400">No payment details available.</p>
        @endif


    </div>

    <div class="page-break">
        <div class=" ">
               
               @include('pdf.financial')
           
       </div>
    </div>


    <div class="page-break">
        <div class=" ">
               
               @include('pdf.permit')
           
       </div>
    </div>

    <!-- Payment Information -->




</body>

</html>