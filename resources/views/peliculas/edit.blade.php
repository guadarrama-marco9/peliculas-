<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Película</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f5f5f5;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .header {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        
        .header h1 {
            color: #333;
            font-size: 24px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
        }
        
        .form-row {
            display: flex;
            gap: 15px;
        }
        
        .form-row .form-group {
            flex: 1;
        }
        
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .checkbox-group input[type="checkbox"] {
            width: auto;
        }
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
        }
        
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #0056b3;
        }
        
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #545b62;
        }
        
        .error {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
        }
        
        .buttons {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Editar Película</h1>
        </div>

        <form action="{{ route('peliculas.update', $pelicula->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-row">
                <div class="form-group">
                    <label for="clave_pelicula">Clave *</label>
                    <input type="number" name="clave_pelicula" id="clave_pelicula" value="{{ old('clave_pelicula', $pelicula->clave_pelicula) }}" required>
                    @error('clave_pelicula') <span class="error">{{ $message }}</span> @enderror
                </div>
                
                <div class="form-group">
                    <label for="anio">Año *</label>
                    <input type="number" name="anio" id="anio" value="{{ old('anio', $pelicula->anio) }}" min="1900" max="{{ date('Y') }}" required>
                    @error('anio') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="titulo">Título *</label>
                <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $pelicula->titulo) }}" required>
                @error('titulo') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="titulo_original">Título Original</label>
                <input type="text" name="titulo_original" id="titulo_original" value="{{ old('titulo_original', $pelicula->titulo_original) }}">
                @error('titulo_original') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="genero">Género *</label>
                    <input type="text" name="genero" id="genero" value="{{ old('genero', $pelicula->genero) }}" required>
                    @error('genero') <span class="error">{{ $message }}</span> @enderror
                </div>
                
                <div class="form-group">
                    <label for="director">Director *</label>
                    <input type="text" name="director" id="director" value="{{ old('director', $pelicula->director) }}" required>
                    @error('director') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="pais">País *</label>
                    <input type="text" name="pais" id="pais" value="{{ old('pais', $pelicula->pais) }}" required>
                    @error('pais') <span class="error">{{ $message }}</span> @enderror
                </div>
                
                <div class="form-group">
                    <label for="idioma">Idioma *</label>
                    <input type="text" name="idioma" id="idioma" value="{{ old('idioma', $pelicula->idioma) }}" required>
                    @error('idioma') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="clasificacion">Clasificación *</label>
                    <select name="clasificacion" id="clasificacion" required>
                        <option value="">Seleccionar...</option>
                        <option value="G" {{ old('clasificacion', $pelicula->clasificacion) == 'G' ? 'selected' : '' }}>G - General</option>
                        <option value="PG" {{ old('clasificacion', $pelicula->clasificacion) == 'PG' ? 'selected' : '' }}>PG - Parental Guidance</option>
                        <option value="PG-13" {{ old('clasificacion', $pelicula->clasificacion) == 'PG-13' ? 'selected' : '' }}>PG-13</option>
                        <option value="R" {{ old('clasificacion', $pelicula->clasificacion) == 'R' ? 'selected' : '' }}>R - Restricted</option>
                        <option value="NC-17" {{ old('clasificacion', $pelicula->clasificacion) == 'NC-17' ? 'selected' : '' }}>NC-17</option>
                    </select>
                    @error('clasificacion') <span class="error">{{ $message }}</span> @enderror
                </div>
                
                <div class="form-group">
                    <label for="duracion_min">Duración (minutos)</label>
                    <input type="number" name="duracion_min" id="duracion_min" value="{{ old('duracion_min', $pelicula->duracion_min) }}" min="1">
                    @error('duracion_min') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="calificacion">Calificación (0-10)</label>
                    <input type="number" name="calificacion" id="calificacion" value="{{ old('calificacion', $pelicula->calificacion) }}" min="0" max="10" step="0.1">
                    @error('calificacion') <span class="error">{{ $message }}</span> @enderror
                </div>
                
                <div class="form-group">
                    <label for="fecha_estreno">Fecha de Estreno</label>
                    <input type="date" name="fecha_estreno" id="fecha_estreno" value="{{ old('fecha_estreno', $pelicula->fecha_estreno ? $pelicula->fecha_estreno->format('Y-m-d') : '') }}">
                    @error('fecha_estreno') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="sinopsis">Sinopsis</label>
                <textarea name="sinopsis" id="sinopsis" rows="4" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">{{ old('sinopsis', $pelicula->sinopsis) }}</textarea>
                @error('sinopsis') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="presupuesto">Presupuesto</label>
                    <input type="number" name="presupuesto" id="presupuesto" value="{{ old('presupuesto', $pelicula->presupuesto) }}" min="0" step="0.01">
                    @error('presupuesto') <span class="error">{{ $message }}</span> @enderror
                </div>
                
                <div class="form-group">
                    <label for="recaudacion">Recaudación</label>
                    <input type="number" name="recaudacion" id="recaudacion" value="{{ old('recaudacion', $pelicula->recaudacion) }}" min="0" step="0.01">
                    @error('recaudacion') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="checkbox-group">
                    <input type="checkbox" name="activo" id="activo" value="1" {{ old('activo', $pelicula->activo) ? 'checked' : '' }}>
                    <label for="activo">Activo</label>
                </div>
                @error('activo') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="buttons">
                <button type="submit" class="btn btn-primary">Actualizar Película</button>
                <a href="{{ route('peliculas.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
