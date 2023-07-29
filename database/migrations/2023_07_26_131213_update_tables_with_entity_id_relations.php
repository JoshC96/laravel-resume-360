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
        Schema::table('user_work_experiences', function (Blueprint $table) {
            $table->unsignedBigInteger('entity_id');
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade');
        });

        Schema::table('user_referees', function (Blueprint $table) {
            $table->unsignedBigInteger('entity_id');
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade');
        });

        Schema::table('user_qualifications', function (Blueprint $table) {
            $table->unsignedBigInteger('entity_id');
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_work_experiences', function (Blueprint $table) {
            $table->dropForeign('entity_id');
            $table->dropColumn('entity_id');
        });

        Schema::table('user_referees', function (Blueprint $table) {
            $table->dropForeign('entity_id');
            $table->dropColumn('entity_id');
        });

        Schema::table('user_qualifications', function (Blueprint $table) {
            $table->dropForeign('entity_id');
            $table->dropColumn('entity_id');
        });
    }
};
