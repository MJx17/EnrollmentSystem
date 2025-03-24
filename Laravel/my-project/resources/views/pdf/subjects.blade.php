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
            border: 1px solid #ddd; /* Add border for td */
        }

        th {
            padding: 10px;
            background-color: #f2f2f2;
            text-align: left;
            border: 1px solid #ddd; /* Add border for th */
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
            padding-right: 20px;  /* Adds space between label and data */
            display: block;
         
        }

        /* Data styling */
        .student-info-table .data {
            text-align: left;
            color: #444;
            padding-bottom: 5px;
            position: relative;
       
       
        }
        table tr:last-child td {
            border-bottom: none;
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
                            style="width: 140px; height: 140px; background-color: #ccc; display: flex; justify-content: center; margin-left: 60px;  align-items: center; margin-top: 20px;">
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
        <tr >
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



</body>
</html>
