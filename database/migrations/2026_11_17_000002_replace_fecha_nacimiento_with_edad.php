<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('estudiantes', 'fecha_nacimiento')) {
            if (DB::table('estudiantes')->exists()) {
                throw new RuntimeException('No se puede reemplazar fecha_nacimiento porque estudiantes contiene filas. Exporta o convierte los datos antes de migrar.');
            }

            Schema::table('estudiantes', function (Blueprint $table): void {
                $table->dropColumn('fecha_nacimiento');
            });
        }

        if (! Schema::hasColumn('estudiantes', 'edad')) {
            Schema::table('estudiantes', function (Blueprint $table): void {
                $table->unsignedTinyInteger('edad')->after('apellido');
            });
        }
    }

    public function down(): void
    {
        if (DB::table('estudiantes')->exists()) {
            throw new RuntimeException('No se puede revertir edad a fecha_nacimiento mientras existan estudiantes. Exporta los datos antes de revertir.');
        }

        if (Schema::hasColumn('estudiantes', 'edad')) {
            Schema::table('estudiantes', function (Blueprint $table): void {
                $table->dropColumn('edad');
            });
        }

        if (! Schema::hasColumn('estudiantes', 'fecha_nacimiento')) {
            Schema::table('estudiantes', function (Blueprint $table): void {
                $table->date('fecha_nacimiento')->after('apellido');
            });
        }
    }
};
