<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Enrollment extends Model
{
    protected $fillable = [
        'student_id',
        'semester_id',
        'course_id',
        'year_level',
        'category'

    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subject')->withTimestamps();
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);  // Added the course relationship
    }

    public function fees()
    {
        return $this->hasOne(Fee::class, 'enrollment_id'); // Adjust table name if necessary
    }

    public function payments()
    {
       return 
            
        $this->hasOne(Payment::class, 'fee_id');
    }
    // In your Enrollment Model

    public function getFormattedYearLevelAttribute()
    {
        $yearLevels = [
            'first_year' => 'First Year',
            'second_year' => 'Second Year',
            'third_year' => 'Third Year',
            'fourth_year' => 'Fourth Year',
            'fifth_year' => 'Fifth Year',
            // Add more levels if necessary
        ];

        return $yearLevels[$this->year_level] ?? 'N/A';
    }

    public function financialInformation()
    {
        return $this->hasOne(FinancialInformation::class,  'enrollment_id');
    }

}
