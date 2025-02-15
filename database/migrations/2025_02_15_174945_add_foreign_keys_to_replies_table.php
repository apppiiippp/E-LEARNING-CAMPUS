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
        Schema::table('replies', function (Blueprint $table) {
            $table->foreign('discussions_id', 'fk_replies_to_discussions')->references('id')->on('discussions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id', 'fk_replies_to_users')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('replies', function (Blueprint $table) {
            $table->dropForeign('fk_replies_to_discussions');
            $table->dropForeign('fk_replies_to_users');
        });
    }
};
