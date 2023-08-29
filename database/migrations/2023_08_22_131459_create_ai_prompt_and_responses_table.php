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
        Schema::create('prompts', function (Blueprint $table) {
            $table->id();
            $table->longText('content');
            $table->timestamps();
        });

        Schema::create('ai_responses', function (Blueprint $table) {
            $table->id();
            $table->integer('source')->default(0);
            $table->longText('prompt');
            $table->longText('content');
            $table->jsonb('payload');
            $table->string('remote_id')->nullable();
            $table->string('model')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prompts');
        Schema::dropIfExists('ai_responses');
    }
};
