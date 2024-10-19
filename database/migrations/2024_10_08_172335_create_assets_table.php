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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->constrained();
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('asset_model_id')->constrained();
            $table->foreignId('asset_status_id')->constrained();
            $table->foreignId('asset_condition_id')->constrained();
            $table->foreignId('employee_id')->constrained()->nullable();
            $table->string('asset_tag',32)->unique()->nullable();
            $table->string('serial_number',32)->unique();
            $table->string('service_tag',32)->unique()->nullable();
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
        Schema::dropIfExists('assets');
    }
};
