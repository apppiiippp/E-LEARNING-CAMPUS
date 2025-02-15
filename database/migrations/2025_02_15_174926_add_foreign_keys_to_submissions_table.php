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
        Schema::table('submissions', function (Blueprint $table) {
            $table->foreign('assignments_id', 'fk_submissions_to_assignments')->references('id')->on('assignments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('students_id', 'fk_submissions_to_users')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropForeign('fk_submissions_to_assignments');
            $table->dropForeign('fk_submissions_to_users');
        });
    }
};
