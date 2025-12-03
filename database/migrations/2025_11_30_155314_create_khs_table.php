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
        Schema::create('khs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa_profiles')->cascadeOnDelete();
            $table->foreignId('matkul_id')->constrained('matkul')->cascadeOnDelete();
            $table->foreignId('dosen_id')->constrained('dosen_profiles')->cascadeOnDelete();
            
            // Komponen Nilai
            $table->decimal('tugas', 5, 2)->nullable()->comment('Nilai Tugas (0-100)');
            $table->decimal('uts', 5, 2)->nullable()->comment('Nilai UTS (0-100)');
            $table->decimal('uas', 5, 2)->nullable()->comment('Nilai UAS (0-100)');
            $table->decimal('nilai_akhir', 5, 2)->nullable()->comment('Nilai Akhir (hasil kalkulasi)');
            $table->string('grade', 2)->nullable()->comment('Grade (A, A-, B+, B, B-, C+, C, D, E)');
            
            // Field lama (bisa dihapus jika tidak digunakan)
            $table->string('nilai')->nullable()->comment('Deprecated - gunakan nilai_akhir');
            
            $table->integer('semester');
            $table->string('tahun_ajaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khs');
    }
};
