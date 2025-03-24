<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('financial_information', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('enrollment_id')->constrained()->onDelete('cascade');
            $table->enum('financier', ['Parents', 'Relatives', 'Guardian', 'Myself', 'Others'])->nullable();
            $table->string('company_name')->nullable();
            $table->text('company_address')->nullable();
            $table->string('scholarship')->nullable();
            $table->text('income')->nullable();
            $table->string('contact_number', 20)->nullable();


         
                // Storing each field as an array in a single JSON column
                $table->json('relative_names')->nullable();
                $table->json('relationships')->nullable();
                $table->json('position_courses')->nullable();
                $table->json('relative_contact_numbers')->nullable();
                
       
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_information');
    }
};
