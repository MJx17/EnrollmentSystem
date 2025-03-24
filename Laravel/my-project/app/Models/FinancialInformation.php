<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id', // Foreign key
        'financier',
        'company_name',
        'company_address', // This was missing
        'income',
        'contact_number',
        'scholarship',
        'relative_names', // These were missing
        'relationships',
        'position_courses',
        'relative_contact_numbers'
    ];



    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }


    public function getRelativeNamesAttribute($value)
    {
        return $value ? implode(', ', json_decode($value, true)) : null;
    }

    public function getRelationshipsAttribute($value)
    {
        return $value ? implode(', ', json_decode($value, true)) : null;
    }

    public function getPositionCoursesAttribute($value)
    {
        return $value ? implode(', ', json_decode($value, true)) : null;
    }

    public function getRelativeContactNumbersAttribute($value)
    {
        return $value ? implode(', ', json_decode($value, true)) : null;
    }

}
