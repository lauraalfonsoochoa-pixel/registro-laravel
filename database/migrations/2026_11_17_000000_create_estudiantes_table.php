<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estudiantes', function (Blueprint $table): void {
            $table->string('id', 15)->primary();
            $table->string('nombre', 60);
            $table->string('apellido', 60);
            $table->date('fecha_nacimiento');
            $table->string('codigo', 20);
            $table->string('programa', 100);
            $table->unsignedTinyInteger('semestre');
            $table->string('correo', 100);
            $table->string('telefono', 15);
            $table->string('direccion', 150);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
