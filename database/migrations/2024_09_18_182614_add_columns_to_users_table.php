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
        Schema::table('users', function (Blueprint $table) {
            Schema::table('users', function (Blueprint $table) {
                $table->foreignId('employee_id')->constrained();
                $table->string('email')->unique(false)->change();
                $table->string('username')->unique();
                $table->string('is_active')->boolean()->default(true);
                $table->string('created_by',32);
                $table->string('updated_by',32);
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign(['employee_id']);
            });
        } 
        Schema::table('users', function (Blueprint $table) {
            $table->unique('email');
            $table->dropUnique('users_username_unique');
            $table->dropColumn(['is_active','created_by','updated_by','username','employee_id']);
        });
    }
};
