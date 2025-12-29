<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();

            // Sesi: 0 = Mengaji, 1 = Sesi 1, 2 = Sesi 2, 3 = Sesi 3
            $table->tinyInteger('sesi')->comment('0=mengaji, 1=sesi1, 2=sesi2, 3=sesi3');

            // Mata pelajaran: Keislaman / Keimanan / Kehsanan
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');

            // Pengajar (guru) yang mengajar sesi tersebut
            $table->foreignId('pengajar_id')->constrained('pengajars')->onDelete('cascade');

            // Tanggal pertemuan
            $table->date('tanggal');

            // Jam mulai dan selesai
            $table->time('jam_mulai');
            $table->time('jam_selesai');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
