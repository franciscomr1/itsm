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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('subject', 32);
            $table->string('description');
            $table->foreignId('issue_type_id')->constrained()->default(4);
            $table->foreignId('request_type_id')->constrained()->default(6);
            $table->foreignId('request_status_id')->constrained()->default(1);
            $table->foreignId('urgency_level_id')->constrained()->default(1);
            $table->foreignId('priority_level_id')->constrained()->default(1);
            $table->foreignId('request_channel_id')->constrained()->default(3);
            $table->foreignId('employee_id')->constrained()->nullable();
            $table->dateTime('assigned_at')->nullable();
            $table->string('assigned_to')->nullable();
            $table->dateTime('escalated_at')->nullable();
            $table->dateTime('closed_at')->nullable();
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
        Schema::dropIfExists('tickets');
    }
};
