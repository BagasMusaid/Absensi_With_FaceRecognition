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
        Schema::create('guru_pikets', function (Blueprint $table) {
            $table->id();
            $table->char('guru_id', 20)->nullable();
            $table->foreign('guru_id')->references('kd_guru')->on('gurus')->onDelete('cascade');
            $table->string('hari');
            $table->foreignId('kd_tahun_ajaran')->nullable()->constrained('tahun_ajarans')->onDelete('cascade');
            $table->string('password')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru_pikets');
    }
};
