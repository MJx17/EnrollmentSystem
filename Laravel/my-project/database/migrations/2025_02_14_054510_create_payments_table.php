<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('payments', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('fee_id')->constrained()->onDelete('cascade'); // Relates to Fees table
        //     $table->decimal('initial_payment', 10, 2)->nullable();
        //     $table->decimal('prelims_payment', 10, 2)->nullable();
        //     $table->decimal('midterms_payment', 10, 2)->nullable();
        //     $table->decimal('pre_final_payment', 10, 2)->nullable();
        //     $table->decimal('final_payment', 10, 2)->nullable();
        //     $table->decimal('total_paid', 10, 2);
        //     $table->decimal('remaining_balance', 10, 2);
        //     $table->timestamps();
        // });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fee_id')->constrained('fees')->onDelete('cascade');
            $table->decimal('prelims_payment', 10, 2)->default(0);
            $table->boolean('prelims_paid')->default(false);
            $table->decimal('midterms_payment', 10, 2)->default(0);
            $table->boolean('midterms_paid')->default(false);
            $table->decimal('pre_final_payment', 10, 2)->default(0);
            $table->boolean('pre_final_paid')->default(false);
            $table->decimal('final_payment', 10, 2)->default(0);
            $table->boolean('final_paid')->default(false);
            $table->enum('status', ['Pending', 'Partial', 'Paid'])->default('Pending'); // Payment Status
            $table->timestamps();
        });
        
        
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
