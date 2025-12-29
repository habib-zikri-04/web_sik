<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('jadwal_id')
                ->constrained('jadwals')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // biar satu user tidak bisa absen dua kali di jadwal yang sama
            $table->unique(['jadwal_id', 'user_id']);

            // siapa yang absen (biar gampang filter)
            $table->enum('role', ['santri', 'pengajar']);

            $table->timestamp('waktu_absen')->useCurrent();

            // optional: hadir/izin/sakit (kalau belum perlu, boleh hapus)
            $table->enum('status', ['hadir', 'alpa'])->default('alpa');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
