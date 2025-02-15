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
        Schema::table('courses_students', function (Blueprint $table) {
            $table->foreign('courses_id', 'fk_courses_students_to_courses')->references('id')->on('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('students_id', 'fk_courses_students_to_users')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses_students', function (Blueprint $table) {
            $table->dropForeign('fk_courses_students_to_courses');
            $table->dropForeign('fk_courses_students_to_users');
        });
    }
};
