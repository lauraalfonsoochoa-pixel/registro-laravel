<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('estudiantes', function (Blueprint $table): void {
            $table->unique('correo');
        });
    }

    public function down(): void
    {
        Schema::table('estudiantes', function (Blueprint $table): void {
            $table->dropUnique('estudiantes_correo_unique');
        });
    }
};
