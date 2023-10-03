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
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('job_listing_skills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skill_id')->nullable();
            $table->unsignedBigInteger('job_listing_id')->nullable();
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
            $table->foreign('job_listing_id')->references('id')->on('job_listings')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('user_skills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skill_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_listing_skills', function (Blueprint $table) {
            $table->dropForeign(['skill_id']);
            $table->dropForeign(['job_listing_id']);
            $table->dropColumn(['skill_id']);
            $table->dropColumn(['job_listing_id']);
        });

        Schema::table('user_skills', function (Blueprint $table) {
            $table->dropForeign(['skill_id']);
            $table->dropForeign(['user_id']);
            $table->dropColumn(['skill_id']);
            $table->dropColumn(['user_id']);
        });

        Schema::dropIfExists('job_listing_skills');
        Schema::dropIfExists('user_skills');
        Schema::dropIfExists('skills');
    }
};
