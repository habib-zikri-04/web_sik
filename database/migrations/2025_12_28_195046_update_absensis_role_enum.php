<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    public function up(): void
{
    DB::statement("
        ALTER TABLE absensis
        DROP CONSTRAINT absensis_role_check
    ");

    DB::statement("
        ALTER TABLE absensis
        ADD CONSTRAINT absensis_role_check
        CHECK (role IN ('santri', 'guru', 'civitas'))
    ");
}

public function down(): void
{
    DB::statement("
        ALTER TABLE absensis
        DROP CONSTRAINT absensis_role_check
    ");

    DB::statement("
        ALTER TABLE absensis
        ADD CONSTRAINT absensis_role_check
        CHECK (role IN ('santri', 'pengajar'))
    ");
}

};
