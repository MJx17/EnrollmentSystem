<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'surname',
        'first_name',
        'middle_name',
        'sex',
        'dob',
        'age',
        'place_of_birth',
        'home_address',
        'mobile_number',
        'email_address',

        'fathers_name',
        'fathers_educational_attainment',
        'fathers_address',
        'fathers_contact_number',
        'fathers_occupation',
        'fathers_employer',
        'fathers_employer_address',

        'mothers_name',
        'mothers_educational_attainment',
        'mothers_address',
        'mothers_contact_number',
        'mothers_occupation',
        'mothers_employer',
        'mothers_employer_address',

        'guardians_name',
        'guardians_educational_attainment',
        'guardians_address',
        'guardians_contact_number',
        'guardians_occupation',
        'guardians_employer',
        'guardians_employer_address',
        
        'living_situation',
        'living_address',
        'living_contact_number',
        'image',
        'status'
    ];

    /**
     * Relationship with User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with Grades.
     */
    public function grades()
    {
        return $this->hasMany(Grade::class, 'student_id');
    }

    /**
     * Relationship with Subjects (enrollment data moved to subject_student table).
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subject')
                    ->withPivot('status', 'grade')  // Including enrollment status and remarks
                    ->withTimestamps();
    }

    public function professors()
    {
        return $this->belongsToMany(Professor::class, 'professor_subject');
    }


    /**
     * Relationship with Course.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Dynamically get the year level based on enrolled subjects and other criteria.
     */

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
     public function getFormattedLivingSituationAttribute()
     {
         $livingSituation = [
             'with_guardian' => 'With Guardian',
             'with_family' => 'With Family',
             'with_relatives' => 'With Relatives',
             'boarding_house' => 'Boarding House',
             // Add more levels if necessary
         ];
 
         return $livingSituation[$this->living_situation] ?? 'N/A';
     }


     public function getYearLevelByStudentId($studentId)
        {
            // Get the enrollment for the student based on student_id
            $enrollment = Enrollment::where('student_id', $studentId)->first();

            // Check if the enrollment exists and return the formatted year level
            if ($enrollment) {
                return $enrollment->formatted_year_level; // This uses the accessor we defined earlier
            }

            return 'N/A'; // Return 'N/A' if no enrollment is found
        }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->surname;
    }

        public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function enrollment()
{
    return $this->hasOne(Enrollment::class);
}


}