<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
</head>
<body>
    <h1>Editar Tarea</h1>

    <form action="{{ route('tareas.update', $tarea) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" value="{{ $tarea->titulo }}" required>
        <br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion">{{ $tarea->descripcion }}</textarea>
        <br>

        <label for="fecha_limite">Fecha Límite:</label>
        <input type="date" name="fecha_limite" id="fecha_limite" value="{{ $tarea->fecha_limite }}">
        <br>

        <label for="estado">Estado:</label>
        <select name="estado" id="estado" required>
            <option value="pendiente" {{ $tarea->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="completada" {{ $tarea->estado == 'completada' ? 'selected' : '' }}>Completada</option>
        </select>
        <br>

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
