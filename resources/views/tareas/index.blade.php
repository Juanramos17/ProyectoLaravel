<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Tareas</title>
</head>
<body>
    <h1>Mis Tareas</h1>

    <!-- Botón para cerrar sesión -->
    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button type="submit">Cerrar Sesión</button>
    </form>

    <a href="{{ route('tareas.create') }}">Crear Nueva Tarea</a>

    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Fecha Limite</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tareas as $tarea)
                <tr>
                    <td>{{ $tarea->titulo }}</td>
                    <td>{{ $tarea->descripcion }}</td>
                    <td>{{ $tarea->fecha_limite }}</td>
                    <td>{{ ucfirst($tarea->estado) }}</td>
                    <td>
                        <a href="{{ route('tareas.edit', $tarea) }}">Editar</a>

                        <!-- Botón para cambiar el estado de la tarea -->
                        <form action="{{ route('tareas.cambiarEstado', $tarea) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit">
                                {{ $tarea->estado == 'pendiente' ? 'Marcar como completada' : 'Marcar como pendiente' }}
                            </button>
                        </form>

                        <form action="{{ route('tareas.destroy', $tarea) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
