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
        Schema::create('walikelas', function (Blueprint $table) {
            $table->id();
            $table->char('guru_id', 20)->nullable();
            $table->string('password');
            $table->string('foto_profil')->nullable();
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->onDelete('cascade');
            $table->foreign('guru_id')->references('kd_guru')->on('gurus')->onDelete('cascade');
            $table->rememberToken()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('walikelas');
    }
};
