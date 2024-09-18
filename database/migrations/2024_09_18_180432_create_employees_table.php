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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unique(array('first_name', 'last_name'));
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('position_id')->constrained();
            $table->string('first_name',32);
            $table->string('last_name',64);
            $table->string('employee_id_number')->unique()->nullable();
            $table->date('hire_date');
            $table->boolean('is_active')->default(true);
            $table->string('created_by',32);
            $table->string('updated_by',32);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
