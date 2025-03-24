<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\StudentSubject;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class StudentSubjectController extends Controller
{
    public function store(Request $request)
    {
        // Assuming you're storing new enrollment data (status and grade)
        $studentSubject = StudentSubject::create($request->all());

        return response()->json($studentSubject, 201);
    }

    public function updateGrade(Request $request, $id)
    {
        $studentSubject = StudentSubject::findOrFail($id);
        $studentSubject->grade = $request->input('grade');
        $studentSubject->save();

        return response()->json($studentSubject);
    }

    public function delete($id)
    {
        $studentSubject = StudentSubject::findOrFail($id);
        $studentSubject->delete();

        return response()->json(['message' => 'Enrollment removed']);
    }

    public function show($studentId)
    {
        // Fetch the student along with enrollment
        $student = Student::with('enrollment')->findOrFail($studentId);
        $user = auth()->user(); // Get the logged-in user
    
        // Ensure the user is a professor and can only access their own profile
        if ($user->hasRole('student') && optional($user->student)->id !== $student->id) {
            abort(403, 'Unauthorized access');
        }

        // Fetch subjects with pagination
        $subjects = $student->subjects()
            ->select([
                'subjects.id', 
                'subjects.name', 
                'subjects.code', 
                'subjects.block',
                'subjects.semester_id',
                'subjects.prerequisite_id',
                'subjects.fee',
                'subjects.units',
                'subjects.professor_id',
                'subjects.year_level',
                'subjects.days',
                'subjects.start_time',
                'subjects.end_time'
            ])
            ->withPivot('status', 'grade') // Include pivot data
            ->paginate(10); // Show 10 subjects per page

        return view('student_subject.subjects', compact('student', 'subjects'));
    }

    

    public function edit($studentId)
{
    // Fetch the student and their enrolled subjects with pivot data
    $student = Student::with(['subjects' => function ($query) {
        $query->select(
            'subjects.id',
            'subjects.name',
            'subjects.code',
            'subjects.block',
            'subjects.semester_id',
            'subjects.prerequisite_id',
            'subjects.fee',
            'subjects.units',
            'subjects.professor_id',
            'subjects.year_level',
            'subjects.days',
            'subjects.start_time',
            'subjects.end_time'
        )->withPivot('status', 'grade');
    }])->findOrFail($studentId);

    return view('student_subject.edit', compact('student'));
}


public function update(Request $request, $studentId)
{
    // Validate the input
    $request->validate([
        'subjects.*.status' => 'required|string',
        'subjects.*.grade' => 'nullable|string',
    ]);

    // Loop through the subjects and update the pivot data
    foreach ($request->subjects as $subjectId => $data) {
        $studentSubject = StudentSubject::where('student_id', $studentId)
                                        ->where('subject_id', $subjectId)
                                        ->first();

        if ($studentSubject) {
            $studentSubject->status = $data['status'];
            $studentSubject->grade = $data['grade'] ?? null; // Grade can be optional
            $studentSubject->save();
        }
    }

    // Redirect back to the student subjects page with a success message
    return redirect()->route('student_subject.subjects', $studentId)
                     ->with('success', 'Subjects updated successfully.');
}



public function showSubjects()
{
    $subjects = Subject::with(['students' => function ($query) {
        $query->select('students.id', 'students.fullname')
              ->withPivot('status', 'grade'); // Include pivot data
    }])->get();

    return view('subjects.index', compact('subjects'));
}

public function updateGrades(Request $request)
{
    $request->validate([
        'grades.*.student_id' => 'required|exists:students,id',
        'grades.*.subject_id' => 'required|exists:subjects,id',
        'grades.*.grade' => 'nullable|string|max:3',
    ]);

    foreach ($request->grades as $gradeData) {
        DB::table('student_subject')
            ->where('student_id', $gradeData['student_id'])
            ->where('subject_id', $gradeData['subject_id'])
            ->update(['grade' => $gradeData['grade']]);
    }

    return redirect()->back()->with('success', 'Grades updated successfully.');
}


public function showGrades()
{
    // Get the logged-in professor
    $professor = Auth::user();

    // Get subjects assigned to this professor
    $subjects = Subject::where('professor_id', $professor->id)->with('students')->get();

    return view('professors.grades', compact('subjects'));
}

public function submitGrades(Request $request)
{
    $professor = Auth::user();

    // Validate request
    $request->validate([
        'grades.*.*' => 'nullable|numeric|min:0|max:100',
    ]);

    foreach ($request->grades as $studentId => $grades) {
        foreach ($grades as $subjectId => $grade) {
            $subject = Subject::findOrFail($subjectId);

            // Ensure the subject belongs to the professor
            if ($subject->professor_id != $professor->id) {
                return back()->with('error', 'Unauthorized to update this subject.');
            }

            // Update grade in pivot table
            $subject->students()->updateExistingPivot($studentId, ['grade' => $grade]);
        }
    }

    return back()->with('success', 'Grades updated successfully.');
}



    
}