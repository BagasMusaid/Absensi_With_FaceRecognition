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
        Schema::create('gurus', function (Blueprint $table) {
            $table->char('kd_guru', 20)->primary();
            $table->string('NIP')->unique();
            $table->string('nama_guru');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->enum('kepalasekolah', ['ya', 'tidak']);
            $table->string('alamat');
            $table->string('no_telp');
            $table->string('email')->unique();
            $table->string('foto_profil')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
