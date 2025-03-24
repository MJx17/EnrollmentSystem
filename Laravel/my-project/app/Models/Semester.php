<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'semesters';

    // The attributes that are mass assignable.
    protected $fillable = [
        'academic_year',
        'semester',
        'start_date',
        'end_date',
    ];

    // If you're using timestamps (created_at and updated_at), no need to define this unless you want custom behavior
    public $timestamps = true;

    
    public function getFullSemesterAttribute()
    {
        return $this->semester . ' Semester - ' . $this->academic_year;
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
    
// Accessor to get formatted semester (e.g., "1st" to "First Semester")
public function getSemesterTextAttribute()
{
    // Get the semester value directly from the model
    $semester = $this->semester ?? 'N/A';  // Ensure 'semester' is available

    // Map the semester prefix to its word equivalent
    $semesterMapping = [
        '1st' => 'First',
        '2nd' => 'Second',
        '3rd' => 'Third',
        '4th' => 'Fourth',
        // Add more mappings if needed
    ];

    // Return formatted semester with "Semester" appended, or 'N/A' if no match
    return isset($semesterMapping[$semester]) ? $semesterMapping[$semester] . ' Semester' : 'N/A';
}



    
}
