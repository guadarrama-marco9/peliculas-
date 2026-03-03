<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peliculas = Pelicula::all();
        return view('peliculas.index', compact('peliculas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('peliculas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'clave_pelicula' => 'required|integer|unique:peliculas,clave_pelicula',
            'titulo' => 'required|string|max:255',
            'titulo_original' => 'nullable|string|max:255',
            'genero' => 'required|string|max:100',
            'director' => 'required|string|max:255',
            'pais' => 'required|string|max:100',
            'idioma' => 'required|string|max:100',
            'clasificacion' => 'required|string|max:50',
            'anio' => 'required|integer|min:1900|max:' . date('Y'),
            'duracion_min' => 'nullable|integer|min:1',
            'calificacion' => 'nullable|numeric|min:0|max:10',
            'sinopsis' => 'nullable|string',
            'fecha_estreno' => 'nullable|date',
            'presupuesto' => 'nullable|numeric|min:0',
            'recaudacion' => 'nullable|numeric|min:0',
            'activo' => 'boolean',
        ]);

        // Si no se envía el campo activo, establecerlo como false por defecto
        $validated['activo'] = $request->has('activo');

        Pelicula::create($validated);

        return redirect()->route('peliculas.index')
            ->with('success', 'Película creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelicula $pelicula)
    {
        return view('peliculas.show', compact('pelicula'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelicula $pelicula)
    {
        return view('peliculas.edit', compact('pelicula'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelicula $pelicula)
    {
        $validated = $request->validate([
            'clave_pelicula' => 'required|integer|unique:peliculas,clave_pelicula,' . $pelicula->id,
            'titulo' => 'required|string|max:255',
            'titulo_original' => 'nullable|string|max:255',
            'genero' => 'required|string|max:100',
            'director' => 'required|string|max:255',
            'pais' => 'required|string|max:100',
            'idioma' => 'required|string|max:100',
            'clasificacion' => 'required|string|max:50',
            'anio' => 'required|integer|min:1900|max:' . date('Y'),
            'duracion_min' => 'nullable|integer|min:1',
            'calificacion' => 'nullable|numeric|min:0|max:10',
            'sinopsis' => 'nullable|string',
            'fecha_estreno' => 'nullable|date',
            'presupuesto' => 'nullable|numeric|min:0',
            'recaudacion' => 'nullable|numeric|min:0',
            'activo' => 'boolean',
        ]);

        // Si no se envía el campo activo, establecerlo como false por defecto
        $validated['activo'] = $request->has('activo');

        $pelicula->update($validated);

        return redirect()->route('peliculas.index')
            ->with('success', 'Película actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelicula $pelicula)
    {
        $pelicula->delete();

        return redirect()->route('peliculas.index')
            ->with('success', 'Película eliminada exitosamente.');
    }
}
