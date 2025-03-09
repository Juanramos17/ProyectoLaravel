<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tarea</title>
</head>
<body>
    <h1>Crear Nueva Tarea</h1>

    <form action="{{ route('tareas.store') }}" method="POST">
        @csrf

        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"></textarea>

        <label for="fecha_limite">Fecha Límite:</label>
        <input type="date" name="fecha_limite">

        <label for="estado">Estado:</label>
        <select name="estado">
            <option value="pendiente">Pendiente</option>
            <option value="completada">Completada</option>
        </select>

        <label for="prioridad">Prioridad:</label>
        <select name="prioridad">
            <option value="alta">Alta</option>
            <option value="media">Media</option>
            <option value="baja">Baja</option>
        </select>

        <button type="submit">Guardar Tarea</button>
    </form>
</body>
</html>
