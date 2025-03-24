<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Paginate departments, 10 departments per page (you can change this number as needed)
        $departments = Department::paginate(10);
    
        // Return the view with the paginated departments
        return view('departments.index', compact('departments'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments',
        ]);

        Department::create($request->all());

        return redirect()->route('departments.index')
            ->with('success', 'Department created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($department_id)
    {
        $department = Department::findOrFail($department_id);
        return view('departments.show', compact('department'));
    }
        /**
     * Show the form for editing the specified resource.
     */
    public function edit($department_id)
    {
        $department = Department::findOrFail($department_id);
        return view('departments.edit', compact('department'));
    }
    
    public function update(Request $request, $department_id)
    {
        $department = Department::findOrFail($department_id);
        $department->update($request->all());
    
        return redirect()->route('departments.index')
            ->with('success', 'Department updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($department_id)
        {
            $department = Department::findOrFail($department_id);
            $department->delete();

            return redirect()->route('departments.index')
                ->with('success', 'Department deleted successfully.');
        }


    
}
