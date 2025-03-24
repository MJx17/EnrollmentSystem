<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Student;
use Spatie\Permission\Traits\HasRoles;


class ProfessorGradingController extends Controller
{
    /**
     * Display the list of students enrolled in a specific subject assigned to the professor.
     */
    // public function showStudentsForGrading($subjectId)
    // {
    //     $professor = Auth::user();

    //     // Find the subject and ensure it belongs to the professor
    //     $subject = Subject::where('id', $subjectId)
    //         ->where('professor_id', $professor->id)
    //         ->with('students')
    //         ->firstOrFail();

    //     return view('professors.grade_students', compact('subject', 'professor'));
    // }

    public function showStudentsForGrading($subjectId)
    {
        $user = Auth::user();
    
        if ($user->hasRole('admin')) {
            // Admins can access any subject
            $subject = Subject::where('id', $subjectId)
                ->with('students')
                ->firstOrFail();
        } elseif ($user->hasRole('professor')) {
            // Get the professor record
            $professor = $user->professor;
    
            // Professors can only access their own subjects
            $subject = Subject::where('id', $subjectId)
                ->where('professor_id', $professor->id) // Correctly checking professor's ID
                ->with('students')
                ->firstOrFail();
        } else {
            // Other roles get a 403 error
            abort(403, 'Unauthorized access.');
        }
    
        return view('professors.grade_students', compact('subject', 'user'));
    }
    


    /**
     * Update grades for students in the specific subject.
     */
    public function updateGrades(Request $request, $subjectId)
    {
        $user = Auth::user();
    
        if ($user->hasRole('admin')) {
            // Admins can update any subject's grades
            $subject = Subject::where('id', $subjectId)->firstOrFail();
        } elseif ($user->hasRole('professor')) {
            // Professors can only update their own subjects
            $subject = Subject::where('id', $subjectId)
                ->where('professor_id', $user->professor->id ?? null)
                ->firstOrFail();
        } else {
            // Other roles are unauthorized
            abort(403, 'Unauthorized action.');
        }
    
        // Validate input
        $request->validate([
            'grades.*' => 'nullable|numeric|min:0|max:100',
        ]);
    
        // Update grades for each student
        foreach ($request->grades as $studentId => $grade) {
            $subject->students()->updateExistingPivot($studentId, ['grade' => $grade]);
        }
    
        return back()->with('success', 'Grades updated successfully.');
    }
    
}