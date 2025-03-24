<?php

namespace Database\Seeders;


use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Professor;
use App\Models\Department;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Semester;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Define roles
        $roles = ['admin', 'student', 'professor'];

        // Permissions for admin
        $permissionsAdmin = [
            'students.index',
            'students.create',
            'students.store',
            'students.edit',
            'students.update',
            'students.destroy',
            'enrollments.index',
            'enrollments.create',
            'enrollments.store',
            'enrollments.edit',
            'enrollments.update',
            'enrollments.destroy',
            'profile.edit',
            'profile.update',
        ];

        // Permissions for students
        $permissionsStudent = [
            'enrollments.index',
            'enrollments.store',
            'profile.edit',
            'profile.update',
        ];

        // Permissions for professors
        $permissionsProfessor = [
            'students.index',
            'enrollments.index',
            'enrollments.create',
            'enrollments.edit',
            'enrollments.update',
            'profile.edit',
            'profile.update',
        ];

     

        
        {
            Department::create(['name' => 'Business Administration']);
            Department::create(['name' => 'Tourism Management']);
            Department::create(['name' => 'Secondary Education']);
            Department::create(['name' => 'Criminology']);
            Department::create(['name' => 'Computer Science']);
            Department::create(['name' => 'Nursing']);
        }

                            
                  
        // Create Courses
        $course1 = Course::create([
            'course_code' => 'BSN',
            'course_name' => 'Bachelor of Science in Nursing',
            'description' => 'A program that prepares students for careers in nursing.',
            'units' => 3,
            'department_id' => 3,  // assuming department ID for Nursing
        ]);

        $course2 = Course::create([
            'course_code' => 'BSCrim',
            'course_name' => 'Bachelor of Science in Criminology',
            'description' => 'A program focused on criminal law enforcement and justice.',
            'units' => 3,
            'department_id' => 4,  // assuming department ID for Criminology
        ]);

        $course3 = Course::create([
            'course_code' => 'BSCS',
            'course_name' => 'Bachelor of Science in Computer Science',
            'description' => 'A program for students pursuing careers in software development and computer systems.',
            'units' => 3,
            'department_id' => 5,  // assuming department ID for Computer Science
        ]);

        $course4 = Course::create([
            'course_code' => 'BSBA',
            'course_name' => 'Bachelor of Science in Business Administration',
            'description' => 'A program focused on business management and administration.',
            'units' => 3,
            'department_id' => 1,
        ]);

        // Majors for Business Administration (BSBA)
        $course5 = Course::create([
            'course_code' => 'BSBA-OPM',
            'course_name' => 'Bachelor of Science in Business Administration - Operation Management',
            'description' => 'A major focused on managing business operations.',
            'units' => 3,
            'major' => 'Operation Management',
            'department_id' => 1,
        ]);


        
            
      


        // Create roles
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Create permissions for admin, students, and professors
        foreach (array_merge($permissionsAdmin, $permissionsStudent, $permissionsProfessor) as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        // Assign permissions to roles
        $roleAdmin = Role::where('name', 'admin')->first();
        $roleAdmin->syncPermissions(Permission::whereIn('name', $permissionsAdmin)->get());

        $roleStudent = Role::where('name', 'student')->first();
        $roleStudent->syncPermissions(Permission::whereIn('name', $permissionsStudent)->get());

        $roleProfessor = Role::where('name', 'professor')->first();
        $roleProfessor->syncPermissions(Permission::whereIn('name', $permissionsProfessor)->get());

        // Create admin user
        $adminUser = User::factory()->create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@school.com',
            'password' => bcrypt('adminpassword'),
            'status' => 'active', // Admin status is active
        ]);
        $adminUser->assignRole('admin');


            // Create professor users
            $professor1 = User::factory()->create([
                'name' => 'Dr. Michael Brown',
                'username' => 'michaelbrown',
                'email' => 'michaelbrown@professor.com',
                'password' => bcrypt('professorpassword'),
                'status' => 'active', // Professors have active status
            ]);
            $professor1->assignRole('professor'); // Assign 'professor' role
    
            // Create the associated Professor record for Dr. Michael Brown
            $professor1->professor()->create([
                'user_id' => $professor1->id,
                'surname' => 'Brown',
                'first_name' => 'Michael',
                'middle_name' => 'J',
                'sex' => 'Male',
                'contact_number' => '123-456-7890',
                'email' => 'michaelbrown@professor.com',
                'designation' => 'Professor of Computer Science',
            ]);
    
            // Creating the second professor
            $professor2 = User::factory()->create([
                'user_id' => $professor2->id,
                'name' => 'Dr. Sarah Lee',
                'username' => 'sarahlee',
                'email' => 'sarahlee@professor.com',
                'password' => bcrypt('professorpassword'),
                'status' => 'active', // Professors have active status
            ]);
            $professor2->assignRole('professor'); // Assign 'professor' role
    
            // Create the associated Professor record for Dr. Sarah Lee
            $professor2->professor()->create([
                'user_id' => $professor2->id,
                'surname' => 'Lee',
                'first_name' => 'Sarah',
                'middle_name' => 'M',
                'sex' => 'Female',
                'contact_number' => '098-765-4321',
                'email' => 'sarahlee@professor.com',
                'designation' => 'Associate Professor of Mathematics',
            ]);
        // Add more courses as needed...

        $student1 = User::factory()->create([
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@student.com',
            'password' => bcrypt('studentpassword'),
            'status' => 'pending', // Default status for students
        ]);
        $student1->assignRole('student');

        // Create student specific details
        Student::create([
            'user_id' => $student1->id,
            'surname' => 'Doe',
            'first_name' => 'John',
            'middle_name' => null,
            'sex' => 'Male',
            'dob' => '2000-01-01',
            'age' => 23,
            'place_of_birth' => 'City Name',
            'home_address' => 'Home Address',
            'mobile_number' => '1234567890',
            'email_address' => 'johndoe@student.com',
            'fathers_name' => 'Father Doe',
            'fathers_educational_attainment' => 'Bachelor\'s Degree',
            'fathers_address' => 'Father\'s Address',
            'fathers_contact_number' => '0987654321',
            'fathers_occupation' => 'Engineer',
            'fathers_employer' => 'Company Name',
            'fathers_employer_address' => 'Employer Address',
            'mothers_name' => 'Mother Doe',
            'mothers_educational_attainment' => 'Bachelor\'s Degree',
            'mothers_address' => 'Mother\'s Address',
            'mothers_contact_number' => '0987654321',
            'mothers_occupation' => 'Teacher',
            'mothers_employer' => 'School Name',
            'mothers_employer_address' => 'Employer Address',
            'guardians_name' => 'Guardian Doe',
            'guardians_educational_attainment' => 'Master\'s Degree',
            'guardians_address' => 'Guardian\'s Address',
            'guardians_contact_number' => '0987654321',
            'guardians_occupation' => 'Doctor',
            'guardians_employer' => 'Hospital Name',
            'guardians_employer_address' => 'Employer Address',
            'living_situation' => 'with_family',
            'living_address' => 'Living Address',
            'living_contact_number' => '0987654321',   
            'image' => 'path/to/image.jpg',
            'course_id' => 1,
        ]);

        // Student 2
        $student2 = User::factory()->create([
            'name' => 'Jane Smith',
            'username' => 'janesmith',
            'email' => 'janesmith@student.com',
            'password' => bcrypt('studentpassword'),
            'status' => 'pending', // Default status for students
        ]);
        $student2->assignRole('student');

        // Create student specific details
        Student::create([
            'user_id' => $student2->id,
            'surname' => 'Smith',
            'first_name' => 'Jane',
            'middle_name' => null,
            'sex' => 'Female',
            'dob' => '2001-02-02',
            'age' => 22,
            'place_of_birth' => 'City Name',
            'home_address' => 'Home Address',
            'mobile_number' => '1234567890',
            'email_address' => 'janesmith@student.com',
            'fathers_name' => 'Father Smith',
            'fathers_educational_attainment' => 'Bachelor\'s Degree',
            'fathers_address' => 'Father\'s Address',
            'fathers_contact_number' => '0987654321',
            'fathers_occupation' => 'Architect',
            'fathers_employer' => 'Construction Firm',
            'fathers_employer_address' => 'Employer Address',
            'mothers_name' => 'Mother Smith',
            'mothers_educational_attainment' => 'Bachelor\'s Degree',
            'mothers_address' => 'Mother\'s Address',
            'mothers_contact_number' => '0987654321',
            'mothers_occupation' => 'Nurse',
            'mothers_employer' => 'Hospital Name',
            'mothers_employer_address' => 'Employer Address',
            'guardians_name' => 'Guardian Smith',
            'guardians_educational_attainment' => 'PhD',
            'guardians_address' => 'Guardian\'s Address',
            'guardians_contact_number' => '0987654321',
            'guardians_occupation' => 'Lawyer',
            'guardians_employer' => 'Law Firm',
            'guardians_employer_address' => 'Employer Address',
            'living_situation' => 'with_relatives',
            'living_address' => 'Living Address',
            'living_contact_number' => '0987654321',
      
            'image' => 'path/to/image.jpg',
            'course_id' => 2,
        ]);

                // Step 5: Create Semesters
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

            // Step 6: Create Subjects
            Subject::create([
                'name' => 'Introduction to Programming',
                'code' => 'CS101-01',
                'block' => 'A',
                'course_id' => $course3->id,  // Correct course ID for Computer Science
                'professor_id' => $professor1->id,  // Correct professor ID
                'semester_id' => $semester1->id,
                'year_level' => 1,
                'prerequisite_id' => null,
                'fee' => 500.00,
                'units' => 3.0,
            ]);

            Subject::create([
                'name' => 'Calculus I',
                'code' => 'MATH101-01',
                'block' => 'B',
                'course_id' => $course4->id,  // Correct course ID for Criminology
                'professor_id' => $professor2->id,  // Correct professor ID
                'semester_id' => $semester2->id,
                'year_level' => 1,
                'prerequisite_id' => null,
                'fee' => 450.00,
                'units' => 4.0,
            ]);
        
   

    }   
}
