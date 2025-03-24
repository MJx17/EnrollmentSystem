<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\LaravelPdf\Facades\Pdf;
use Illuminate\Support\Facades\Storage;


class StudentController extends Controller
{
    // Show the enrollment form
    public function create()
    {
        $user = Auth::user();
        
        // If the user is already a student, redirect them to student-info
        if ($user->student) {
            return redirect()->route('student.indexStudent')->with('message', 'You are already signed up.');
        }
    
        $courses = Course::all();
        return view('student.create', compact('user', 'courses'));
    }
    

    // Store the enrollment data
    public function store(Request $request)
    {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            // Personal Information
            'surname' => 'required|string',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'sex' => 'required|in:Male,Female,Other',
            'dob' => 'required|date',
            'age' => 'required|integer',
            'place_of_birth' => 'required|string',
            'home_address' => 'required|string',
            'mobile_number' => 'required|string',
            'email_address' => 'required|email',


            // Father's Information
            'fathers_name' => 'required|string',
            'fathers_educational_attainment' => 'required|string',
            'fathers_address' => 'required|string',
            'fathers_contact_number' => 'required|string',
            'fathers_occupation' => 'required|string',
            'fathers_employer' => 'required|string',
            'fathers_employer_address' => 'required|string',
            // Mother's Information
            'mothers_name' => 'required|string',
            'mothers_educational_attainment' => 'required|string',
            'mothers_address' => 'required|string',
            'mothers_contact_number' => 'required|string',
            'mothers_occupation' => 'required|string',
            'mothers_employer' => 'required|string',
            'mothers_employer_address' => 'required|string',
            // Guardian's Information (optional)
            'guardians_name' => 'nullable|string',
            'guardians_educational_attainment' => 'nullable|string',
            'guardians_address' => 'nullable|string',
            'guardians_contact_number' => 'nullable|string',
            'guardians_occupation' => 'nullable|string',
            'guardians_employer' => 'nullable|string',
            'guardians_employer_address' => 'nullable|string',
            // Living Situation
            'living_situation' => 'required|in:with_family,with_relatives,with_guardian,boarding_house',
            'living_address' => 'required|string',
            'living_contact_number' => 'required|string',
            // Year Level

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('student_images', 'public');
        }

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Get the currently authenticated user
        $user = Auth::user();

        // Create a new student record
        Student::create([
            'user_id' => $user->id,
            'surname' => $request->surname,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'sex' => $request->sex,
            'dob' => $request->dob,
            'age' => $request->age,
            'place_of_birth' => $request->place_of_birth,
            'home_address' => $request->home_address,
            'mobile_number' => $request->mobile_number,
            'email_address' => $request->email_address,
            'image' => $imagePath,



            'fathers_name' => $request->fathers_name,
            'fathers_educational_attainment' => $request->fathers_educational_attainment,
            'fathers_address' => $request->fathers_address,
            'fathers_contact_number' => $request->fathers_contact_number,
            'fathers_occupation' => $request->fathers_occupation,
            'fathers_employer' => $request->fathers_employer,
            'fathers_employer_address' => $request->fathers_employer_address,
            'mothers_name' => $request->mothers_name,
            'mothers_educational_attainment' => $request->mothers_educational_attainment,
            'mothers_address' => $request->mothers_address,
            'mothers_contact_number' => $request->mothers_contact_number,
            'mothers_occupation' => $request->mothers_occupation,
            'mothers_employer' => $request->mothers_employer,
            'mothers_employer_address' => $request->mothers_employer_address,

            'guardians_name' => $request->guardians_name,
            'guardians_educational_attainment' => $request->guardians_educational_attainment,
            'guardians_address' => $request->guardians_address,
            'guardians_contact_number' => $request->guardians_contact_number,
            'guardians_occupation' => $request->guardians_occupation,
            'guardians_employer' => $request->guardians_employer,
            'guardians_employer_address' => $request->guardians_employer_address,

            'living_situation' => $request->living_situation,
            'living_address' => $request->living_address,
            'living_contact_number' => $request->living_contact_number,

        ]);

