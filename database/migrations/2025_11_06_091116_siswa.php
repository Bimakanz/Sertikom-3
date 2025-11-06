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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nisn')->unique();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('tahun_ajar_id')->constrained('tahun_ajars')->onDelete('cascade');
            $table->foreignId('jurusan_id')->constrained('jurusans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
