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
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->string('nis_siswa');
            $table->date('tanggal');
            $table->time('waktu_presensi');
            $table->enum('status', ['Hadir', 'Alpha', 'Sakit', 'Izin']);
            $table->foreignId('jadwal_id')->nullable()->constrained('jadwal_presensis')->onDelete('cascade');
            $table->foreign('nis_siswa')->references('NIS')->on('siswas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};