<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'tuition_fee',
        'lab_fee',
        'miscellaneous_fee',
        'other_fee',
        'discount',
        'initial_payment'
    ];
    protected $appends = ['total'];

    // Relationship: A fee belongs to an enrollment
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    // Computed Total Fee After Discount
    public function getTotalFeeAttribute()
    {
        return ($this->tuition_fee + $this->lab_fee + $this->miscellaneous_fee + $this->other_fee) - $this->discount -$this->initial_payment;
    }
    public function payments()
    {
        return $this->hasOne(Payment::class, 'fee_id'); // Ensure foreign key is correct
    }
}
