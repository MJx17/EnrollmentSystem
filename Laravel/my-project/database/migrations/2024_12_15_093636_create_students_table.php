<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique(); // Foreign key to the user table
            
            // Personal Information
            $table->string('surname');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->enum('sex', ['Male', 'Female', 'Other']);
            $table->date('dob');  // Date of Birth
            $table->integer('age');
            $table->string('place_of_birth');
            $table->string('home_address');
            $table->string('mobile_number');
            $table->string('email_address');
            $table->enum('status', ['active', 'inactive', 'enrolled', 'not_enrolled'])->default('not_enrolled');

            // Father's Information
            $table->string('fathers_name');
            $table->string('fathers_educational_attainment');
            $table->string('fathers_address');
            $table->string('fathers_contact_number');
            $table->string('fathers_occupation');
            $table->string('fathers_employer');
            $table->string('fathers_employer_address');
        
            // Mother's Information
            $table->string('mothers_name');
            $table->string('mothers_educational_attainment');
            $table->string('mothers_address');
            $table->string('mothers_contact_number');
            $table->string('mothers_occupation');
            $table->string('mothers_employer');
            $table->string('mothers_employer_address');
        
            // Guardian's Information (if applicable)
            $table->string('guardians_name')->nullable();
            $table->string('guardians_educational_attainment')->nullable();
            $table->string('guardians_address')->nullable();
            $table->string('guardians_contact_number')->nullable();
            $table->string('guardians_occupation')->nullable();
            $table->string('guardians_employer')->nullable();
            $table->string('guardians_employer_address')->nullable();
        
            // Living Situation
            $table->enum('living_situation', ['with_family', 'with_relatives', 'with_guardian', 'boarding_house']);
            $table->string('living_address');
            $table->string('living_contact_number');
        
            // Image Path
            $table->string('image')->nullable(); // Store file path
        
            $table->timestamps();
        
            // Foreign key constraint to ensure a user is always associated with the student data
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};
