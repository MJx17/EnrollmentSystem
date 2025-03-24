<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Payment;
use App\Models\Fee;
use App\Models\StudentSubject;
use App\Models\FinancialInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EnrollmentController extends Controller
{
    // Display a listing of enrollments
    public function index()
    {
        $enrollments = Enrollment::with('student', 'semester', 'course')->paginate(10);
        return view('enrollments.index', compact('enrollments'));
    }

    // Show the form to create a new enrollment
    public function create(Request $request)
    {
        $excludedStudentIds = Enrollment::pluck('student_id')->toArray();
        $students = Student::whereNotIn('id', $excludedStudentIds)->get();
        $courses = Course::all();
        $semesters = Semester::all();
        $subjects = collect(); // Empty collection by default

        if ($request->has(['course_id', 'semester_id', 'year_level'])) {
            $subjects = Subject::where('course_id', $request->course_id)
                ->where('semester_id', $request->semester_id)
                ->where('year_level', $request->year_level)
                ->get();
        }

        return view('enrollments.create', compact('students', 'courses', 'semesters', 'subjects'));
    }





    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'semester_id' => 'required|exists:semesters,id',
            'course_id' => 'required|exists:courses,id',
            'year_level' => 'required|string',
            'subjects' => 'required|array',
            'subjects.*' => 'exists:subjects,id',
            'category' => 'required|string',
            'tuition_fee' => 'required|numeric',
            'lab_fee' => 'nullable|numeric',
            'miscellaneous_fee' => 'nullable|numeric',
            'other_fee' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'initial_payment' => 'required|numeric',

            'financier' => 'required|string',
            'relative_names' => 'nullable|array',
            'relative_names.*' => 'nullable|string|max:255', // Array items should be strings
            'relationships' => 'nullable|array',
            'relationships.*' => 'nullable|string|max:255', // Array items should be strings
            'position_courses' => 'nullable|array',
            'position_courses.*' => 'nullable|string|max:255', // Array items should be strings
            'relative_contact_numbers' => 'nullable|array',
            'relative_contact_numbers.*' => 'nullable|string|max:20', // Max length for phone number

            // Add the missing validation rules
            'company_name' => 'nullable|string|max:255',
            'company_address' => 'nullable|string|max:1000',  // Allow larger text input for addresses
            'scholarship' => 'nullable|string|max:255',
            'income' => 'nullable|string|max:1000',  // Allow larger text input for income details
            'contact_number' => 'nullable|string|max:20',  // Max length for phone numbers, you can adjust if necessary


        ]);

        try {
            DB::beginTransaction(); // Start transaction

            // Create enrollment
            $enrollment = Enrollment::create([
                'student_id' => $validated['student_id'],
                'semester_id' => $validated['semester_id'],
                'course_id' => $validated['course_id'],
                'year_level' => $validated['year_level'],
                'subject_ids' => json_encode($validated['subjects']),
                'category' => $validated['category'],
            ]);

            // Update student status to 'enrolled'
            Student::where('id', $validated['student_id'])->update(['status' => 'enrolled']);

            // Insert subjects into student_subjects table
            $studentSubjects = [];
            foreach ($validated['subjects'] as $subject_id) {
                $studentSubjects[] = [
                    'student_id' => $validated['student_id'],
                    'subject_id' => $subject_id,
                    'enrollment_id' => $enrollment->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            StudentSubject::insert($studentSubjects); // Bulk insert

            // Calculate total fee and initial payment
            $tuitionFee = (float) $validated['tuition_fee'];
            $labFee = (float) ($validated['lab_fee'] ?? 0);
            $miscellaneousFee = (float) ($validated['miscellaneous_fee'] ?? 0);
            $otherFee = (float) ($validated['other_fee'] ?? 0);
            $discount = (float) ($validated['discount'] ?? 0);
            $initialPayment = (float) $validated['initial_payment'];

            $totalFee = $tuitionFee + $labFee + $miscellaneousFee + $otherFee - $discount - $initialPayment;

            // Insert fees into students_fees table
            $fee = Fee::create([
                'enrollment_id' => $enrollment->id,
                'tuition_fee' => $tuitionFee,
                'lab_fee' => $labFee,
                'miscellaneous_fee' => $miscellaneousFee,
                'other_fee' => $otherFee,
                'discount' => $discount,
                'total' => $totalFee,
                'initial_payment' => $initialPayment,
            ]);

            // Calculate installment amounts
            $installmentAmount = $totalFee > 0 ? $totalFee / 4 : 0;

            // Insert payment details (divide total fee into four installments)
            $paymentsData = [
                'fee_id' => $fee->id,
                'prelims_payment' => $installmentAmount,
                'prelims_paid' => false,
                'midterms_payment' => $installmentAmount,
                'midterms_paid' => false,
                'pre_final_payment' => $installmentAmount,
                'pre_final_paid' => false,
                'final_payment' => $installmentAmount,
                'final_paid' => false,
                'amount_paid' => 0, // Set initial amount paid to 0
                'balance' => $totalFee, // Full balance initially
                'status' => 'Pending',
            ];

            Payment::create($paymentsData); // Insert the payment record

            $financialData = [
                'enrollment_id' => $enrollment->id,
                'financier' => $validated['financier'],
                'company_name' => $validated['company_name'],
                'company_address' => $validated['company_address'],
                'income' => $validated['income'],
                'scholarship' => $validated['scholarship'],
                'contact_number' => $validated['contact_number'],
            ];

            // For dynamic fields, if not provided, default to an empty array
            $relativeNames = $validated['relative_names'] ?? [];
            $relationships = $validated['relationships'] ?? [];
            $positionCourses = $validated['position_courses'] ?? [];
            $relativeContactNumbers = $validated['relative_contact_numbers'] ?? [];

            // JSON-encode these arrays so they are stored as JSON strings in the database.
            // (If you have model casts for these columns, you can remove json_encode.)
            $data = [
                'relative_names' => json_encode($relativeNames),
                'relationships' => json_encode($relationships),
                'position_courses' => json_encode($positionCourses),
                'relative_contact_numbers' => json_encode($relativeContactNumbers),
            ];
            // Merge the fixed financial data with dynamic relative data
            $financialData = array_merge($financialData, $data);

            // Save to the database
            FinancialInformation::create($financialData);


            DB::commit(); // Commit transaction

            return redirect()->route('enrollments.index')->with('success', 'Enrollment created successfully with fees and payment schedule!');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback in case of an error
            return back()->with('error', 'Failed to create enrollment: ' . $e->getMessage());
        }
    }

    // Delete an enrollment
    public function destroy($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $studentId = $enrollment->student_id; // Retrieve student_id before deletion
        $enrollment->delete();

        // Update the student's status

        Student::where('id', $studentId)->update(['status' => 'not_enrolled']);


        return redirect()->route('enrollments.index')->with('success', 'Enrollment deleted successfully!');
    }

    public function getSubjects(Request $request)
    {
        $query = Subject::where('semester_id', $request->semester_id)
            ->whereHas('courses', function ($query) use ($request) {
                $query->where('courses.id', $request->course_id);
            });

        // Apply year_level filter only if it's not "irregular"
        if ($request->year_level !== 'irregular') {
            $query->where('year_level', $request->year_level);
        }

        // Fetch subjects and group by year_level
        $subjects = $query->get()->groupBy('year_level');

        return response()->json($subjects);
    }


    public function fees($id)
    {    
        $enrollment = Enrollment::with(['student', 'subjects', 'fees', 'fees.payments', 'financialInformation'])->findOrFail($id);
  
        $user = auth()->user(); // Get the logged-in user
        $student = $enrollment->student;
        // Ensure the user is a professor and can only access their own profile
        if ($user->hasRole('student') && optional($user->student)->id !== $student->id) {
            abort(403, 'Unauthorized access');
        }
    
        // Initialize variables
        $totalFees = 0;
        $remainingBalance = 0;
        $installmentAmount = 0;
        $overallStatus = 'Paid';
        $balance = 0; // Sum of all fees minus discounts and initial payment
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

            // Step 3: Initialize remainingBalance to the balance
            $remainingBalance = $balance;

            // Deduct payments made only for installments marked as 'Paid'
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
            if (!$payment->prelims_paid || !$payment->midterms_paid || !$payment->pre_final_paid || !$payment->final_paid) {
                $overallStatus = 'Pending';
            }
        }

        // Return the view with the necessary data
        return view('enrollments.fees', compact('enrollment', 'totalFees', 'balance', 'installmentAmount', 'payment', 'remainingBalance', 'overallStatus'));
    }


    public function edit($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $students = Student::all();
        $courses = Course::all();
        $semesters = Semester::all();
        $subjects = Subject::where('course_id', $enrollment->course_id)
            ->where('semester_id', $enrollment->semester_id)
            ->where('year_level', $enrollment->year_level)
            ->get();

        $selectedSubjects = json_decode($enrollment->subject_ids, true);
        $fee = Fee::where('enrollment_id', $id)->first(); // Get the fee for the enrollment
        $financialData = FinancialInformation::where('enrollment_id', $id)->first();
        // Fetch the payment related to this fee
        $payment = $fee ? Payment::where('fee_id', $fee->id)->first() : null;

        return view('enrollments.edit', compact('enrollment', 'students', 'courses', 'semesters', 'subjects', 'selectedSubjects', 'fee', 'payment', 'financialData', ));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'student_id' => 'sometimes|exists:students,id',
            'semester_id' => 'sometimes|exists:semesters,id',
            'course_id' => 'sometimes|exists:courses,id',
            'year_level' => 'sometimes|string',
            'subjects' => 'sometimes|array',
            'subjects.*' => 'exists:subjects,id',
            'category' => 'sometimes|string',
            'tuition_fee' => 'sometimes|numeric',
            'lab_fee' => 'sometimes|nullable|numeric',
            'miscellaneous_fee' => 'sometimes|nullable|numeric',
            'other_fee' => 'sometimes|nullable|numeric',
            'discount' => 'sometimes|nullable|numeric',
            'initial_payment' => 'sometimes|numeric',
            'prelims_paid' => 'sometimes|boolean',
            'midterms_paid' => 'sometimes|boolean',
            'pre_final_paid' => 'sometimes|boolean',
            'final_paid' => 'sometimes|boolean',
            'financier' => 'nullable|string',
            'company_name' => 'nullable|string',
            'company_address' => 'nullable|string',
            'contact_number'=>'nullable|string',
            'income' => 'nullable|numeric',
            'scholarship' => 'nullable|string',
            'relative_names' => 'sometimes|array',
            'relationships' => 'sometimes|array',
            'position_courses' => 'sometimes|array',
            'relative_contact_numbers' => 'sometimes|array',
        ]);
        
        try {
            DB::beginTransaction();
        
            // Find existing enrollment
            $enrollment = Enrollment::findOrFail($id);
        
            // Update only the provided fields for the enrollment
            $enrollment->update($request->only([
                'student_id',
                'semester_id',
                'course_id',
                'year_level',
                'category'
            ]));
        
            // Get related fee record
            $fee = Fee::where('enrollment_id', $id)->first();
        
            if ($fee) {
                // Update tuition fees and related fields if provided in the request
                $fee->update($request->only([
                    'tuition_fee',
                    'lab_fee',
                    'miscellaneous_fee',
                    'other_fee',
                    'discount',
                    'initial_payment',
                ]));
        
                // Recalculate balance after payment status
                $totalFees = $fee->tuition_fee + $fee->lab_fee + $fee->miscellaneous_fee + $fee->other_fee;
                $balance = $totalFees - $fee->discount - $fee->initial_payment;
        
                $payment = Payment::where('fee_id', $fee->id)->first();
        
                if ($payment) {
                    $payment->update([
                        'prelims_paid' => $request->has('prelims_paid') ? true : false,
                        'midterms_paid' => $request->has('midterms_paid') ? true : false,
                        'pre_final_paid' => $request->has('pre_final_paid') ? true : false,
                        'final_paid' => $request->has('final_paid') ? true : false,
                    ]);
        
                    // Deduct payments made only for installments marked as 'Paid'
                    if ($payment->prelims_paid) $balance -= $payment->prelims_payment;
                    if ($payment->midterms_paid) $balance -= $payment->midterms_payment;
                    if ($payment->pre_final_paid) $balance -= $payment->pre_final_payment;
                    if ($payment->final_paid) $balance -= $payment->final_payment;
                }
        
                $remainingBalance = max($balance, 0);
                $installmentAmount = $remainingBalance / 4;
        
                // Prepare financial data
                $financialData = [
                    'enrollment_id' => $enrollment->id,
                    'financier' => $validated['financier'] ?? null,
                    'company_name' => $validated['company_name'] ?? null,
                    'company_address' => $validated['company_address'] ?? null,
                    'contact_number' => $validated['contact_number'] ?? null,
                    'income' => $validated['income'] ?? null,
                    'scholarship' => $validated['scholarship'] ?? null,
                ];
        
                // Handle relative data fields with default empty arrays if not present
                $relativeNames = $validated['relative_names'] ?? [];
                $relationships = $validated['relationships'] ?? [];
                $positionCourses = $validated['position_courses'] ?? [];
                $relativeContactNumbers = $validated['relative_contact_numbers'] ?? [];
        
                // Fetch existing financial data (if any)
                $existingFinancialData = FinancialInformation::where('enrollment_id', $enrollment->id)->first();
        
                // Decode existing relative data if present, otherwise use empty arrays
              // Ensure all variables are arrays (if null, turn into empty arrays)
                $existingRelativeNames = $existingFinancialData ? json_decode($existingFinancialData->relative_names, true) : [];
                $existingRelationships = $existingFinancialData ? json_decode($existingFinancialData->relationships, true) : [];
                $existingPositionCourses = $existingFinancialData ? json_decode($existingFinancialData->position_courses, true) : [];
                $existingRelativeContactNumbers = $existingFinancialData ? json_decode($existingFinancialData->relative_contact_numbers, true) : [];

                // Merge new data with existing, ensuring no duplicates, while handling null values
                $relativeNames = array_unique(array_merge($existingRelativeNames ?: [], $relativeNames ?: []));
                $relationships = array_unique(array_merge($existingRelationships ?: [], $relationships ?: []));
                $positionCourses = array_unique(array_merge($existingPositionCourses ?: [], $positionCourses ?: []));
                $relativeContactNumbers = array_unique(array_merge($existingRelativeContactNumbers ?: [], $relativeContactNumbers ?: []));

        
                // Save or update the financial information with merged relative data
                $financialData['relative_names'] = json_encode($relativeNames);
                $financialData['relationships'] = json_encode($relationships);
                $financialData['position_courses'] = json_encode($positionCourses);
                $financialData['relative_contact_numbers'] = json_encode($relativeContactNumbers);
        
                // Check if financial data exists and update or create
                if ($existingFinancialData) {
                    $existingFinancialData->update($financialData);
                } else {
                    FinancialInformation::create($financialData);
                }
            }
        
            DB::commit();
        
            return redirect()->route('enrollments.index')->with('success', 'Enrollment updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error updating enrollment.', 'error' => $e->getMessage()], 500);
        }
    }
    



































    // public function edit($id)
    // {
    //     $enrollment = Enrollment::findOrFail($id);
    //     $students = Student::all();
    //     $courses = Course::all();
    //     $semesters = Semester::all();
    //     $subjects = Subject::where('course_id', $enrollment->course_id)
    //         ->where('semester_id', $enrollment->semester_id)
    //         ->where('year_level', $enrollment->year_level)
    //         ->get();

    //     $selectedSubjects = json_decode($enrollment->subject_ids, true);
    //     $fee = Fee::where('enrollment_id', $id)->first(); // Get the fee for the enrollment
    //     $financialData = FinancialInformation::where('enrollment_id', $id)->first(); 
    //     // Fetch the payment related to this fee
    //     $payment = $fee ? Payment::where('fee_id', $fee->id)->first() : null;

    //     return view('enrollments.edit', compact('enrollment', 'students', 'courses', 'semesters', 'subjects', 'selectedSubjects', 'fee', 'payment', 'financialData', ));
    // }



    // public function update(Request $request, $id)
    // {
    //     $validated = $request->validate([
    //         'student_id' => 'sometimes|exists:students,id',
    //         'semester_id' => 'sometimes|exists:semesters,id',
    //         'course_id' => 'sometimes|exists:courses,id',
    //         'year_level' => 'sometimes|string',
    //         'subjects' => 'sometimes|array',
    //         'subjects.*' => 'exists:subjects,id',
    //         'category' => 'sometimes|string',
    //         'tuition_fee' => 'sometimes|numeric',
    //         'lab_fee' => 'sometimes|nullable|numeric',
    //         'miscellaneous_fee' => 'sometimes|nullable|numeric',
    //         'other_fee' => 'sometimes|nullable|numeric',
    //         'discount' => 'sometimes|nullable|numeric',
    //         'initial_payment' => 'sometimes|numeric',
    //         'prelims_paid' => 'sometimes|boolean',
    //         'midterms_paid' => 'sometimes|boolean',
    //         'pre_final_paid' => 'sometimes|boolean',
    //         'final_paid' => 'sometimes|boolean',
    //     ]);

    //     try {
    //         DB::beginTransaction();

    //         // Find existing enrollment
    //         $enrollment = Enrollment::findOrFail($id);

    //         // Update only the provided fields for the enrollment
    //         $enrollment->update($request->only([
    //             'student_id',
    //             'semester_id',
    //             'course_id',
    //             'year_level',
    //             'category'
    //         ]));

    //         // Get the related fee
    //         $fee = Fee::where('enrollment_id', $id)->first();

    //         if ($fee) {
    //             // Update tuition fees and related fields if provided in the request
    //             $fee->update($request->only([
    //                 'tuition_fee',
    //                 'lab_fee',
    //                 'miscellaneous_fee',
    //                 'other_fee',
    //                 'discount',
    //                 'initial_payment',
    //             ]));

    //             // Recalculate fees after the update
    //             $tuitionFee = $fee->tuition_fee ?? 0;
    //             $labFee = $fee->lab_fee ?? 0;
    //             $miscFee = $fee->miscellaneous_fee ?? 0;
    //             $otherFee = $fee->other_fee ?? 0;
    //             $discount = $fee->discount ?? 0;
    //             $initialPayment = $fee->initial_payment ?? 0;

    //             // Calculate total fees (sum of all fees)
    //             $totalFees = $tuitionFee + $labFee + $miscFee + $otherFee;

    //             // Calculate the balance after discount and initial payment
    //             $balance = $totalFees - $discount - $initialPayment;

    //             // Get the related payment data
    //             $payment = Payment::where('fee_id', $fee->id)->first();

    //             if ($payment) {
    //                 // Update payment status based on the request (if payment exists)
    //                 $payment->update([
    //                     'prelims_paid' => $request->has('prelims_paid') ? true : false,
    //                     'midterms_paid' => $request->has('midterms_paid') ? true : false,
    //                     'pre_final_paid' => $request->has('pre_final_paid') ? true : false,
    //                     'final_paid' => $request->has('final_paid') ? true : false,
    //                 ]);

    //                 // Deduct payments made only for installments marked as 'Paid'
    //                 if ($payment->prelims_paid) {
    //                     $balance -= $payment->prelims_payment;
    //                 }
    //                 if ($payment->midterms_paid) {
    //                     $balance -= $payment->midterms_payment;
    //                 }
    //                 if ($payment->pre_final_paid) {
    //                     $balance -= $payment->pre_final_payment;
    //                 }
    //                 if ($payment->final_paid) {
    //                     $balance -= $payment->final_payment;
    //                 }
    //             }

    //             // Ensure no negative remaining balance
    //             $remainingBalance = max($balance, 0);

    //             // Calculate installment amount (remaining balance divided by 4)
    //             $installmentAmount = $remainingBalance / 4;

    //             // Overall status calculation (whether all payments are made)
    //             $overallStatus = (!$payment || !$payment->prelims_paid || !$payment->midterms_paid || !$payment->pre_final_paid || !$payment->final_paid)
    //                 ? 'Pending'
    //                 : 'Paid';



    //             // Optionally, you can return this data for the view or further processing
    //         } else {
    //             // Handle case where no fee is found for the enrollment
    //             throw new \Exception('No fee record found for the provided enrollment.');
    //         }

    //         DB::commit();
    //         return redirect()->route('enrollments.index')->with('success', 'Enrollment updated successfully!');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return back()->with('error', 'Failed to update enrollment: ' . $e->getMessage());
    //     }
    // }

















}