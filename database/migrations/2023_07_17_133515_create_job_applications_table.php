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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('status')->default(0);
            $table->boolean('apply_with_profile')->default(false);
            $table->timestamp('applied_at')->nullable();
            $table->timestamp('viewed_at')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('job_listing_id');
            $table->foreign('job_listing_id')->references('id')->on('job_listings')->onDelete('cascade');

            $table->unsignedBigInteger('cover_letter_id')->nullable();
            $table->foreign('cover_letter_id')->references('id')->on('cover_letters')->onDelete('set null');

            $table->unsignedBigInteger('resume_id')->nullable();
            $table->foreign('resume_id')->references('id')->on('resumes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
