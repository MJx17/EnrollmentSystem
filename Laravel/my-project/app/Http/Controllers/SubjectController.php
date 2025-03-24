<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Course;
use App\Models\Professor;
use App\Models\Semester;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SubjectController extends Controller
{
    // Display a listing of subjects
    public function index()
    {
        $subjects = Subject::paginate(10);
        
        return view('subjects.index', compact('subjects'));
    }

    // Show the form to create a new subject
    public function create()
    {
        $courses = Course::all();
        $professors = Professor::with('user')->get();
        $semesters = Semester::all();
        $subjects = Subject::all(); // For prerequisites

        return view('subjects.create', compact('courses', 'professors', 'semesters', 'subjects'));
    }

    // Store a newly created subject
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:subjects,code',
            'semester_id' => 'required|exists:semesters,id',
            'year_level' => 'required|string',
            'prerequisite_id' => 'nullable|exists:subjects,id',
            'fee' => 'required|numeric|min:0',
            'units' => 'required|numeric|min:0.1|max:10',
            'course_ids' => 'required|array',
            'course_ids.*' => 'exists:courses,id',
            'professor_id' => 'required|exists:professors,id',
            'days' => 'required|array',
            'days.*' => 'string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room'  => 'required|string',
            'block' => 'required|string'

        ]);

        $subject = Subject::create([
            'name' => $validatedData['name'],
            'code' => $validatedData['code'],
            'semester_id' => $validatedData['semester_id'],
            'year_level' => $validatedData['year_level'],
            'prerequisite_id' => $validatedData['prerequisite_id'],
            'fee' => $validatedData['fee'],
            'units' => $validatedData['units'],
            'professor_id' => $validatedData['professor_id'],
            'days' => json_encode($validatedData['days']),
            'start_time' => $validatedData['start_time'],
            'end_time' => $validatedData['end_time'],
            'room'=> $validatedData['room'],
            'block'=>$validatedData['block'],
        ]);

        $subject->courses()->attach($validatedData['course_ids']);

        return redirect()->route('subjects.index')->with('success', ' Subject created successfully!');
    }

    // Show the form to edit the subject
    public function edit($id)
    {
        // Fetch the subject with its related data (courses, professor, and semester)
        $subject = Subject::with(['courses', 'professor', 'semester'])->findOrFail($id);
    
        // Fetch available courses, professors, semesters, and subjects (excluding the current one)
        $courses = Course::all();
        $professors = Professor::with('user')->get();
        $semesters = Semester::all();
        $subjects = Subject::where('id', '!=', $subject->id)->get(); // Exclude the current subject
    
        // Return the edit view with the data
        return view('subjects.edit', compact('subject', 'courses', 'professors', 'semesters', 'subjects'));
    }
    
    

    // Update the subject
    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);
    
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:subjects,code,' . $subject->id,
            'semester_id' => 'required|exists:semesters,id',
            'year_level' => 'required|string',
            'prerequisite_id' => 'nullable|exists:subjects,id',
            'fee' => 'required|numeric|min:0',
            'units' => 'required|numeric|min:0.1|max:10',
            'course_ids' => 'required|array',
            'course_ids.*' => 'exists:courses,id',
            'professor_id' => 'required|exists:professors,id',
            'days' => 'required|array',
            'days.*' => 'string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room'  => 'required|string',
            'block' => 'required|string'
        ]);
    
        // Update the subject with the validated data
        $subject->update([
            'name' => $validatedData['name'],
            'code' => $validatedData['code'],
            'semester_id' => $validatedData['semester_id'],
            'year_level' => $validatedData['year_level'],
            'prerequisite_id' => $validatedData['prerequisite_id'],
            'fee' => $validatedData['fee'],
            'units' => $validatedData['units'],
            'professor_id' => $validatedData['professor_id'],
            'days' => json_encode($validatedData['days']),
            'start_time' => $validatedData['start_time'],
            'end_time' => $validatedData['end_time'],
            'room'=> $validatedData['room'],
            'block'=>$validatedData['block'],
        ]);
    
        // Sync the related courses (many-to-many relationship)
        $subject->courses()->sync($validatedData['course_ids']);
    
        // Redirect with success message
        return redirect()->route('subjects.index')->with('updated', 'Subject updated successfully!');
    }
    

    // Delete the subject
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('subjects.index')->with('deleted', ' Subject deleted successfully!');
    }

    // Display a single subject
    public function show($id)
    {
        $subject = Subject::with(['courses', 'professor', 'semester'])->findOrFail($id);
        return view('subjects.show', compact('subject'));
    }


            
}
