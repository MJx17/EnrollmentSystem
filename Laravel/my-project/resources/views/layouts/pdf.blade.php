{{-- resources/views/layouts/pdf.blade.php --}}

<html>
<head>
    <style>
        /* Custom styles for the PDF */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12pt;
        }

        .pdf-content {
            width: 100%;
            padding: 20px;
        }

        h1, h2, h3 {
            margin-top: 0;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        /* Page break styling */
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="pdf-content">
        @yield('content')  {{-- This will output the content passed from the @section('content') --}}
    </div>
</body>
</html>
