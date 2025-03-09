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
        <input type="text" name="titulo" id="titulo" required>
        <br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion"></textarea>
        <br>

        <label for="fecha_limite">Fecha Límite:</label>
        <input type="date" name="fecha_limite" id="fecha_limite">
        <br>

        <label for="estado">Estado:</label>
        <select name="estado" id="estado" required>
            <option value="pendiente">Pendiente</option>
            <option value="completada">Completada</option>
        </select>
        <br>

        <button type="submit">Guardar</button>
    </form>
</body>
</html>
