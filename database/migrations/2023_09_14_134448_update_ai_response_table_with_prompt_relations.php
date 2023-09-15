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
        Schema::table('ai_responses', function (Blueprint $table) {
            $table->dropColumn(['prompt']);

            $table->unsignedBigInteger('prompt_id')->nullable();
            $table->foreign('prompt_id')->references('id')->on('prompts')->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ai_responses', function (Blueprint $table) {
            $table->longText('prompt');

            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id']);

            $table->dropForeign(['prompt_id']);
            $table->dropColumn(['prompt_id']);
        });
    }
};
