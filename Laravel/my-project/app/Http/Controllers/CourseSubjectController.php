<?php

namespace App\Http\Controllers;

use App\Models\CourseSubject;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;

class CourseSubjectController extends Controller
{
    // Display all course-subject mappings grouped by course_code
    public function index()
    {
        $courseSubjects = CourseSubject::with(['course', 'subject'])->get();
    
        // Group by course_code and include course_name properly
        $groupedCourses = $courseSubjects->groupBy(fn($item) => $item->course->course_code)
            ->map(function ($subjects, $courseCode) {
                return [
                    'course_name' => optional($subjects->first()->course)->course_name,
                    'course_code' => optional($subjects->first()->course)->course_code, 
                    'subjects' => $subjects, // Keep the original structure
                ];
            });
    
        return view('course-subjects.index', compact('groupedCourses', 'courseSubjects'));
    }
    
    
    // Show form to assign subjects to a course
    public function create($course_code)
    {
        $course = Course::where('course_code', $course_code)->firstOrFail();
    
        // Get assigned subjects for the course
        $assignedSubjects = $course->subjects;
    
        // Get available subjects that are not assigned
        $availableSubjects = Subject::whereNotIn('id', $assignedSubjects->pluck('id'))->get();
    
        return view('course-subjects.create', compact('course', 'assignedSubjects', 'availableSubjects'));
    }
    
    public function store(Request $request, $course_code)
    {
        $request->validate([
            'add_subjects' => 'required|array',
            'add_subjects.*' => 'exists:subjects,id',
        ]);
    
        $course = Course::where('course_code', $course_code)->firstOrFail();
    
        // Attach new subjects (avoiding duplicates)
        $course->subjects()->syncWithoutDetaching($request->add_subjects);
    
        return redirect()->route('course-subjects.index')->with('success', 'Subjects assigned successfully.');
    }
    

    public function edit($course_code)
    {
        $course = Course::where('course_code', $course_code)->firstOrFail();

        // Get subjects already assigned to this course
        $assignedSubjects = $course->subjects;

        // Get all subjects (for check/uncheck functionality)
        $allSubjects = Subject::all();

        return view('course-subjects.edit', compact('course', 'assignedSubjects', 'allSubjects'));
    }

    public function update(Request $request, $courseCode)
    {
        $request->validate([
            'subject_ids' => 'array', // Allow empty (if all unchecked)
            'subject_ids.*' => 'exists:subjects,id',
        ]);

        $course = Course::where('course_code', $courseCode)->firstOrFail();

        // Sync subjects: This will add checked subjects & remove unchecked ones
        $course->subjects()->sync($request->subject_ids ?? []);

        return redirect()->route('course-subjects.index')->with('success', 'Subjects updated successfully.');
    }


    
    
    // Remove a subject from all courses in the group
    public function destroy($course_id, $subject_id)
    {
        $course = Course::findOrFail($course_id);
        $groupCourses = Course::where('course_code', $course->course_code)->pluck('id');

        CourseSubject::whereIn('course_id', $groupCourses)
                     ->where('subject_id', $subject_id)
                     ->delete();
    
        return redirect()->route('course-subjects.index')->with('success', 'Subject removed from course group.');
    }
}
