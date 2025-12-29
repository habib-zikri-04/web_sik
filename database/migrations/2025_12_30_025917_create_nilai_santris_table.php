<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('nilai_santris', function (Blueprint $table) {
            $table->id();

            $table->foreignId('santri_id')
                ->constrained('santris')
                ->cascadeOnDelete();

            $table->foreignId('subject_id')
                ->constrained('subjects')
                ->cascadeOnDelete();

            $table->foreignId('kelas_id')
                ->constrained('kelas')
                ->cascadeOnDelete();

            $table->integer('nilai')->nullable();
            $table->text('feedback')->nullable();

            $table->timestamps();

            // biar tidak double nilai untuk kombinasi yang sama
            $table->unique(['santri_id', 'subject_id', 'kelas_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_santris');
    }
};
