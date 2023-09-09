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
        Schema::table('user_job_applications', function (Blueprint $table) {
            $table->dropForeign(['cover_letter_id']);
            $table->dropColumn(['cover_letter_id']);

            $table->longText('cover_letter')->nullable();
        });

        Schema::dropIfExists('user_cover_letters');
        Schema::dropIfExists('entity_cover_letters');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('user_cover_letters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('content');
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('entity_cover_letters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('content');
            $table->timestamps();

            $table->unsignedBigInteger('entity_id');
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade');
        });

        Schema::table('user_job_applications', function (Blueprint $table) {
            $table->unsignedBigInteger('cover_letter_id')->nullable();
            $table->foreign('cover_letter_id')->references('id')->on('user_cover_letters')->onDelete('set null');
        });
    }
};
