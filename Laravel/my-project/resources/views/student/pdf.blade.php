@extends('layouts.pdf')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            align-items: center; /* Vertically align the label and input */
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            margin-right: 10px; /* Space between the label and the input line */
            width: 120px; /* Adjust the label width */
        }

        .input-line {
            border-bottom: 1px solid #4a5568; /* Border for the blank line */
            width: 200px; /* Adjust the width of the input line */
            padding: 4px 0;
        }

        .page-break {
            page-break-before: always;
        }
    </style>

    <h1>Enrollment Form</h1>

    <div class="form-group">
        <label for="name">Full Name:</label>
        <span class="input-line"></span> <!-- Blank line for input -->
    </div>

    <div class="form-group">
        <label for="email">Email Address:</label>
        <span class="input-line"></span> <!-- Blank line for input -->
    </div>

    <div class="form-group">
        <label for="course">Course:</label>
        <span class="input-line"></span> <!-- Blank line for input -->
    </div>

    <div class="form-group">
        <label for="address">Address:</label>
        <span class="input-line"></span> <!-- Blank line for input -->
    </div>

    <div class="form-group">
        <label for="phone">Phone Number:</label>
        <span class="input-line"></span> <!-- Blank line for input -->
    </div>

    <!-- Add any other fields required for the enrollment form -->
@endsection
