<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Professor;
use App\Models\Student;

class UsersRolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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


                        // Creating the third professor
            $professor3 = User::factory()->create([
                'name' => 'Dr. John Carter',
                'username' => 'johncarter',
                'email' => 'johncarter@professor.com',
                'password' => bcrypt('professorpassword'),
                'status' => 'active',
            ]);
            $professor3->assignRole('professor');

            $professor3->professor()->create([
                'user_id' => $professor3->id,
                'surname' => 'Carter',
                'first_name' => 'John',
                'middle_name' => 'D',
                'sex' => 'Male',
                'contact_number' => '0912-345-6789',
                'email' => 'johncarter@professor.com',
                'designation' => 'Professor of Finance',
            ]);

            // Creating the fourth professor
            $professor4 = User::factory()->create([
                'name' => 'Dr. Emily Watson',
                'username' => 'emilywatson',
                'email' => 'emilywatson@professor.com',
                'password' => bcrypt('professorpassword'),
                'status' => 'active',
            ]);
            $professor4->assignRole('professor');

            $professor4->professor()->create([
                'user_id' => $professor4->id,
                'surname' => 'Watson',
                'first_name' => 'Emily',
                'middle_name' => 'R',
                'sex' => 'Female',
                'contact_number' => '0933-456-7890',
                'email' => 'emilywatson@professor.com',
                'designation' => 'Senior Lecturer in Banking',
            ]);

         // Creating the fifth professor
            $professor5 = User::factory()->create([
                'name' => 'Juan Luna',
                'username' => 'juanluna',
                'email' => 'juanluna@professor.com',
                'password' => bcrypt('professorpassword'),
                'status' => 'active',
            ]);
            $professor5->assignRole('professor');

            $professor5->professor()->create([
                'user_id' => $professor5->id,
                'surname' => 'Luna',
                'first_name' => 'Juan',
                'middle_name' => '',
                'sex' => 'Male',
                'contact_number' => '0923-456-7890',
                'email' => 'juanluna@professor.com',
                'designation' => 'Professor of Fine Arts',
            ]);


            // Creating the sixth professor
            $professor6 = User::factory()->create([
                'name' => 'Dr. Anna Martinez',
                'username' => 'annamartinez',
                'email' => 'annamartinez@professor.com',
                'password' => bcrypt('professorpassword'),
                'status' => 'active',
            ]);
            $professor6->assignRole('professor');

            $professor6->professor()->create([
                'user_id' => $professor6->id,
                'surname' => 'Martinez',
                'first_name' => 'Anna',
                'middle_name' => 'K',
                'sex' => 'Female',
                'contact_number' => '0955-678-9012',
                'email' => 'annamartinez@professor.com',
                'designation' => 'Assistant Professor of Economics',
            ]);

            // Creating the seventh professor
            $professor7 = User::factory()->create([
                'name' => 'Dr. David Wilson',
                'username' => 'davidwilson',
                'email' => 'davidwilson@professor.com',
                'password' => bcrypt('professorpassword'),
                'status' => 'active',
            ]);
            $professor7->assignRole('professor');

            $professor7->professor()->create([
                'user_id' => $professor7->id,
                'surname' => 'Wilson',
                'first_name' => 'David',
                'middle_name' => 'L',
                'sex' => 'Male',
                'contact_number' => '0966-789-0123',
                'email' => 'davidwilson@professor.com',
                'designation' => 'Professor of Accounting',
            ]);


                        // Creating the eighth professor - Efren Reyes (Billiards)
            $professor8 = User::factory()->create([
                'name' => 'Efren Reyes',
                'username' => 'efrenreyes',
                'email' => 'efrenreyes@professor.com',
                'password' => bcrypt('professorpassword'),
                'status' => 'active',
            ]);

            $professor8->assignRole('professor');

            $professor8->professor()->create([
                'user_id' => $professor8->id,
                'surname' => 'Reyes',
                'first_name' => 'Efren',
                'middle_name' => 'M',
                'sex' => 'Male',
                'contact_number' => '0966-789-0123',
                'email' => 'efrenreyes@professor.com',
                'designation' => 'Professor of Billiards & Strategic Sports',
            ]);

            // Creating the ninth professor - Paeng Nepomuceno (Bowling)
            $professor9 = User::factory()->create([
                'name' => 'Paeng Nepomuceno',
                'username' => 'paengnepomuceno',
                'email' => 'paengnepomuceno@professor.com',
                'password' => bcrypt('professorpassword'),
                'status' => 'active',
            ]);

            $professor9->assignRole('professor');

            $professor9->professor()->create([
                'user_id' => $professor9->id,
                'surname' => 'Nepomuceno',
                'first_name' => 'Paeng',
                'middle_name' => 'C',
                'sex' => 'Male',
                'contact_number' => '0977-654-3210',
                'email' => 'paengnepomuceno@professor.com',
                'designation' => 'Professor of Bowling & Precision Sports',
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
            'status' => 'not_enrolled',
        ]);

        $student3 = User::factory()->create([
            'name' => 'Sherlock Homes',
            'username' => 'sherlock',
            'email' => 'sherlockhomes@student.com',
            'password' => bcrypt('studentpassword'),
            'status' => 'pending',
        ]);
        $student3->assignRole('student');
        
        Student::create([
            'user_id' => $student3->id,
            'surname' => 'Homes',
            'first_name' => 'Sherlock',
            'middle_name' => 'A',
            'sex' => 'Male',
            'dob' => '2000-05-15',
            'age' => 23,
            'place_of_birth' => 'City Name',
            'home_address' => 'Home Address',
            'mobile_number' => '0987123456',
            'email_address' => 'sherlockhomes@student.com',
            'fathers_name' => 'Father Doe',
            'fathers_educational_attainment' => 'Master\'s Degree',
            'fathers_address' => 'Father\'s Address',
            'fathers_contact_number' => '0912345678',
            'fathers_occupation' => 'Engineer',
            'fathers_employer' => 'Tech Company',
            'fathers_employer_address' => 'Employer Address',
            'mothers_name' => 'Mother Doe',
            'mothers_educational_attainment' => 'Bachelor\'s Degree',
            'mothers_address' => 'Mother\'s Address',
            'mothers_contact_number' => '0923456789',
            'mothers_occupation' => 'Teacher',
            'mothers_employer' => 'High School',
            'mothers_employer_address' => 'Employer Address',
            'guardians_name' => 'Guardian Doe',
            'guardians_educational_attainment' => 'PhD',
            'guardians_address' => 'Guardian\'s Address',
            'guardians_contact_number' => '0934567890',
            'guardians_occupation' => 'Scientist',
            'guardians_employer' => 'Research Institute',
            'guardians_employer_address' => 'Employer Address',
            'living_situation' => 'with_family',
            'living_address' => 'Living Address',
            'living_contact_number' => '0945678901',
            'image' => 'path/to/image.jpg',
            'status' => 'not_enrolled',
        ]);
        
        // Student 4
        $student4 = User::factory()->create([
            'name' => 'Mary Johnson',
            'username' => 'maryjohnson',
            'email' => 'maryjohnson@student.com',
            'password' => bcrypt('studentpassword'),
            'status' => 'pending',
        ]);
        $student4->assignRole('student');
        
        Student::create([
            'user_id' => $student4->id,
            'surname' => 'Johnson',
            'first_name' => 'Mary',
            'middle_name' => 'B',
            'sex' => 'Female',
            'dob' => '2001-09-22',
            'age' => 22,
            'place_of_birth' => 'City Name',
            'home_address' => 'Home Address',
            'mobile_number' => '0978123456',
            'email_address' => 'maryjohnson@student.com',
            'fathers_name' => 'Father Johnson',
            'fathers_educational_attainment' => 'Bachelor\'s Degree',
            'fathers_address' => 'Father\'s Address',
            'fathers_contact_number' => '0981234567',
            'fathers_occupation' => 'Doctor',
            'fathers_employer' => 'Hospital Name',
            'fathers_employer_address' => 'Employer Address',
            'mothers_name' => 'Mother Johnson',
            'mothers_educational_attainment' => 'Master\'s Degree',
            'mothers_address' => 'Mother\'s Address',
            'mothers_contact_number' => '0992345678',
            'mothers_occupation' => 'Professor',
            'mothers_employer' => 'University Name',
            'mothers_employer_address' => 'Employer Address',
            'guardians_name' => 'Guardian Johnson',
            'guardians_educational_attainment' => 'PhD',
            'guardians_address' => 'Guardian\'s Address',
            'guardians_contact_number' => '0973456789',
            'guardians_occupation' => 'Lawyer',
            'guardians_employer' => 'Law Firm',
            'guardians_employer_address' => 'Employer Address',
            'living_situation' => 'with_relatives',
            'living_address' => 'Living Address',
            'living_contact_number' => '0964567890',
            'image' => 'path/to/image.jpg',
            'status' => 'not_enrolled',
        ]);
        
        // Student 5
        $student5 = User::factory()->create([
            'name' => 'James Anderson',
            'username' => 'jamesanderson',
            'email' => 'jamesanderson@student.com',
            'password' => bcrypt('studentpassword'),
            'status' => 'pending',
        ]);
        $student5->assignRole('student');
        
        Student::create([
            'user_id' => $student5->id,
            'surname' => 'Anderson',
            'first_name' => 'James',
            'middle_name' => 'C',
            'sex' => 'Male',
            'dob' => '2002-06-18',
            'age' => 21,
            'place_of_birth' => 'City Name',
            'home_address' => 'Home Address',
            'mobile_number' => '0967123456',
            'email_address' => 'jamesanderson@student.com',
            'fathers_name' => 'Father Anderson',
            'fathers_educational_attainment' => 'PhD',
            'fathers_address' => 'Father\'s Address',
            'fathers_contact_number' => '0951234567',
            'fathers_occupation' => 'Professor',
            'fathers_employer' => 'University Name',
            'fathers_employer_address' => 'Employer Address',
            'mothers_name' => 'Mother Anderson',
            'mothers_educational_attainment' => 'Bachelor\'s Degree',
            'mothers_address' => 'Mother\'s Address',
            'mothers_contact_number' => '0942345678',
            'mothers_occupation' => 'Accountant',
            'mothers_employer' => 'Finance Company',
            'mothers_employer_address' => 'Employer Address',
            'guardians_name' => 'Guardian Anderson',
            'guardians_educational_attainment' => 'Master\'s Degree',
            'guardians_address' => 'Guardian\'s Address',
            'guardians_contact_number' => '0933456789',
            'guardians_occupation' => 'Software Engineer',
            'guardians_employer' => 'Tech Firm',
            'guardians_employer_address' => 'Employer Address',
            'living_situation' => 'with_family',
            'living_address' => 'Dormitory Address',
            'living_contact_number' => '0924567890',
            'image' => 'path/to/image.jpg',
            'status' => 'not_enrolled',
        ]);

                    // Student 6 - Jose Rizal
            $student6 = User::factory()->create([
                'name' => 'Jose Rizal',
                'username' => 'joserizal',
                'email' => 'joserizal@student.com',
                'password' => bcrypt('studentpassword'),
                'status' => 'pending',
            ]);
            $student6->assignRole('student');

            Student::create([
                'user_id' => $student6->id,
                'surname' => 'Rizal',
                'first_name' => 'Jose',
                'middle_name' => 'Protacio',
                'sex' => 'Male',
                'dob' => '1861-06-19',
                'age' => 25, // Adjusted for modern times
                'place_of_birth' => 'Calamba, Laguna',
                'home_address' => 'Calamba, Laguna',
                'mobile_number' => '09123456789',
                'email_address' => 'joserizal@student.com',
                'fathers_name' => 'Francisco Rizal Mercado',
                'fathers_educational_attainment' => 'Businessman',
                'fathers_address' => 'Calamba, Laguna',
                'fathers_contact_number' => '09234567890',
                'fathers_occupation' => 'Farmer',
                'fathers_employer' => 'Self-employed',
                'fathers_employer_address' => 'Calamba, Laguna',
                'mothers_name' => 'Teodora Alonso Realonda',
                'mothers_educational_attainment' => 'Educated at home',
                'mothers_address' => 'Calamba, Laguna',
                'mothers_contact_number' => '09345678901',
                'mothers_occupation' => 'Homemaker',
                'mothers_employer' => 'N/A',
                'mothers_employer_address' => 'N/A',
                'guardians_name' => 'Paciano Rizal',
                'guardians_educational_attainment' => 'Military Leader',
                'guardians_address' => 'Calamba, Laguna',
                'guardians_contact_number' => '09456789012',
                'guardians_occupation' => 'Revolutionary',
                'guardians_employer' => 'Katipunan',
                'guardians_employer_address' => 'Manila',
                'living_situation' => 'with_guardian',
                'living_address' => 'Calamba, Laguna',
                'living_contact_number' => '09123456789',
                'image' => 'path/to/jose-rizal.jpg',
                'status' => 'not_enrolled',
            ]);

            // Student 7 - Manny Pacquiao
            $student7 = User::factory()->create([
                'name' => 'Manny Pacquiao',
                'username' => 'mannypacquiao',
                'email' => 'mannypacquiao@student.com',
                'password' => bcrypt('studentpassword'),
                'status' => 'pending',
            ]);
            $student7->assignRole('student');

            Student::create([
                'user_id' => $student7->id,
                'surname' => 'Pacquiao',
                'first_name' => 'Manny',
                'middle_name' => 'Dapidran',
                'sex' => 'Male',
                'dob' => '1978-12-17',
                'age' => 45,
                'place_of_birth' => 'Kibawe, Bukidnon',
                'home_address' => 'General Santos City',
                'mobile_number' => '09567890123',
                'email_address' => 'mannypacquiao@student.com',
                'fathers_name' => 'Rosalio Pacquiao',
                'fathers_educational_attainment' => 'High School',
                'fathers_address' => 'General Santos City',
                'fathers_contact_number' => '09678901234',
                'fathers_occupation' => 'Farmer',
                'fathers_employer' => 'Self-employed',
                'fathers_employer_address' => 'General Santos City',
                'mothers_name' => 'Dionisia Pacquiao',
                'mothers_educational_attainment' => 'Elementary',
                'mothers_address' => 'General Santos City',
                'mothers_contact_number' => '09789012345',
                'mothers_occupation' => 'Homemaker',
                'mothers_employer' => 'N/A',
                'mothers_employer_address' => 'N/A',
                'guardians_name' => 'Freddie Roach',
                'guardians_educational_attainment' => 'High School',
                'guardians_address' => 'Los Angeles, USA',
                'guardians_contact_number' => '09890123456',
                'guardians_occupation' => 'Boxing Trainer',
                'guardians_employer' => 'Wild Card Gym',
                'guardians_employer_address' => 'California, USA',
                'living_situation' => 'with_guardian',
                'living_address' => 'General Santos City',
                'living_contact_number' => '09567890123',
                'image' => 'path/to/manny-pacquiao.jpg',
                'status' => 'not_enrolled',
            ]);



    }
}