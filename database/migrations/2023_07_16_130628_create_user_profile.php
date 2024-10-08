<?php

use Illuminate\Database\Eloquent\Scope;
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
            $table->text('bio')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('work_phone')->nullable();
            $table->string('website')->nullable();
            $table->string('address')->nullable();
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
        });

        Schema::create('user_qualifications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('field');
            $table->string('grade')->nullable();
            $table->string('description')->nullable();
            $table->integer('started_month')->nullable();
            $table->integer('started_year')->nullable();
            $table->integer('finished_month')->nullable();
            $table->integer('finished_year')->nullable();

            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('user_work_experiences', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->integer('started_month')->nullable();
            $table->integer('started_year')->nullable();
            $table->integer('finished_month')->nullable();
            $table->integer('finished_year')->nullable();
            $table->text('description')->nullable();

            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('user_publications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('published_month')->nullable();
            $table->integer('published_year')->nullable();
            $table->text('description')->nullable();

            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('user_referees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('user_licences', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('issued_month')->nullable();
            $table->integer('issued_year')->nullable();
            $table->text('description')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('user_certifications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('issued_month')->nullable();
            $table->integer('issued_year')->nullable();
            $table->text('description')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'bio',
                'date_of_birth',
                'gender',
                'nationality',
                'mobile_phone',
                'work_phone',
                'website',
                'address',
            ]);
        });

        Schema::dropIfExists('user_qualifications');
        Schema::dropIfExists('user_licences');
        Schema::dropIfExists('user_referees');
        Schema::dropIfExists('user_work_experiences');
        Schema::dropIfExists('user_publications');
        Schema::dropIfExists('user_certifications');
        Schema::dropIfExists('locations');
    }
};
