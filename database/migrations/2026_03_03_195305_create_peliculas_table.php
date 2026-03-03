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
        Schema::create('peliculas', function (Blueprint $table) {
            $table->id();
            $table->integer('clave_pelicula')->unique();
            $table->string('titulo');
            $table->string('titulo_original')->nullable();
            $table->string('genero');
            $table->string('director');
            $table->string('pais');
            $table->string('idioma');
            $table->string('clasificacion');
            $table->integer('anio');
            $table->integer('duracion_min')->nullable();
            $table->decimal('calificacion', 3, 1)->nullable();
            $table->text('sinopsis')->nullable();
            $table->date('fecha_estreno')->nullable();
            $table->decimal('presupuesto', 12, 2)->nullable();
            $table->decimal('recaudacion', 12, 2)->nullable();
            $table->boolean('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peliculas');
    }
};
