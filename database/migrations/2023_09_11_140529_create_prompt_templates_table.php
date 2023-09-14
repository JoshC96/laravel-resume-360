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
        Schema::create('prompt_templates', function (Blueprint $table) {
            $table->id();
            $table->longText('content');
            $table->integer('status')->default(1);
            $table->integer('use_location')->nullable();

            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('updated_by_id')->nullable();
            $table->foreign('updated_by_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::table('prompts', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('template_id')->nullable();
            $table->foreign('template_id')->references('id')->on('prompt_templates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prompts', function (Blueprint $table) {
            $table->dropForeign(['created_by_id']);
            $table->dropColumn(['created_by_id']);

            $table->dropForeign(['template_id']);
            $table->dropColumn(['template_id']);
        });
        
        Schema::dropIfExists('prompt_templates');
    }
};
