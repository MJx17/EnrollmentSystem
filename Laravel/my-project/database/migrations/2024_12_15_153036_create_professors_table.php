<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('professors', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id')->unique(); // Foreign key for user
            $table->string('surname');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->enum('sex', ['Male', 'Female', 'Other']);
            $table->string('contact_number');
            $table->string('email')->unique();
            $table->unsignedBigInteger('department_id')->nullable();  // Foreign key for department
            $table->string('designation')->default('Instructor'); // e.g., Instructor, Professor
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('professors');
    }
};
