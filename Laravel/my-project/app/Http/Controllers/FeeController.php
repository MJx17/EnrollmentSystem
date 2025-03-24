<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    /**
     * Display a listing of fees.
     */
    public function index()
    {
        $fees = Fee::with('enrollment')->get();

        return view('fees.index', compact('fees'));
    }

    /**
     * Show the form for creating a new fee.
     */
    public function create()
    {
        return view('fees.create');
    }

    /**
     * Store a newly created fee.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'enrollment_id'    => 'required|exists:enrollments,id',
            'tuition_fee'      => 'required|numeric',
            'lab_fee'          => 'required|numeric',
            'miscellaneous_fee'=> 'required|numeric',
            'other_fee'        => 'nullable|numeric',
            'discount'         => 'nullable|numeric|min:0'
        ]);

        $validated['total_fee'] = 
            $validated['tuition_fee'] +
            $validated['lab_fee'] +
            $validated['miscellaneous_fee'] +
            ($validated['other_fee'] ?? 0) - 
            ($validated['discount'] ?? 0);

        Fee::create($validated);

        return redirect()->route('fees.index')->with('success', 'Fee record created successfully.');
    }

    /**
     * Display the specified fee.
     */
    public function show(Fee $fee)
    {
        return view('fees.show', compact('fee'));
    }

    /**
     * Show the form for editing the fee.
     */
    public function edit(Fee $fee)
    {
        return view('fees.edit', compact('fee'));
    }

    /**
     * Update the specified fee.
     */
    public function update(Request $request, Fee $fee)
    {
        $validated = $request->validate([
            'tuition_fee'      => 'sometimes|required|numeric',
            'lab_fee'          => 'sometimes|required|numeric',
            'miscellaneous_fee'=> 'sometimes|required|numeric',
            'other_fee'        => 'nullable|numeric',
            'discount'         => 'nullable|numeric|min:0'
        ]);

        $validated['total_fee'] = 
            $validated['tuition_fee'] +
            $validated['lab_fee'] +
            $validated['miscellaneous_fee'] +
            ($validated['other_fee'] ?? 0) - 
            ($validated['discount'] ?? 0);

        $fee->update($validated);

        return redirect()->route('fees.index')->with('success', 'Fee record updated successfully.');
    }

    /**
     * Remove the specified fee.
     */
    public function destroy(Fee $fee)
    {
        $fee->delete();

        return redirect()->route('fees.index')->with('success', 'Fee record deleted successfully.');
    }
}
