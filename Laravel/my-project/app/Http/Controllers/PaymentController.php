<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Fee;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments.
     */
    public function index()
    {
        $payments = Payment::with('fee')->get(); // Load the related Fee instead of Enrollment

        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new payment.
     */
    public function create()
    {
        $fees = Fee::all(); // Fetch all fees to associate with a payment
        return view('payments.create', compact('fees'));
    }

    /**
     * Store a newly created payment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fee_id'           => 'required|exists:fees,id', // Link to Fee instead of Enrollment
            'initial_payment'  => 'nullable|numeric|min:0',
            'prelims_payment'  => 'nullable|numeric|min:0',
            'midterms_payment' => 'nullable|numeric|min:0',
            'pre_final_payment'=> 'nullable|numeric|min:0',
            'final_payment'    => 'nullable|numeric|min:0',
        ]);

        $fee = Fee::findOrFail($validated['fee_id']);

        $validated['total_paid'] = 
            ($validated['initial_payment'] ?? 0) +
            ($validated['prelims_payment'] ?? 0) +
            ($validated['midterms_payment'] ?? 0) +
            ($validated['pre_final_payment'] ?? 0) +
            ($validated['final_payment'] ?? 0);

        $validated['remaining_balance'] = $fee->total_fee - $validated['total_paid'];

        Payment::create($validated);

        return redirect()->route('payments.index')->with('success', 'Payment record created successfully.');
    }

    /**
     * Display the specified payment.
     */
    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the payment.
     */
    public function edit(Payment $payment)
    {
        $fees = Fee::all(); // Fetch fees for selection
        return view('payments.edit', compact('payment', 'fees'));
    }

    /**
     * Update the specified payment.
     */
    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'initial_payment'  => 'nullable|numeric|min:0',
            'prelims_payment'  => 'nullable|numeric|min:0',
            'midterms_payment' => 'nullable|numeric|min:0',
            'pre_final_payment'=> 'nullable|numeric|min:0',
            'final_payment'    => 'nullable|numeric|min:0',
        ]);

        $fee = Fee::findOrFail($payment->fee_id); // Use fee_id instead of enrollment_id

        $validated['total_paid'] = 
            ($validated['initial_payment'] ?? $payment->initial_payment) +
            ($validated['prelims_payment'] ?? $payment->prelims_payment) +
            ($validated['midterms_payment'] ?? $payment->midterms_payment) +
            ($validated['pre_final_payment'] ?? $payment->pre_final_payment) +
            ($validated['final_payment'] ?? $payment->final_payment);

        $validated['remaining_balance'] = $fee->total_fee - $validated['total_paid'];

        $payment->update($validated);

        return redirect()->route('payments.index')->with('success', 'Payment record updated successfully.');
    }

    /**
     * Remove the specified payment.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Payment record deleted successfully.');
    }
}
