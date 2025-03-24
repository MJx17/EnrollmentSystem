<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Enrollment;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Professor;
use App\Models\CourseSubject;
use App\Models\StudentSubject;
use App\Models\ProfessorSubject;
use App\Models\Fee;
use App\Models\Payment;
use App\Models\FinancialInformation;
use Carbon\Carbon;

class DepartmentCourseSubjectSemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Step 1: Create Departments
        $departments = [
            'Business Administration',
            'Tourism Management',
            'Secondary Education',
            'Criminology',
            'Computer Science',
            'Nursing'
        ];

        foreach ($departments as $departmentName) {
            Department::create(['name' => $departmentName]);
        }

        // Step 2: Create Courses
        $course1 = Course::create([
            'course_code' => 'BSN',
            'course_name' => 'Bachelor of Science in Nursing',
            'description' => 'A program that prepares students for careers in nursing.',
            'units' => 3,
            'department_id' => 6,  // Department ID for Nursing
        ]);

        $course2 = Course::create([
            'course_code' => 'BSCrim',
            'course_name' => 'Bachelor of Science in Criminology',
            'description' => 'A program focused on criminal law enforcement and justice.',
            'units' => 3,
            'department_id' => 4,  // Department ID for Criminology
        ]);

        $course3 = Course::create([
            'course_code' => 'BSCS',
            'course_name' => 'Bachelor of Science in Computer Science',
            'description' => 'A program for students pursuing careers in software development and computer systems.',
            'units' => 3,
            'department_id' => 5,  // Department ID for Computer Science
        ]);

        $course4 = Course::create([
            'course_code' => 'BSBA',
            'course_name' => 'Bachelor of Science in Business Administration',
            'description' => 'A program focused on business management and administration.',
            'units' => 3,
            'department_id' => 1,  // Department ID for Business Administration
        ]);

        // Majors for Business Administration (BSBA)
        $course5 = Course::create([
            'course_code' => 'BSBA-OPM',
            'course_name' => 'Bachelor of Science in Business Administration - Operation Management',
            'description' => 'A major focused on managing business operations.',
            'units' => 3,
            'major' => 'Operation Management',
            'department_id' => 1,  // Department ID for Business Administration
        ]);

        // Step 3: Create Semesters
        $semester1 = Semester::create([
            'academic_year' => '2022-2023',
            'semester' => '1st',
            'start_date' => Carbon::parse('2022-08-01'),
            'end_date' => Carbon::parse('2022-12-15'),
        ]);

        $semester2 = Semester::create([
            'academic_year' => '2022-2023',
            'semester' => '2nd',
            'start_date' => Carbon::parse('2023-01-10'),
            'end_date' => Carbon::parse('2023-05-15'),
        ]);

                // Fetch professors
        $professor1 = Professor::find(1);
        $professor2 = Professor::find(2);
        $professor3 = Professor::find(3);
       $professor4 = Professor::find(4);
        $professor5 = Professor::find(5);
        $professor6 = Professor::find(6);
      $professor7 = Professor::find(7);
      $professor8 = Professor::find(8);
      $professor9 = Professor::find(9);
                

        // Step 4: Create Subjects
        
        $ge1 = Subject::create([
            'name' => 'Understanding the Self',
            'code' => 'GE 1',
            'semester_id' => $semester1->id,
            'prerequisite_id' => null,
            'fee' => 500,
            'units' => 3,
            'year_level' => 'first_year',
            'block' => 'A',
            'room' =>  'MT-1',
            'professor_id' => $professor8->id,
            'days' => json_encode(['Monday', 'Wednesday']),
            'start_time' => '08:00:00',
            'end_time' => '09:30:00',
        ]);
        
        $ge2 = Subject::create([
            'name' => 'Reading in Philippine History',
            'code' => 'GE 2',
            'semester_id' => $semester1->id,
            'prerequisite_id' => null,
            'fee' => 400,
            'units' => 3,
            'year_level' => 'first_year',
            'block' => 'A',
            'room' =>  'MT-2',
            'professor_id' => $professor9->id,
            'days' => json_encode(['Tuesday', 'Thursday']),
            'start_time' => '10:00:00',
            'end_time' => '11:30:00',
        ]);
        
        $ge3 = Subject::create([
            'name' => 'The Contemporary World',
            'code' => 'GE 3',
            'semester_id' => $semester1->id,
            'prerequisite_id' => null,
            'fee' => 450,
            'units' => 3,
            'year_level' => 'first_year',
            'block' => 'A',
            'room' =>  'MT-3',
            'professor_id' => $professor1->id,
            'days' => json_encode(['Monday', 'Wednesday']),
            'start_time' => '13:00:00',
            'end_time' => '14:30:00',
        ]);
        
        $ge4 = Subject::create([
            'name' => 'Mathematics in the Modern World',
            'code' => 'GE 4',
            'semester_id' => $semester1->id,
            'prerequisite_id' => null,
            'fee' => 600,
            'units' => 3,
            'year_level' => 'first_year',
            'block' => 'A',
            'room' =>  'MT-4',
            'professor_id' => $professor2->id,
            'days' => json_encode(['Tuesday', 'Thursday']),
            'start_time' => '15:00:00',
            'end_time' => '16:30:00',
        ]);
        
        $ba1 = Subject::create([
            'name' => 'Principles of Management and Organization',
            'code' => 'BA 1',
            'semester_id' => $semester1->id,
            'prerequisite_id' => null,
            'fee' => 800,
            'units' => 3,
            'year_level' => 'first_year',
            'block' => 'A',
            'room' =>  'MT-5',
            'professor_id' => $professor3->id,
            'days' => json_encode(['Friday']),
            'start_time' => '09:00:00',
            'end_time' => '12:00:00',
        ]);
        
        $pe1 = Subject::create([
            'name' => 'Fundamentals of Motor Skills',
            'code' => 'PE 1',
            'semester_id' => $semester1->id,
            'prerequisite_id' => null,
            'fee' => 200,
            'units' => 1,
            'year_level' => 'first_year',
            'block' => 'A',
            'room' =>  'MT-5',
            'professor_id' => $professor3->id,
            'days' => json_encode(['Monday', 'Wednesday']),
            'start_time' => '08:00:00',
            'end_time' => '09:30:00',
        ]);
        
        $nstp1 = Subject::create([
            'name' => 'National Service Training Program',
            'code' => 'NSTP 1',
            'semester_id' => $semester1->id,
            'prerequisite_id' => null,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'first_year',
            'block' => 'A',
            'room' =>  'MT-5',
            'professor_id' => $professor4->id,
            'days' => json_encode(['Saturday']),
            'start_time' => '13:00:00',
            'end_time' => '15:00:00',
        ]);
        
        $perDev1 = Subject::create([
            'name' => 'ACC Standard',
            'code' => 'Per Dev 1',
            'semester_id' => $semester1->id,
            'prerequisite_id' => null,
            'fee' => 100,
            'units' => 1,
            'year_level' => 'first_year',
            'block' => 'A',
            'room' =>  'MT-6',
            'professor_id' => $professor4->id,
            'days' => json_encode(['Tuesday', 'Thursday']),
            'start_time' => '10:00:00',
            'end_time' => '11:30:00',
        ]);
        
        $ge5 = Subject::create([
            'name' => 'Purposive Communication',
            'code' => 'GE 5',
            'semester_id' => $semester2->id,
            'prerequisite_id' => null,
            'fee' => 500,
            'units' => 3,
            'room' =>  'MT-7',
            'year_level' => 'first_year',
            'block' => 'A',
            'professor_id' => $professor4->id,
            'days' => json_encode(['Monday', 'Wednesday']),
            'start_time' => '14:00:00',
            'end_time' => '15:30:00',
        ]);
        
        $ge6 = Subject::create([
            'name' => 'Art Appreciation',
            'code' => 'GE 6',
            'semester_id' => $semester2->id,
            'prerequisite_id' => null,
            'fee' => 450,
            'units' => 3,
            'year_level' => 'first_year',
            'block' => 'A',
            'room' =>  'MT-8',
            'professor_id' => $professor5->id,
            'days' => json_encode(['Tuesday', 'Thursday']),
            'start_time' => '09:00:00',
            'end_time' => '10:30:00',
        ]);
        
        $ge7 = Subject::create([
            'name' => 'Science, Technology, and Society',
            'code' => 'GE 7',
            'semester_id' => $semester2->id,
            'prerequisite_id' => null,
            'fee' => 600,
            'units' => 3,
            'year_level' => 'first_year',
            'block' => 'A',
            'room' =>  'MT-8',
            'professor_id' => $professor5->id,
            'days' => json_encode(['Friday']),
            'start_time' => '13:00:00',
            'end_time' => '14:30:00',
        ]);
        
        $ge8 = Subject::create([
            'name' => 'Ethics',
            'code' => 'GE 8',
            'semester_id' => $semester2->id,
            'prerequisite_id' => null,
            'fee' => 400,
            'units' => 3,
            'year_level' => 'first_year',
            'block' => 'A',
            'room' =>  'MT-9',
            'professor_id' => $professor1->id,
            'days' => json_encode(['Monday', 'Wednesday']),
            'start_time' => '11:00:00',
            'end_time' => '12:30:00',
        ]);
        
        $eco1 = Subject::create([
            'name' => 'Introduction to Economics w/ TAR',
            'code' => 'Eco 1',
            'semester_id' => $semester2->id,
            'prerequisite_id' => null,
            'fee' => 700,
            'units' => 3,
            'year_level' => 'first_year',
            'block' => 'A',
            'room' =>  'L2',
            'professor_id' => $professor5->id,
            'days' => json_encode(['Tuesday', 'Thursday']),
            'start_time' => '13:00:00',
            'end_time' => '14:30:00',
        ]);
        
        $pe2 = Subject::create([
            'name' => 'Fundamentals of Rhythm & Dances',
            'code' => 'PE 2',
            'semester_id' => $semester2->id,
            'prerequisite_id' => $pe1->id,
            'fee' => 250,
            'units' => 2,
            'year_level' => 'first_year',
            'block' => 'A',
            'room' =>  'L3',
            'professor_id' => $professor6->id,
            'days' => json_encode(['Friday']),
            'start_time' => '10:00:00',
            'end_time' => '11:30:00',
        ]);
        
    
        $nstp2 = Subject::create([
            'name' => 'National Service Training Program',
            'code' => 'NSTP 2',
            'semester_id' => $semester2->id,
            'prerequisite_id' => $nstp1->id, // Prerequisite NSTP 1
            'fee' => 550, // Typically free, unless there is a fee
            'units' => 3,
            'year_level' => 'first_year',
            'block' => 'A',
            'room' =>  'L4',
            'professor_id' => $professor6->id,
            'days' => json_encode(['Monday', 'Wednesday']),
            'start_time' => '08:00:00',
            'end_time' => '09:30:00',
        ]);
        
        $perDev2 = Subject::create([
            'name' => 'Acc Quality',
            'code' => 'Per Dev 2',
            'semester_id' => $semester2->id,
            'prerequisite_id' => $perDev1->id, // Prerequisite Per Dev 1
            'fee' => 100, // Example fee
            'units' => 3,
            'year_level' => 'first_year',
            'block' => 'A',
            'room' =>  'L4',
            'professor_id' => $professor6->id,
            'days' => json_encode(['Tuesday', 'Thursday']),
            'start_time' => '10:00:00',
            'end_time' => '11:30:00',
        ]);
        
        

                // Second Year - 1st Semester Subjects
        $ge9 = Subject::create([
            'name' => "Rizal's Life and Works",
            'code' => 'GE 9',
            'semester_id' => $semester1->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'second_year',
            'block' => 'A',
            'room' =>  'L5',
            'professor_id' => $professor7->id,
            'days' => json_encode(['Monday', 'Wednesday']),
            'start_time' => '08:00:00',
            'end_time' => '09:30:00',
        ]);

        $bacc1 = Subject::create([
            'name' => 'Basic Microeconomics',
            'code' => 'BACC 1',
            'semester_id' => $semester1->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'second_year',
            'block' => 'A',
            'room' =>  'L6',
            'professor_id' => $professor2->id,
            'days' => json_encode(['Tuesday', 'Thursday']),
            'start_time' => '10:00:00',
            'end_time' => '11:30:00',
        ]);

        $bacc2 = Subject::create([
            'name' => 'Business Law (Obligation & Contracts)',
            'code' => 'BACC 2',
            'semester_id' => $semester1->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'second_year',
            'block' => 'A',
            'room' =>  'L7',
            'professor_id' => $professor3->id,
            'days' => json_encode(['Monday', 'Wednesday']),
            'start_time' => '11:30:00',
            'end_time' => '13:00:00',
        ]);

        $bapc1 = Subject::create([
            'name' => 'Banking and Financial Institutions',
            'code' => 'BAPC 1',
            'semester_id' => $semester1->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'second_year',
            'block' => 'A',
            'room' =>  'L8',
            'professor_id' => $professor4->id,
            'days' => json_encode(['Tuesday', 'Thursday']),
            'start_time' => '13:30:00',
            'end_time' => '15:00:00',
        ]);

        $ba2 = Subject::create([
            'name' => 'Human Behavior in Organization',
            'code' => 'BA 2',
            'semester_id' => $semester1->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'second_year',
            'block' => 'A',
            'room' =>  'L9',
            'professor_id' => $professor5->id,
            'days' => json_encode(['Monday', 'Wednesday']),
            'start_time' => '15:30:00',
            'end_time' => '17:00:00',
        ]);

        $ba3 = Subject::create([
            'name' => 'Philippine Government and Constitution',
            'code' => 'BA 3',
            'semester_id' => $semester1->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'second_year',
            'block' => 'A',
            'room' =>  'RE1',
            'professor_id' => $professor6->id,
            'days' => json_encode(['Tuesday', 'Thursday']),
            'start_time' => '17:30:00',
            'end_time' => '19:00:00',
        ]);

        $elec1 = Subject::create([
            'name' => 'Franchising',
            'code' => 'ELEC 1',
            'semester_id' => $semester1->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'second_year',
            'block' => 'A',
            'room' =>  'RE2',
            'professor_id' => $professor7->id,
            'days' => json_encode(['Friday']),
            'start_time' => '08:00:00',
            'end_time' => '10:30:00',
        ]);

        $pe3 = Subject::create([
            'name' => 'Sports and Team Games',
            'code' => 'PE 3',
            'semester_id' => $semester1->id,
            'fee' => 550,
            'units' => 2,
            'year_level' => 'second_year',
            'block' => 'A',
            'room' =>  'RE3',
            'professor_id' => $professor8->id,
            'days' => json_encode(['Saturday']),
            'start_time' => '10:30:00',
            'end_time' => '12:00:00',
        ]);

        // Second Year - 2nd Semester Subjects
        $bacc3 = Subject::create([
            'name' => 'Taxation (Income Taxation)',
            'code' => 'BACC 3',
            'semester_id' => $semester2->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'second_year',
            'block' => 'A',
            'room' =>  'RE4',
            'professor_id' => $professor7->id,
            'days' => json_encode(['Monday', 'Wednesday']),
            'start_time' => '08:00:00',
            'end_time' => '09:30:00',
        ]);

        $bacc4 = Subject::create([
            'name' => 'Good Governance & Social Responsibility',
            'code' => 'BACC 4',
            'semester_id' => $semester2->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'second_year',
            'block' => 'A',
            'room' =>  'RE5',
            'professor_id' => $professor2->id,
            'days' => json_encode(['Tuesday', 'Thursday']),
            'start_time' => '10:00:00',
            'end_time' => '11:30:00',
        ]);

        $bapc2 = Subject::create([
            'name' => 'Monetary Policy and Central Banking',
            'code' => 'BAPC 2',
            'semester_id' => $semester2->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'second_year',
            'block' => 'A',
            'room' =>  'RE6',
            'professor_id' => $professor3->id,
            'days' => json_encode(['Monday', 'Wednesday']),
            'start_time' => '11:30:00',
            'end_time' => '13:00:00',
        ]);

        $bapc3 = Subject::create([
            'name' => 'Investment and Portfolio Management',
            'code' => 'BAPC 3',
            'semester_id' => $semester2->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'second_year',
            'block' => 'A',
            'room' =>  'RE7',
            'professor_id' => $professor4->id,
            'days' => json_encode(['Tuesday', 'Thursday']),
            'start_time' => '13:30:00',
            'end_time' => '15:00:00',
        ]);

        $ba4 = Subject::create([
            'name' => 'Cost Accounting',
            'code' => 'BA 4',
            'semester_id' => $semester2->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'second_year',
            'block' => 'A',
            'room' =>  'RE8',
            'professor_id' => $professor5->id,
            'days' => json_encode(['Monday', 'Wednesday']),
            'start_time' => '15:30:00',
            'end_time' => '17:00:00',
        ]);

        $ba5 = Subject::create([
            'name' => 'Business and Transfer Tax',
            'code' => 'BA 5',
            'semester_id' => $semester2->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'second_year',
            'block' => 'A',
            'room' =>  'RE9',
            'professor_id' => $professor6->id,
            'days' => json_encode(['Tuesday', 'Thursday']),
            'start_time' => '17:30:00',
            'end_time' => '19:00:00',
        ]);

        $elec2 = Subject::create([
            'name' => 'Entrepreneurial Management',
            'code' => 'ELEC 2',
            'semester_id' => $semester2->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'second_year',
            'block' => 'A',
            'room' =>  'DMH-1',
            'professor_id' => $professor7->id,
            'days' => json_encode(['Friday']),
            'start_time' => '08:00:00',
            'end_time' => '10:30:00',
        ]);

        $pe4 = Subject::create([
            'name' => 'Recreation and Youth Leadership',
            'code' => 'PE 4',
            'semester_id' => $semester2->id,
            'fee' => 550,
            'units' => 2,
            'year_level' => 'second_year',
            'block' => 'A',
            'room' =>  'DMH-2',
            'professor_id' => $professor8->id,
            'days' => json_encode(['Saturday']),
            'start_time' => '10:30:00',
            'end_time' => '12:00:00',
        ]);



                // THIRD YEAR - 1st Semester
        $pom = Subject::create([
            'name' => 'Production Operation Management',
            'code' => 'POM',
            'semester_id' => $semester1->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'third_year',
            'block' => 'A',
            'professor_id' => $professor7->id,
            'days' => json_encode(['Monday', 'Wednesday']),
            'start_time' => '08:00:00',
            'end_time' => '09:30:00',
            'room' =>  'DMH-3',
        ]);

        $cbmec1 = Subject::create([
            'name' => 'Operations Management (TQM)',
            'code' => 'CBMEC 1',
            'semester_id' => $semester1->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'third_year',
            'block' => 'A',
            'professor_id' => $professor2->id,
            'days' => json_encode(['Tuesday', 'Thursday']),
            'start_time' => '10:00:00',
            'end_time' => '11:30:00',
            'room' =>  'DMH-4',
        ]);

        $bacc5 = Subject::create([
            'name' => 'Human Resource Management',
            'code' => 'BACC 5',
            'semester_id' => $semester1->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'third_year',
            'block' => 'A',
            'professor_id' => $professor3->id,
            'days' => json_encode(['Monday', 'Wednesday']),
            'start_time' => '13:00:00',
            'end_time' => '14:30:00',
            'room' =>  'DMH-6',
        ]);

        $bapc4 = Subject::create([
            'name' => 'Financial Management',
            'code' => 'BAPC 4',
            'semester_id' => $semester1->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'third_year',
            'block' => 'A',
            'room' =>  'DMH-7',
            'professor_id' => $professor4->id,
            'days' => json_encode(['Tuesday', 'Thursday']),
            'start_time' => '15:00:00',
            'end_time' => '16:30:00',
            
        ]);

        $elec3 = Subject::create([
            'name' => 'Business Research',
            'code' => 'ELEC 3',
            'semester_id' => $semester1->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'third_year',
            'block' => 'A',
            'room' =>  'DMH-8',
            'professor_id' => $professor5->id,
            'days' => json_encode(['Friday']),
            'start_time' => '09:00:00',
            'end_time' => '12:00:00',
        ]);

        $ba6 = Subject::create([
            'name' => 'Public Finance',
            'code' => 'BA 6',
            'semester_id' => $semester1->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'third_year',
            'block' => 'A',
            'room' =>  'DMH-9',
            'professor_id' => $professor6->id,
            'days' => json_encode(['Monday', 'Wednesday']),
            'start_time' => '16:30:00',
            'end_time' => '18:00:00',
        ]);

        $fl1 = Subject::create([
            'name' => 'Foreign Language 1',
            'code' => 'FL 1',
            'semester_id' => $semester1->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'third_year',
            'block' => 'A',
            'professor_id' => $professor7->id,
            'days' => json_encode(['Saturday']),
            'start_time' => '10:30:00',
            'end_time' => '12:00:00',
        ]);

        // THIRD YEAR - 2nd Semester
        $cbmec2 = Subject::create([
            'name' => 'Strategic Management',
            'code' => 'CBMEC 2',
            'semester_id' => $semester2->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'third_year',
            'block' => 'A',
            'room' =>  'ACC1',
            'professor_id' => $professor8->id,
            'days' => json_encode(['Monday', 'Wednesday']),
            'start_time' => '08:00:00',
            'end_time' => '09:30:00',
        ]);

        $bacc6 = Subject::create([
            'name' => 'International Trade and Agreements',
            'code' => 'BACC 6',
            'semester_id' => $semester2->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'third_year',
            'block' => 'A',
            'room' =>  'ACC2',
            'professor_id' => $professor2->id,
            'days' => json_encode(['Tuesday', 'Thursday']),
            'start_time' => '10:00:00',
            'end_time' => '11:30:00',
        ]);

        $bapc5 = Subject::create([
            'name' => 'Business Research',
            'code' => 'BAPC 5',
            'semester_id' => $semester2->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'third_year',
            'block' => 'A',
            'room' =>  'ACC3',
            'professor_id' => $professor3->id,
            'days' => json_encode(['Friday']),
            'start_time' => '09:00:00',
            'end_time' => '12:00:00',
        ]);

        $bapc6 = Subject::create([
            'name' => 'Financial Analysis and Reporting',
            'code' => 'BAPC 6',
            'semester_id' => $semester2->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'third_year',
            'block' => 'A',
            'room' =>  'ACC4',
            'professor_id' => $professor4->id,
            'days' => json_encode(['Tuesday', 'Thursday']),
            'start_time' => '15:00:00',
            'end_time' => '16:30:00',
        ]);

        $elec4 = Subject::create([
            'name' => 'Credit and Collection',
            'code' => 'ELEC 4',
            'semester_id' => $semester2->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'third_year',
            'block' => 'A',
            'room' =>  'ACC5',
            'professor_id' => $professor5->id,
            'days' => json_encode(['Monday', 'Wednesday']),
            'start_time' => '13:00:00',
            'end_time' => '14:30:00',
        ]);

        $ba7 = Subject::create([
            'name' => 'Business Correspondence',
            'code' => 'BA 7',
            'semester_id' => $semester2->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'third_year',
            'block' => 'A',
            'room' =>  'ACC6',
            'professor_id' => $professor6->id,
            'days' => json_encode(['Tuesday', 'Thursday']),
            'start_time' => '16:30:00',
            'end_time' => '18:00:00',
        ]);

        $fl2 = Subject::create([
            'name' => 'Foreign Language 2',
            'code' => 'FL 2',
            'semester_id' => $semester2->id,
            'fee' => 550,
            'units' => 3,
            'year_level' => 'third_year',
            'block' => 'A',
            'room' =>  'ACC7',
            'professor_id' => $professor7->id,
            'days' => json_encode(['Saturday']),
            'start_time' => '10:30:00',
            'end_time' => '12:00:00',
        ]);

                // Fourth Year - First Semester
        $bacc8 = Subject::create([
            'name' => 'Feasibility Study',
            'code' => 'BACC 8',
            'semester_id' => $semester1->id,
            'fee' => 0,
            'units' => 3,
            'year_level' => 'fourth_year',
            'block' => 'A',
            'room' =>  'ACC8',
            'professor_id' => $professor8->id,
            'days' => json_encode(['Monday', 'Wednesday']),
            'start_time' => '08:00:00',
            'end_time' => '09:30:00',
        ]);

        

        $bapc7 = Subject::create([
            'name' => 'Capital Market',
            'code' => 'BAPC 7',
            'semester_id' => $semester1->id,
            'fee' => 0,
            'units' => 3,
            'year_level' => 'fourth_year',
            'block' => 'A',
            'room' =>  'ACC9',
            'professor_id' => $professor3->id,
            'days' => json_encode(['Wednesday', 'Friday']),
            'start_time' => '13:00:00',
            'end_time' => '14:30:00',
        ]);

        $elec5 = Subject::create([
            'name' => 'Global Finance w/ Electronic Banking',
            'code' => 'ELEC 5',
            'semester_id' => $semester1->id,
            'fee' => 0,
            'units' => 3,
            'year_level' => 'fourth_year',
            'block' => 'A',
            'room' =>  'ST-1',
            'professor_id' => $professor4->id,
            'days' => json_encode(['Monday', 'Thursday']),
            'start_time' => '15:00:00',
            'end_time' => '16:30:00',
        ]);

        $bapc8 = Subject::create([
            'name' => 'Special Topics in Financial Management',
            'code' => 'BAPC 8',
            'semester_id' => $semester1->id,
            'fee' => 0,
            'units' => 3,
            'year_level' => 'fourth_year',
            'block' => 'A',
            'room' =>  'ST-2',
            'professor_id' => $professor5->id,
            'days' => json_encode(['Tuesday', 'Friday']),
            'start_time' => '17:00:00',
            'end_time' => '18:30:00',
        ]);

        $ba8 = Subject::create([
            'name' => 'Law on Negotiable Instruments',
            'code' => 'BA 8',
            'semester_id' => $semester1->id,
            'fee' => 0,
            'units' => 3,
            'year_level' => 'fourth_year',
            'block' => 'A',
            'room' =>  'ST-3',
            'professor_id' => $professor6->id,
            'days' => json_encode(['Saturday']),
            'start_time' => '09:00:00',
            'end_time' => '12:00:00',
        ]);


        $elec6 = Subject::create([
            'name' => 'Personal Finance',
            'code' => 'ELEC 6',
            'semester_id' => $semester1->id,
            'fee' => 0,
            'units' => 3,
            'year_level' => 'fourth_year',
            'block' => 'A',
            'room' =>  'ST-4',
            'professor_id' => $professor8->id,
            'days' => json_encode(['Wednesday', 'Friday']),
            'start_time' => '14:00:00',
            'end_time' => '15:30:00',
        ]);

        $ba9 = Subject::create([
            'name' => 'Labor Management Relations',
            'code' => 'BA 9',
            'semester_id' => $semester1->id,
            'fee' => 0,
            'units' => 3,
            'year_level' => 'fourth_year',
            'block' => 'A',
            'room' =>  'ST-5',
            'professor_id' => $professor9->id,
            'days' => json_encode(['Saturday']),
            'start_time' => '10:30:00',
            'end_time' => '12:00:00',
        ]);


        // Fourth Year - Second Semester
        $ec1 = Subject::create([
            'name' => 'Enrichment Course',
            'code' => 'EC 1',
            'semester_id' => $semester2->id,
            'fee' => 0,
            'units' => 5,
            'year_level' => 'fourth_year',
            'block' => 'A',
            'room' =>  'ST-5',
            'professor_id' => $professor2->id,
            'days' => json_encode(['Monday', 'Wednesday']),
            'start_time' => '08:00:00',
            'end_time' => '10:30:00',
        ]);

        $practicum = Subject::create([
            'name' => 'Work Integrated Learning',
            'code' => 'PRACTICUM',
            'semester_id' => $semester2->id,
            'fee' => 0,
            'units' => 6,
            'year_level' => 'fourth_year',
            'block' => 'A',
            'room' =>  'ST-4',
            'professor_id' => $professor7->id,
            'days' => json_encode(['Monday', 'Tuesday', 'Thursday']),
            'start_time' => '09:00:00',
            'end_time' => '12:00:00',
        ]);

       



        $ge1->courses()->attach([$course1->id, $course2->id,  $course3->id, $course4->id,  $course5->id, ]); // Attach courses via the pivot table
        $ge2->courses()->attach([$course1->id, $course2->id,  $course3->id, $course4->id,  $course5->id, ]);
        $ge3->courses()->attach([$course1->id, $course2->id,  $course3->id, $course4->id,  $course5->id, ]); // Attach courses via the pivot table
        $ge4->courses()->attach([$course1->id, $course2->id,  $course3->id, $course4->id,  $course5->id, ]);
        $ge5->courses()->attach([$course1->id, $course2->id,  $course3->id, $course4->id,  $course5->id, ]); // Attach courses via the pivot table
        $ge6->courses()->attach([$course1->id, $course2->id,  $course3->id, $course4->id,  $course5->id, ]);
        $ge7->courses()->attach([$course1->id, $course2->id,  $course3->id, $course4->id,  $course5->id, ]); // Attach courses via the pivot table
        $ge8->courses()->attach([$course1->id, $course2->id,  $course3->id, $course4->id,  $course5->id, ]);
        $perDev1->courses()->attach([$course1->id, $course2->id,  $course3->id, $course4->id,  $course5->id, ]); // Attach courses via the pivot table
        $perDev2->courses()->attach([$course1->id, $course2->id,  $course3->id, $course4->id,  $course5->id, ]);
        $pe1->courses()->attach([$course1->id, $course2->id,  $course3->id, $course4->id,  $course5->id, ]); // Attach courses via the pivot table
        $pe2->courses()->attach([$course1->id, $course2->id,  $course3->id, $course4->id,  $course5->id, ]);
        $eco1->courses()->attach([ $course4->id,  $course5->id, ]); // Attach courses via the pivot table
        $ba1->courses()->attach([ $course4->id,  $course5->id, ]); 
        $nstp1->courses()->attach([$course1->id, $course2->id,  $course3->id, $course4->id,  $course5->id, ]); // Attach courses via the pivot table
        $nstp2->courses()->attach([$course1->id, $course2->id,  $course3->id, $course4->id,  $course5->id, ]);


        //Second Year 1st 
        $ge9->courses()->attach([ $course4->id,  $course5->id, ]); 
        $bacc1->courses()->attach([ $course4->id,  $course5->id, ]); 
        $bacc2->courses()->attach([ $course4->id,  $course5->id, ]); 
        $bapc1->courses()->attach([ $course4->id,  $course5->id, ]); 
        $ba2->courses()->attach([ $course4->id,  $course5->id, ]); 
        $ba3->courses()->attach([ $course4->id,  $course5->id, ]); 
        $elec1->courses()->attach([ $course4->id,  $course5->id, ]); 
        $pe3->courses()->attach([ $course4->id,  $course5->id, ]); 
       
        $bacc3->courses()->attach([ $course4->id,  $course5->id, ]); 
        $bacc4->courses()->attach([ $course4->id,  $course5->id, ]); 
        $bapc3->courses()->attach([ $course4->id,  $course5->id, ]); 
        $ba4->courses()->attach([ $course4->id,  $course5->id, ]); 
        $ba5->courses()->attach([ $course4->id,  $course5->id, ]); 
        $elec2->courses()->attach([ $course4->id,  $course5->id, ]); 
        $pe4->courses()->attach([$course1->id, $course2->id,  $course3->id, $course4->id,  $course5->id, ]);
        
        
        //3rd year
        $pom->courses()->attach([ $course4->id,  $course5->id, ]); 
        $cbmec1->courses()->attach([ $course4->id,  $course5->id, ]); 
        $bacc5->courses()->attach([ $course4->id,  $course5->id, ]); 
        $bapc4->courses()->attach([ $course4->id,  $course5->id, ]); 
        $elec3->courses()->attach([ $course4->id,  $course5->id, ]); 
        $ba6->courses()->attach([ $course4->id,  $course5->id, ]); 
        $fl1->courses()->attach([ $course4->id,  $course5->id, ]); 
    
     
        $cbmec2->courses()->attach([ $course4->id,  $course5->id, ]); 
        $bacc6->courses()->attach([ $course4->id,  $course5->id, ]); 
        $bapc5->courses()->attach([ $course4->id,  $course5->id, ]); 
        $bapc6->courses()->attach([ $course4->id,  $course5->id, ]); 
        $elec4->courses()->attach([ $course4->id,  $course5->id, ]); 
        $ba7->courses()->attach([ $course4->id,  $course5->id, ]); 
        $fl2->courses()->attach([ $course4->id,  $course5->id, ]); 
       
       
       
       //4th yr
        $bacc8->courses()->attach([ $course4->id,  $course5->id, ]); 
        $bapc7->courses()->attach([ $course4->id,  $course5->id, ]); 
        $elec5->courses()->attach([ $course4->id,  $course5->id, ]); 
        $bapc8->courses()->attach([ $course4->id,  $course5->id, ]); 
        $ba8->courses()->attach([ $course4->id,  $course5->id, ]); 
        $elec6->courses()->attach([ $course4->id,  $course5->id, ]); 
        $ba9->courses()->attach([ $course4->id,  $course5->id, ]); 

        $ec1->courses()->attach([ $course4->id,  $course5->id, ]); 
        $practicum->courses()->attach([ $course4->id,  $course5->id, ]); 
  



     

        function getSubjects($yearLevel, $semesterId, $courseId)
        {
            return Subject::where('year_level', $yearLevel)
                          ->where('semester_id', $semesterId)
                          ->whereHas('courses', function ($query) use ($courseId) {
                              $query->where('courses.id', $courseId);
                          })
                          ->pluck('id')
                          ->toArray();
        }

        // Students
        $student1 = Student::find(1);  
        $student2 = Student::find(2);  

        // Ensure semester and course exist
        $semester = Semester::find(1); 
        $course = Course::find(1); 

        if (!$semester || !$course) {
            $this->command->error("Semester or Course not found.");
            return;
        }

        // Enroll Students
        if ($student1) {
            $subjects = getSubjects('first_year', $semester->id, $course->id);
            $this->enrollStudent($student1, 'first_year', $semester->id, $course->id, $subjects);
        }

        if ($student2) {
            $subjects = getSubjects('second_year', $semester->id, $course->id);
            $this->enrollStudent($student2, 'second_year', $semester->id, $course->id, $subjects);
        }

        $this->command->info('Students enrolled successfully!');
    }





    private function enrollStudent($student, $yearLevel, $semesterId, $courseId, $subjectIds)
    {
        // Step 1: Create enrollment
        $enrollment = Enrollment::updateOrCreate(
            [
                'student_id' => $student->id,
                'year_level' => $yearLevel,
                'semester_id' => $semesterId,
                'course_id' => $courseId,
                'category' => 'new',
            ],
            ['subject_ids' => json_encode($subjectIds)]
        );
    
        // Step 2: Update student's status
        $student->status = 'enrolled';
        $student->save();
    
        // Step 3: Assign subjects to Student
        foreach ($subjectIds as $subjectId) {
            StudentSubject::updateOrCreate([
                'student_id' => $student->id,
                'subject_id' => $subjectId,
                'enrollment_id' => $enrollment->id,
            ], [
                'status' => 'enrolled',
                'grade' => null,
            ]);
        }
    
        // Step 4: Add related fee, payment, and financial data
    
        // Hardcoded Fee Data for the enrollment
        $tuitionFee = 5000.00;
        $labFee = 500.00;
        $miscellaneousFee = 300.00;
        $otherFee = 200.00;
        $discount = 100.00;
        $initialPayment = 1000.00;
    
        $totalFee = $tuitionFee + $labFee + $miscellaneousFee + $otherFee - $discount - $initialPayment;
    
        // Insert fees into the students_fees table
        $fee = Fee::create([
            'enrollment_id' => $enrollment->id,
            'tuition_fee' => $tuitionFee,
            'lab_fee' => $labFee,
            'miscellaneous_fee' => $miscellaneousFee,
            'other_fee' => $otherFee,
            'discount' => $discount,
            'initial_payment' => $initialPayment,
        ]);
    
        // Calculate installment amounts (splitting total fee into 4 installments)
        $installmentAmount = $totalFee > 0 ? $totalFee / 4 : 0;
    
        // Insert Payment details
        $paymentsData = [
            'fee_id' => $fee->id,
            'prelims_payment' => $installmentAmount,
            'prelims_paid' => false,
            'midterms_payment' => $installmentAmount,
            'midterms_paid' => false,
            'pre_final_payment' => $installmentAmount,
            'pre_final_paid' => false,
            'final_payment' => $installmentAmount,
            'final_paid' => false,
            'status' => 'Pending',
        ];
    
        // Create Payment record
        Payment::create($paymentsData);
    
        // Dummy Financial Data (Example)
        $dummyFinancialData = [
            'financier' => 'Myself',
            'company_name' => 'ABC Corp',
            'company_address' => '123 Street, City, Country',
            'income' => 35000,
            'scholarship' => 5000,
            'contact_number' => '123-456-7890',
            'relative_names' => ['John Doe', 'Jane Smith'], // Example relatives
            'relationships' => ['Father', 'Mother'],
            'position_courses' => ['Manager', 'Engineer'],
            'relative_contact_numbers' => ['987-654-3210', '555-123-4567'],
        ];
    
        // Merge the financial data with relative info
        $financialData = array_merge($dummyFinancialData, [
            'enrollment_id' => $enrollment->id,
            'relative_names' => json_encode($dummyFinancialData['relative_names']),
            'relationships' => json_encode($dummyFinancialData['relationships']),
            'position_courses' => json_encode($dummyFinancialData['position_courses']),
            'relative_contact_numbers' => json_encode($dummyFinancialData['relative_contact_numbers']),
        ]);
    
        // Insert the financial information into the financial_info table
        FinancialInformation::create($financialData);
    
    


                    
            
            
        
    }
}