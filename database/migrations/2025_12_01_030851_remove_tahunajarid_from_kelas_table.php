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
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropForeign(['tahun_ajar_id']); // Drop foreign key constraint first
        });

        Schema::table('kelas', function (Blueprint $table) {
            $table->foreignId('tahun_ajar_id')->nullable()->change(); // Make nullable
        });

        Schema::table('kelas', function (Blueprint $table) {
            $table->foreign('tahun_ajar_id')->references('id')->on('tahun_ajars')->onDelete('cascade'); // Re-add foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropForeign(['tahun_ajar_id']); // Drop foreign key constraint first
        });

        Schema::table('kelas', function (Blueprint $table) {
            $table->foreignId('tahun_ajar_id')->nullable(false)->change(); // Make not nullable
        });

        Schema::table('kelas', function (Blueprint $table) {
            $table->foreign('tahun_ajar_id')->references('id')->on('tahun_ajars')->onDelete('cascade'); // Re-add foreign key
        });
    }
};