        // Redirect to home page with success message
        return redirect()->route('home')->with('success', 'Student Application successful!');
    }

   
    public function update(Request $request, $id)
    {
        // Fetch the student record
        $student = Student::findOrFail($id);

        // Validate incoming data
        $validator = Validator::make($request->all(), [
            'surname' => 'sometimes|string',
            'first_name' => 'sometimes|string',
            'middle_name' => 'nullable|string',
            'sex' => 'sometimes|in:Male,Female,Other',
            'dob' => 'sometimes|date',
            'age' => 'sometimes|integer',
            'place_of_birth' => 'sometimes|string',
            'home_address' => 'sometimes|string',
            'mobile_number' => 'sometimes|string',
            'email_address' => 'sometimes|email',
            'status' => 'sometimes|string',

            // Parents' details
            'fathers_name' => 'sometimes|string',
            'fathers_educational_attainment' => 'sometimes|string',
            'fathers_address' => 'sometimes|string',
            'fathers_contact_number' => 'sometimes|string',
            'fathers_occupation' => 'sometimes|string',
            'fathers_employer' => 'sometimes|string',
            'fathers_employer_address' => 'sometimes|string',
            'mothers_name' => 'sometimes|string',
            'mothers_educational_attainment' => 'sometimes|string',
            'mothers_address' => 'sometimes|string',
            'mothers_contact_number' => 'sometimes|string',
            'mothers_occupation' => 'sometimes|string',
            'mothers_employer' => 'sometimes|string',
            'mothers_employer_address' => 'sometimes|string',

            // Guardian details
            'guardians_name' => 'nullable|string',
            'guardians_educational_attainment' => 'nullable|string',
            'guardians_address' => 'nullable|string',
            'guardians_contact_number' => 'nullable|string',
            'guardians_occupation' => 'nullable|string',
            'guardians_employer' => 'nullable|string',
            'guardians_employer_address' => 'nullable|string',

            // Living situation
            'living_situation' => 'sometimes|in:with_family,with_relatives,with_guardian,boarding_house',
            'living_address' => 'sometimes|string',
            'living_contact_number' => 'sometimes|string',

            // Image
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($student->image && Storage::exists('public/' . $student->image)) {
                Storage::delete('public/' . $student->image);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('student_images', 'public');
            $student->image = $imagePath;
        }

        // Update the student record with only provided fields
        $student->update($request->except(['image']));

        // Save image path if a new image was uploaded
        if (isset($imagePath)) {
            $student->update(['image' => $imagePath]);
        }

        return redirect()->route('student.indexAdmin')->with('success', 'Student data updated successfully!');
    }


    public function edit($id)
    {
        // Fetch the student data
        $student = Student::findOrFail($id);

        // Return the edit view with the student data
        return view('student.edit', compact('student',));
    }


    public function destroy($id)
    {
        // Fetch the student data
        $student = Student::findOrFail($id);

        // Delete the student image from storage if it exists
        if ($student->image) {
            Storage::delete('public/' . $student->image);
        }

        // Delete the student record
        $student->delete();

        // Redirect to the admin index page with success message
        return redirect()->route('student.indexAdmin')->with('success', 'Student record deleted successfully!');
    }

    public function show($id)
    {
        // Retrieve student by ID
        $student = Student::findOrFail($id);

        // Return a view to display the student's details
        return view('student.show', compact('student'));
    }



    // Admin view all students
    public function indexAdmin()
    {
        // Fetch all students (paginated)
        $students = Student::paginate(10);

        // Return the view with the students data
        return view('student.indexAdmin', compact('students'));
    }

    // Method for the student to view their own data
    public function indexStudent()
    {
        // Fetch the currently authenticated student's data
        $student = Auth::user()->student; // Assuming there is a relationship between User and Student models

        // Return the view with the student's data
        return view('student.indexStudent', compact('student'));
    }



}
