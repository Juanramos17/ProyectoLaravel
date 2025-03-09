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
        <input type="text" name="titulo" value="{{ $tarea->titulo }}" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion">{{ $tarea->descripcion }}</textarea>

        <label for="fecha_limite">Fecha Límite:</label>
        <input type="date" name="fecha_limite" value="{{ $tarea->fecha_limite }}">

        <label for="estado">Estado:</label>
        <select name="estado">
            <option value="pendiente" {{ $tarea->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="completada" {{ $tarea->estado == 'completada' ? 'selected' : '' }}>Completada</option>
        </select>

        <label for="prioridad">Prioridad:</label>
        <select name="prioridad">
            <option value="alta" {{ $tarea->prioridad == 'alta' ? 'selected' : '' }}>Alta</option>
            <option value="media" {{ $tarea->prioridad == 'media' ? 'selected' : '' }}>Media</option>
            <option value="baja" {{ $tarea->prioridad == 'baja' ? 'selected' : '' }}>Baja</option>
        </select>

        <button type="submit">Actualizar Tarea</button>
    </form>
</body>
</html>
