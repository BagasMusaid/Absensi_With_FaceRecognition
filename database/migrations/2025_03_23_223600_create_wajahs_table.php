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
        Schema::create('wajahs', function (Blueprint $table) {
            $table->id();
            $table->string('NIS_Siswa');
            $table->longText('embedding');
            $table->string('face_images')->nullable();
            $table->foreign('NIS_Siswa')->references('NIS')->on('siswas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wajahs');
    }
};
