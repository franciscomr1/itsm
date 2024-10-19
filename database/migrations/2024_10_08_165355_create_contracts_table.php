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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->constrained();
            $table->string('name',32)->unique();
            $table->string('invoice_number',32)->unique();
            $table->date('invoice_date');
            $table->date('warranty_start_date');
            $table->date('warranty_expiration_date');
            $table->string('contract_attached_path')->nullable();
            $table->string('purchase_order', 32)->nullable();
            $table->date('purchase_date')->nullable();
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
        Schema::dropIfExists('contracts');
    }
};
