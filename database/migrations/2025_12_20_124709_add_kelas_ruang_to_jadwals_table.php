<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->foreignId('kelas_id')
                ->after('pengajar_id')
                ->constrained('kelas')
                ->cascadeOnDelete();

            $table->string('ruang')->nullable()->after('kelas_id'); // kolom "Nama Lokal" di PDF
        });
    }

    public function down(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->dropColumn('ruang');
            $table->dropConstrainedForeignId('kelas_id');
        });
    }
};
