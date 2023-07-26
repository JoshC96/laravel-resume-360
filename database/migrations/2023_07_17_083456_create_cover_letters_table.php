
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
        Schema::create('user_cover_letters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('content');
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('entity_cover_letters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('content');
            $table->timestamps();

            $table->unsignedBigInteger('entity_id');
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_cover_letters');
        Schema::dropIfExists('entity_cover_letters');
    }
};
