<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Películas</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQYQBpFX0WM2Gsi-XS669oQ9cTceLSWJzVNZw&s');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            min-height: 100vh;
            position: relative;
            overflow-x: auto;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(30, 60, 114, 0.7);
            pointer-events: none;
            z-index: 1;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            position: relative;
            z-index: 2;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        
        .header h1 {
            color: #333;
            font-size: 24px;
            font-weight: normal;
        }
        
        .btn-nuevo {
            background-color: #007bff;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        
        .btn-nuevo:hover {
            background-color: #0056b3;
        }
        
        .table-container {
            overflow-x: auto;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: white;
        }
        
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }
        
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #495057;
            position: sticky;
            top: 0;
        }
        
        td {
            vertical-align: middle;
            color: #333;
        }
        
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        tr:hover {
            background-color: #e9ecef;
        }
        
        .acciones {
            display: flex;
            gap: 5px;
        }
        
        .btn-editar, .btn-eliminar {
            padding: 4px 8px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 11px;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-editar {
            background-color: #28a745;
            color: white;
        }
        
        .btn-editar:hover {
            background-color: #218838;
        }
        
        .btn-eliminar {
            background-color: #dc3545;
            color: white;
        }
        
        .btn-eliminar:hover {
            background-color: #c82333;
        }
        
        .activo-si {
            color: #28a745;
            font-weight: bold;
        }
        
        .activo-no {
            color: #dc3545;
            font-weight: bold;
        }
        
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Lista de Películas</h1>
            <a href="{{ route('peliculas.create') }}" class="btn-nuevo">Nueva pelicula</a>
        </div>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Titulo</th>
                        <th>Titulo original</th>
                        <th>Género</th>
                        <th>Director</th>
                        <th>Pais</th>
                        <th>Idioma</th>
                        <th>Clasificación</th>
                        <th>Año</th>
                        <th>Duración (min)</th>
                        <th>Calificación</th>
                        <th>Fecha estreno</th>
                        <th>Presupuesto</th>
                        <th>Recaudación</th>
                        <th>Activo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($peliculas as $pelicula)
                    <tr>
                        <td>{{ $pelicula->clave_pelicula }}</td>
                        <td>{{ $pelicula->titulo }}</td>
                        <td>{{ $pelicula->titulo_original ?? '-' }}</td>
                        <td>{{ $pelicula->genero }}</td>
                        <td>{{ $pelicula->director }}</td>
                        <td>{{ $pelicula->pais }}</td>
                        <td>{{ $pelicula->idioma }}</td>
                        <td>{{ $pelicula->clasificacion }}</td>
                        <td>{{ $pelicula->anio }}</td>
                        <td>{{ $pelicula->duracion_min ?? '-' }}</td>
                        <td>{{ $pelicula->calificacion ?? '-' }}</td>
                        <td>{{ $pelicula->fecha_estreno ? $pelicula->fecha_estreno->format('d/m/Y') : '-' }}</td>
                        <td>{{ $pelicula->presupuesto ? '$' . number_format($pelicula->presupuesto, 2) : '-' }}</td>
                        <td>{{ $pelicula->recaudacion ? '$' . number_format($pelicula->recaudacion, 2) : '-' }}</td>
                        <td>
                            <span class="{{ $pelicula->activo ? 'activo-si' : 'activo-no' }}">
                                {{ $pelicula->activo ? 'Sí' : 'No' }}
                            </span>
                        </td>
                        <td>
                            <div class="acciones">
                                <a href="{{ route('peliculas.edit', $pelicula->id) }}" class="btn-editar">Editar</a>
                                <form action="{{ route('peliculas.destroy', $pelicula->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-eliminar" onclick="return confirm('¿Está seguro de eliminar esta película?')">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="16" style="text-align: center; padding: 20px;">
                            No hay películas registradas
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
