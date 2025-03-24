<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade'); // Links to students table
            $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('set null'); // The course the student is enrolled in
            $table->foreignId('semester_id')->nullable()->constrained('semesters')->onDelete('set null'); // The semester for the enrollment
            $table->enum('year_level', ['first_year', 'second_year', 'third_year', 'fourth_year', 'fifth_year', 'irregular']);
            $table->json('subject_ids')->nullable(); // Store subject ids as a JSON array
            $table->timestamps(); // To track creation and update times

            $table->enum('category', ['new', 'old', 'shifter'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrollment_subjects'); // Drop pivot table first
        Schema::dropIfExists('enrollments'); // Then drop enrollments table
    }
}
