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
        Schema::table('entities', function (Blueprint $table) {
            $table->string('industry')->nullable();
            $table->string('email')->nullable();
        });

        Schema::table('entity_locations', function (Blueprint $table) {
            $table->boolean('is_primary')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entities', function (Blueprint $table) {
            $table->dropColumn(['industry', 'email']);
        });

        Schema::table('entity_locations', function (Blueprint $table) {
            $table->dropColumn(['is_primary']);
        });
    }
};
