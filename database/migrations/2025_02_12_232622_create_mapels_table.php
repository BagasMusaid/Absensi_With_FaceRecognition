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
        Schema::create('mapels', function (Blueprint $table) {
            $table->char('kd_mapel', 20)->primary();
            $table->string('nama_mapel');
            $table->string('hari');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->foreignId('kd_kelas')->nullable()->constrained('kelas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mapels');
    }
};
