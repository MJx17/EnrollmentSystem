<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examination Permit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            text-align: center;
        }

        /* Table Styling */
        .exam-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .exam-table th,
        .exam-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .exam-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        /* Unique styles */
        .subject-code {
            text-align: left;
            font-weight: bold;
        }

        .instructor-sign {
            text-align: center;
            font-style: italic;
        }
    </style>
</head>
<body>

<h2>Examination Permit</h2>

<table class="exam-table">
    <thead>
        <tr>
            <th rowspan="2">Subject Code</th>
          
            <th colspan="3">Instructor Signature</th> <!-- Fixed syntax -->
        </tr>
        <tr>
            <th>Prelims</th>
            <th>Midterms</th>
            <th>Finals</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subjects as $subject)
            <tr>
                <td class="subject-code">{{ $subject->code }}</td>
                <td class="instructor-sign"></td> <!-- Placeholder for Instructor Signature -->
                <td></td> <!-- Placeholder for Prelims -->
                <td></td> <!-- Placeholder for Midterms -->
              
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
