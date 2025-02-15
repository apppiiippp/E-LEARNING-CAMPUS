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
        Schema::create('courses_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('courses_id')->nullable()->index('fk_courses_students_to_courses');
            $table->foreignId('students_id')->nullable()->index('fk_courses_students_to_users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses_students');
    }
};
