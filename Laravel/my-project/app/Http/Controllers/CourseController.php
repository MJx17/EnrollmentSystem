<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load the 'department' relationship and paginate the results for better performance
        $courses = Course::with('department')->paginate(10); // Adjust pagination number as needed
    
        // Return the view with the courses data
        return view('courses.index', compact('courses'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all(); // Get all departments to use in the form
        return view('courses.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_code' => 'required|string|max:255|unique:courses',
            'course_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'units' => 'required|integer|min:1',
            'department_id' => 'required|exists:departments,id',
        ]);

        Course::create($request->all());

        return redirect()->route('courses.index')
            ->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($course_id)
    {
        $course = Course::findOrFail($course_id);
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($course_id)
    {
        $course = Course::findOrFail($course_id);
        $departments = Department::all(); // Get all departments to use in the form
        return view('courses.edit', compact('course', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $course_id)
    {
        $course = Course::findOrFail($course_id);

        $request->validate([
            'course_code' => 'required|string|max:255|unique:courses,course_code,' . $course->id,
            'course_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'units' => 'required|integer|min:1',
            'department_id' => 'required|exists:departments,id',
        ]);

        $course->update($request->all());

        return redirect()->route('courses.index')
            ->with('updated', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($course_id)
    {
        $course = Course::findOrFail($course_id);
        $course->delete();

        return redirect()->route('courses.index')
            ->with('deleted', 'Course deleted successfully.');
    }
}
