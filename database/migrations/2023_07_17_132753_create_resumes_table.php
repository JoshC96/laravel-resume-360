<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_resumes', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_public')->default(false);
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('user_resume_qualifications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('resume_id');
            $table->foreign('resume_id')->references('id')->on('user_resumes')->onDelete('cascade');
            $table->unsignedBigInteger('qualification_id');
            $table->foreign('qualification_id')->references('id')->on('user_qualifications')->onDelete('cascade');
        });

        Schema::create('user_resume_work_experiences', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('resume_id');
            $table->foreign('resume_id')->references('id')->on('user_resumes')->onDelete('cascade');
            $table->unsignedBigInteger('work_experience_id');
            $table->foreign('work_experience_id')->references('id')->on('user_work_experiences')->onDelete('cascade');
        });

        Schema::create('user_resume_publications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('resume_id');
            $table->foreign('resume_id')->references('id')->on('user_resumes')->onDelete('cascade');
            $table->unsignedBigInteger('publication_id');
            $table->foreign('publication_id')->references('id')->on('user_publications')->onDelete('cascade');
        });

        Schema::create('user_resume_referees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('resume_id');
            $table->foreign('resume_id')->references('id')->on('user_resumes')->onDelete('cascade');
            $table->unsignedBigInteger('referee_id');
            $table->foreign('referee_id')->references('id')->on('user_referees')->onDelete('cascade');
        });

        Schema::create('user_resume_licences', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('resume_id');
            $table->foreign('resume_id')->references('id')->on('user_resumes')->onDelete('cascade');
            $table->unsignedBigInteger('licence_id');
            $table->foreign('licence_id')->references('id')->on('user_licences')->onDelete('cascade');
        });

        Schema::create('user_resume_certifications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('resume_id');
            $table->foreign('resume_id')->references('id')->on('user_resumes')->onDelete('cascade');
            $table->unsignedBigInteger('certification_id');
            $table->foreign('certification_id')->references('id')->on('user_certifications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_resume_certifications');
        Schema::dropIfExists('user_resume_licences');
        Schema::dropIfExists('user_resume_referees');
        Schema::dropIfExists('user_resume_publications');
        Schema::dropIfExists('user_resume_work_experiences');
        Schema::dropIfExists('user_resume_qualifications');
        Schema::dropIfExists('user_resumes');
    }
};
