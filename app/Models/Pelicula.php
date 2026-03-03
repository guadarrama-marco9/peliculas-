<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    
    protected $table = 'peliculas';
    
    protected $fillable = [
        'clave_pelicula',
        'titulo',
        'titulo_original',
        'genero',
        'director',
        'pais',
        'idioma',
        'clasificacion',
        'anio',
        'duracion_min',
        'calificacion',
        'sinopsis',
        'fecha_estreno',
        'presupuesto',
        'recaudacion',
        'activo',
    ];
    
    protected $casts = [
        'fecha_estreno' => 'date',
        'activo' => 'boolean',
        'anio' => 'integer',
        'duracion_min' => 'integer',
        'calificacion' => 'decimal:1',
        'presupuesto' => 'decimal:2',
        'recaudacion' => 'decimal:2',
    ];
}
