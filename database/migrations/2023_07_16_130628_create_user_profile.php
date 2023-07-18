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
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
        });

        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('started_at')->nullable();
            $table->date('finished_at')->nullable();

            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
        });

        Schema::create('work_experiences', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('entity')->nullable();
            $table->date('started_at')->nullable();
            $table->date('finished_at')->nullable();
            $table->text('description')->nullable();

            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
        });

        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('published_at')->nullable();
            $table->text('description')->nullable();

            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
        });

        Schema::create('referees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('entity')->nullable();
            $table->string('position')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });

        Schema::create('licences', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->date('issued_at')->nullable();
            $table->text('description')->nullable();

            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
        });

        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->date('issued_at')->nullable();
            $table->text('description')->nullable();

            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'date_of_birth',
                'gender',
                'nationality',
                'mobile_phone',
                'work_phone',
                'email',
                'website',
                'address',
            ]);
        });

        Schema::dropIfExists('qualifications');
        Schema::dropIfExists('licences');
        Schema::dropIfExists('work_experiences');
        Schema::dropIfExists('publications');
        Schema::dropIfExists('user_work_experience');
        Schema::dropIfExists('locations');
    }
};
