<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Subject extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',           // Subject name
        'code',           // Unique subject code
        'block',          // Block or class group
        'semester_id', 
        'room',   // References the Semester table
        'prerequisite_id', // References another subject as a prerequisite
        'fee',            // Subject fee
        'units',          // Subject units
        'professor_id',   // Assigned professor
        'year_level',     // Year level the subject belongs to
        'days',           // JSON array for multiple class days
        'start_time',     // Class start time
        'end_time',       // Class end time
    ];

    protected $appends = ['class_time', 'formatted_days'];
    /**
     * Relationships
     */

    // Relation to Semester
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    // Relation to prerequisite subject
    public function prerequisite()
    {
        return $this->belongsTo(Subject::class, 'prerequisite_id');
    }

    // Relation to subjects that depend on this as a prerequisite
    public function dependentSubjects()
    {
        return $this->hasMany(Subject::class, 'prerequisite_id');
    }

    // Many-to-Many: Relation to Students through enrollment
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_subject')
            ->withPivot('grade', 'status')  // Access grade and status in the pivot table
            ->withTimestamps();
    }

    // Many-to-Many: Relation to Courses

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_subject', 'subject_id', 'course_id');
    }
    



    // Many-to-Many: Relation to Professors
  
    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }

    /**
     * Method to get the subject's grade and status in the pivot for students
     */
    public function getStudentPivotData($studentId)
    {
        return $this->students()->where('student_id', $studentId)->first()->pivot;
    }

    /**
     * Method to attach professors to a subject with additional pivot data (e.g., semester)
     */
    public function assignProfessorToSubject($professorId, $pivotData = [])
    {
        return $this->professors()->attach($professorId, $pivotData);
    }

    /**
     * Method to attach courses to a subject with additional pivot data (e.g., semester)
     */
    public function assignCourseToSubject($courseId, $pivotData = [])
    {
        return $this->courses()->attach($courseId, $pivotData);
    }
    
    public function enrollments()
    {
        return $this->belongsToMany(Enrollment::class);
    }

    public function getFormattedDaysAttribute()
    {
        $dayMapping = [
            'Monday' => 'M',
            'Tuesday' => 'T',
            'Wednesday' => 'W',
            'Thursday' => 'Th',
            'Friday' => 'F',
            'Saturday' => 'S',
            'Sunday' => 'Su'
        ];

        $daysArray = json_decode($this->days, true) ?? [];
        return collect($daysArray)->map(fn($day) => $dayMapping[$day] ?? '')->implode(', ');
    }

    public function getClassTimeAttribute()
    {
        $start = Carbon::parse($this->start_time)->format('h:i A');
        $end = Carbon::parse($this->end_time)->format('h:i A');
        return "$start - $end";
    }


}
