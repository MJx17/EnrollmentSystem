<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Enrollment;
use App\Models\Fee;
use App\Models\Payment;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SubjectPdfController extends Controller
{

    public function downloadSubjectsPDF($studentId)
    {
        // Fetch enrollment data for the specific student
        $enrollment = Enrollment::with('subjects.professor', 'student', 'semester', 'course')
            ->where('student_id', $studentId)
            ->first();

        if (!$enrollment) {
            return response()->json(['error' => 'Enrollment not found for this student'], 404);
        }

        // Prepare the student info
        $studentImage = null;

        // Check if student has an image and encode it as base64
        if ($enrollment->student->image) {
            $imagePath = storage_path('app/public/' . $enrollment->student->image);
            if (File::exists($imagePath)) {
                // Convert image to base64
                $imageData = file_get_contents($imagePath);
                $studentImage = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . base64_encode($imageData);
            }
        }

        // If no image, use null to fallback to the placeholder in the view
        if (!$studentImage) {
            $studentImage = null;
        }


        // Base64 encode the logo (same logic)
        $logoPath = public_path('images/logo.jpg');
        $logoData = file_get_contents($logoPath);
        $logoBase64 = 'data:image/jpeg;base64,' . base64_encode($logoData);

        // Collect the necessary student info and subjects data
        $studentInfo = [
            'surname' => $enrollment->student->surname,
            'first_name' => $enrollment->student->first_name,
            'middle_name' => $enrollment->student->middle_name,
            'name' => $enrollment->student->surname . ', ' . $enrollment->student->first_name . ' ' . $enrollment->student->middle_name,
            'student_id' => $enrollment->student->id ?? 'N/A',
            'semester' => $enrollment->semester->semester_text ?? 'N/A',
            'year_level' => $enrollment->formatted_year_level ?? 'N/A',
            'category' => $enrollment->category ?? 'N/A',
            'academic_year' => $enrollment->semester->academic_year ?? 'N/A',
            'course' => $enrollment->course->course_name ?? 'N/A',
            'major' => $enrollment->course->major ?? 'N/A',
            'image' => $studentImage, // Base64 student image
            'logo' => $logoBase64,     // Base64 logo image
        ];

        // Generate the PDF from the view, passing both subjects and student information
        $pdf = PDF::loadView('pdf.subjects', [
            'subjects' => $enrollment->subjects,
            'studentInfo' => $studentInfo,
            'enrollment' => $enrollment
        ]);

        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isPhpEnabled' => true,
            'isCssFloatEnabled' => true
        ]);

        // Return the response with the PDF output
        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="enrolled_subjects_' . $studentId . '.pdf"');
    }


    public function fees($id)
    {
        // Fetch the enrollment with all related models: student, subjects, professor, semester, course, and fees/payments
        // Fetch enrollment data for the specific student, including related models
        $enrollment = Enrollment::with([
            'student',
            'subjects.professor',
            'semester',
            'course',
            'fees.payments',
            'financialInformation' // Load financial information
        ])->findOrFail($id);

        if (!$enrollment) {
            return response()->json(['error' => 'Enrollment not found for this student'], 404);
        }

        $financialData = $enrollment->financialInformation;


        // Fetch the first associated Fee record for the enrollment
        $fees = $enrollment->fees; // We can use the relationship directly here
        $payment = $fees ? $fees->payments()->latest()->first() : null;

        // Student info
        $studentImage = null;
        if ($enrollment->student->image) {
            $imagePath = storage_path('app/public/' . $enrollment->student->image);
            if (File::exists($imagePath)) {
                $imageData = file_get_contents($imagePath);
                $studentImage = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . base64_encode($imageData);
            }
        }

        $logoPath = public_path('images/logo.jpg');
        $logoData = file_get_contents($logoPath);
        $logoBase64 = 'data:image/jpeg;base64,' . base64_encode($logoData);

        // Prepare student info array
        $studentInfo = [
            'surname' => $enrollment->student->surname,
            'first_name' => $enrollment->student->first_name,
            'middle_name' => $enrollment->student->middle_name,
            'name' => $enrollment->student->surname . ', ' . $enrollment->student->first_name . ' ' . $enrollment->student->middle_name,
            'student_id' => $enrollment->student->id ?? 'N/A',
            'semester' => $enrollment->semester->semester_text ?? 'N/A',
            'year_level' => $enrollment->formatted_year_level ?? 'N/A',
            'category' => $enrollment->category ?? 'N/A',
            'academic_year' => $enrollment->semester->academic_year ?? 'N/A',
            'course' => $enrollment->course->course_name ?? 'N/A',
            'major' => $enrollment->course->major ?? 'N/A',
            'image' => $studentImage,
            'logo' => $logoBase64,
        ];

        // Fee calculations
        $totalFees = 0;
        $remainingBalance = 0;
        $installmentAmount = 0;
        $overallStatus = 'Paid';
        $balance = 0; // This will be the sum of all fees minus discounts and initial payment
        $remainingPayment = 0;
        $payment = null;

        if ($enrollment->fees && $enrollment->fees->payments) {
            $payment = $enrollment->fees->payments;

            // Fees calculation
            $tuitionFee = $enrollment->fees->tuition_fee ?? 0;
            $labFee = $enrollment->fees->lab_fee ?? 0;
            $miscFee = $enrollment->fees->miscellaneous_fee ?? 0;
            $otherFee = $enrollment->fees->other_fee ?? 0;
            $discount = $enrollment->fees->discount ?? 0;
            $initialPayment = $enrollment->fees->initial_payment ?? 0;

            // Step 1: Calculate the total fees (sum of all fees)
            $totalFees = $tuitionFee + $labFee + $miscFee + $otherFee;

            // Step 2: Calculate the balance after discount and initial payment
            $balance = $totalFees - $discount - $initialPayment;

            // Step 3: Calculate remaining balance after payments
            $remainingBalance = $balance;

            // Deduct payments made
            if ($payment->prelims_paid) {
                $remainingBalance -= $payment->prelims_payment;
            }
            if ($payment->midterms_paid) {
                $remainingBalance -= $payment->midterms_payment;
            }
            if ($payment->pre_final_paid) {
                $remainingBalance -= $payment->pre_final_payment;
            }
            if ($payment->final_paid) {
                $remainingBalance -= $payment->final_payment;
            }

            // Ensure no negative remaining balance
            $remainingBalance = max($remainingBalance, 0);

            // Step 4: Calculate installment amount (remaining balance divided by 4)
            $installmentAmount = $remainingBalance / 4;

            // Overall status calculation (whether all payments are made)
            $overallStatus = 'Paid';
            if (!$payment->prelims_paid || !$payment->midterms_paid || !$payment->pre_final_paid || !$payment->final_paid) {
                $overallStatus = 'Pending';
            }
        }

        // Return the results (can be passed to a view or returned as an array, as needed)

        // Generate the PDF
        $pdf = PDF::loadView('pdf.fees', [
            'subjects' => $enrollment->subjects,
            'studentInfo' => $studentInfo,
            'enrollment' => $enrollment,
            'fees' => $fees,
            'payment' => $payment,
            'remainingBalance' => $remainingBalance,
            'overallStatus' => $overallStatus,
            'balance' => $balance,
            'financialData' => $financialData,
        ]);

        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isPhpEnabled' => true,
            'isCssFloatEnabled' => true,
            'font' => 'DejaVu Sans'
        ]);

        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="enrolled_subjects_' . $id . '.pdf"');
    }

    public function financialInformation($id)
    {
        // Fetch enrollment data for the specific student, including related models
        $enrollment = Enrollment::with([
            'student',
            'subjects.professor',
            'semester',
            'course',
            'fees.payments',
            'financialInformation' // Load financial information
        ])->findOrFail($id);

        if (!$enrollment) {
            return response()->json(['error' => 'Enrollment not found for this student'], 404);
        }

        $financialData = $enrollment->financialInformation;


        // Generate PDF using the financier data
        $pdf = PDF::loadView('pdf.financial', [
            'financialData' => $financialData,
        ]);
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isPhpEnabled' => true,
            'isCssFloatEnabled' => true,
            'font' => 'DejaVu Sans'
        ]);

        // Return the generated PDF as response
        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="enrolled_subjects_' . $id . '.pdf"');
    }



    public function permit($id)
    {
        // Fetch enrollment data for the specific student, including related models
        $enrollment = Enrollment::with([
            'student',
            'subjects.professor',
            'semester',
            'course',
            'fees.payments',
            'subjects' // Load financial information
        ])->findOrFail($id);

        if (!$enrollment) {
            return response()->json(['error' => 'Enrollment not found for this student'], 404);
        }

        $permit = $enrollment->subjects;


        // Generate PDF using the financier data
        $pdf = PDF::loadView('pdf.permit', data: [
            'permit' => $permit,
            'subjects' => $enrollment->subjects,
        ]);
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isPhpEnabled' => true,
            'isCssFloatEnabled' => true,
            'font' => 'DejaVu Sans'
        ]);

        // Return the generated PDF as response
        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="enrolled_subjects_' . $id . '.pdf"');
    }

    
   





}