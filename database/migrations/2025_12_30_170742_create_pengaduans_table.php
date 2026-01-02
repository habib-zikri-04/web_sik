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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();

            // Pelapor (Guru / Civitas)
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Santri yang dilaporkan
            $table->foreignId('santri_id')
                ->constrained('santris')
                ->cascadeOnDelete();

            $table->string('judul');
            $table->text('deskripsi');
            $table->date('tanggal_kejadian');

            $table->enum('status', ['pending', 'proses', 'selesai', 'ditolak'])
                ->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
