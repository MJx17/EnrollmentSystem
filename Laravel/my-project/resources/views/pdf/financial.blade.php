<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial & Relatives Information</title>
    <style>
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 10px;
            text-align: justify;
        }

        .bold {
            font-weight: bold;
        }

        .signature-line {
            display: inline-block;
            width: 250px;
            /* Adjust width of signature line */
            border-bottom: 1px solid black;
            margin-left: 10px;
        }

        .table-container {
            margin-top: 15px;
        }

        .ft-fi {

            width: 100%;
            border-collapse: collapse;
            border-color: gray;

        }

       td {
            padding: 10px;
            vertical-align: top;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .signature-p {
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <h2 style="text-align: center;">FINANCIAL INFORMATION</h2>


    <!-- <p>
            <span class="bold" style="width: 50%; display: inline-block;">Who will be financing your education?</span>
            <span style="width: 45%; display: inline-block; margin-left: 10px; text-align: center;">
                <div style="display: block; text-align: left;">
                    <label style="display: inline-block; margin-right: 10px;">
                        <input type="checkbox" name="financier" value="Parents"
                            {{ $financialData['financier'] === 'Parents' ? 'checked' : '' }}>
                        Parents
                    </label>
                    <label style="display: inline-block; margin-right: 10px;">
                        <input type="checkbox" name="financier" value="Relatives"
                            {{ $financialData['financier'] === 'Relatives' ? 'checked' : '' }}>
                        Relatives
                    </label>
                    <label style="display: inline-block; margin-right: 10px;">
                        <input type="checkbox" name="financier" value="Guardian"
                            {{ $financialData['financier'] === 'Guardian' ? 'checked' : '' }}>
                        Guardian
                    </label>
                    <label style="display: inline-block; margin-right: 10px;">
                        <input type="checkbox" name="financier" value="Myself"
                            {{ $financialData['financier'] === 'Myself' ? 'checked' : '' }}>
                        Myself
                    </label>
                    <label style="display: inline-block; ">
                        <input type="checkbox" name="financier" value="Others" id="othersCheckbox"
                            {{ $financialData['financier'] === 'Others' ? 'checked' : '' }}>
                        Others
                    </label>
                </div>

            </span>
        </p> -->
    <div class="section">
        <p>
            <span class="bold" style="width: 50%; display: inline-block;">Who will be financing your education?:</span>
            <span
                style="border-bottom: 1px solid black; width: 45%; display: inline-block; margin-left: 10px; text-align: center;">{{ $financialData['financier'] ?? 'N/A' }}</span>
        </p>





        <p>
            <span class="bold" style="width: 50%; display: inline-block;">Income:</span>
            <span
                style="border-bottom: 1px solid black; width: 45%; display: inline-block; margin-left: 10px; text-align: center;">{{ $financialData['income'] ?? 'N/A' }}</span>
        </p>
        <p>
            <span class="bold" style="width: 50%; display: inline-block;">(If Working Student)Company Name:</span>
            <span
                style="border-bottom: 1px solid black; width: 45%; display: inline-block; margin-left: 10px; text-align: center;">{{ $financialData['company_name'] ?? 'N/A' }}</span>
        </p>
        <p>
            <span class="bold" style="width: 50%; display: inline-block;"> Address:</span>
            <span
                style="border-bottom: 1px solid black; width: 45%; display: inline-block; margin-left: 10px; text-align: center;">{{ $financialData['company_address'] ?? 'N/A' }}</span>
        </p>
        <p>
            <span class="bold" style="width: 50%; display: inline-block;">Number</span>
            <span
                style="border-bottom: 1px solid black; width: 45%; display: inline-block; margin-left: 10px; text-align: center;">{{ $financialData['contact_number'] ?? 'N/A' }}</span>
        </p>
        <p>
            <span class="bold" style="width: 50%; display: inline-block;">Scholarship (If any):</span>
            <span
                style="border-bottom: 1px solid black; width: 45%; display: inline-block; margin-left: 10px; text-align: center;">{{ $financialData['scholarship'] ?? 'N/A' }}</span>
        </p>
    </div>

    <div class="section">
        <p><span class="bold">Do you have any relatives currently enrolled/graduated from ACC or working with
                ACC/ADCMH?</span> Yes / No</p>
    </div>

    <div class="table-container">
        <h3>Relatives in ACC/ADCMH</h3>


        <table class="ft-fi">
            <tr>
                <th class="" style="width: 25%;">Name</th>
                <th class="" style="width: 25%;">Relationship</th>
                <th class="" style="width: 25%;">Position/Course</th>
                <th class="" style="width: 25%;">Contact Number</th>
            </tr>

            <tbody>
                @php
                    $relativeNames = explode(', ', $financialData->relative_names ?? '');
                    $relationships = explode(', ', $financialData->relationships ?? '');
                    $positionCourses = explode(', ', $financialData->position_courses ?? '');
                    $relativeContactNumbers = explode(', ', $financialData->relative_contact_numbers ?? '');
                    $maxRows = max(
                        count($relativeNames),
                        count($relationships),
                        count($positionCourses),
                        count($relativeContactNumbers)
                    );
                @endphp

                @for ($i = 0; $i < $maxRows; $i++)
                                <tr>
                                    <td class="py-2 px-4 border" style="width: 25%;">{{ $relativeNames[$i] ?? '' }}</td>
                                    <td class="py-2 px-4 border" style="width: 25%;">{{ $relationships[$i] ?? '' }}</td>
                                    <td class="py-2 px-4 border" style="width: 25%;">{{ $positionCourses[$i] ?? '' }}</td>
                                    <td class="py-2 px-4 border" style="width: 25%;">{{ $relativeContactNumbers[$i] ?? '' }}</td>
                                </tr>
                                {{-- Add logic to display 3 empty td elements when any value is missing --}}
                                @if (
                                    !$relativeNames[$i] && !$relationships[$i] && !$positionCourses[$i] &&
                                    !$relativeContactNumbers[$i]
                                )
                                                <tr>
                                                    <td class="py-2 px-4 border" style="width: 25%;"></td>
                                                    <td class="py-2 px-4 border" style="width: 25%;"></td>
                                                    <td class="py-2 px-4 border" style="width: 25%;"></td>
                                                    <td class="py-2 px-4 border" style="width: 25%;"></td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 px-4 border" style="width: 25%;"></td>
                                                    <td class="py-2 px-4 border" style="width: 25%;"></td>
                                                    <td class="py-2 px-4 border" style="width: 25%;"></td>
                                                    <td class="py-2 px-4 border" style="width: 25%;"></td>
                                                </tr>
                                @endif
                @endfor
            </tbody>
        </table>




    </div>

    <p class="section">
        I hereby certify that I have accomplished this Registration Form truthfully and to the best of my knowledge. If
        admitted, I shall abide by all School Regulations and Policies. I also understand that Amando Cope College does
        not approve of any fraternity or sorority; therefore, no initiation will be performed inside or outside school
        premises. I also agree to submit this form to the Comptroller's Office not later than ___________________,
        otherwise, I
        will NOT BE CONSIDERED OFFICIALLY ENROLLED.
    </p>



    <table style="width: 100%; margin-top: 20px; border-collapse: collapse;">
        <tr>
            <!-- First Column (Student's Signature) -->
            <td style="width: 40%; text-align: center; padding-right: -30px; border: none;">
                <p style="margin-bottom: 50px;"><span style="font-weight: bold;">Student's Signature,</span></p>
                <div style="border-bottom: 1px solid black; width: 100%; margin: 0 auto;"></div>
                <p style="margin-bottom: 50px;"><span style="font-weight: bold;">DATE,</span></p>
                <div style="border-bottom: 1px solid black; width: 100%; margin: 0 auto;"></div>
            </td>

            <td style="width: 20%; text-align: center; padding-left: -30px; border: none;">

                <!-- Second Column (Received at Comptroller's Office) -->
            <td style="width: 40%; text-align: center; padding-left: -30px; border: none;">
                <p style="margin-bottom: 50px;"><span style="font-weight: bold;">Received at Comptroller's
                        Office,</span></p>
                <div style="border-bottom: 1px solid black; width: 100%; margin: 0 auto;"></div>
                <p style="margin-bottom: 50px;"><span style="font-weight: bold;">DATE,</span></p>
                <div style="border-bottom: 1px solid black; width: 100%; margin: 0 auto;"></div>
            </td>
        </tr>
    </table>



</body>

</html>