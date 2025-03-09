@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4 text-center">Mis Tareas</h1>

        <!-- Mostrar los mensajes de éxito o error -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Tabla de tareas -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Fecha Límite</th>
                        <th>Prioridad</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tareas as $tarea)
                        <tr>
                            <td>{{ $tarea->titulo }}</td>
                            <td>{{ $tarea->descripcion }}</td>
                            <td>{{ \Carbon\Carbon::parse($tarea->fecha_limite)->format('Y-m-d H:i') }}</td>
                            <td>
                                <span class="badge 
                                    @if($tarea->prioridad == 'alta') bg-danger 
                                    @elseif($tarea->prioridad == 'media') bg-warning 
                                    @elseif($tarea->prioridad == 'baja') bg-success
                                    @endif">
                                    {{ ucfirst($tarea->prioridad) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge 
                                    @if($tarea->estado == 'pendiente') bg-warning 
                                    @elseif($tarea->estado == 'completada') bg-success
                                    @endif">
                                    {{ ucfirst($tarea->estado) }}
                                </span>
                            </td>
                            <td>
                                <!-- Botones de acción -->
                                <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                                <!-- Cambiar estado de tarea -->
                                <form action="{{ route('tareas.cambiarEstado', $tarea->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-sm">
                                        <i class="bi bi-check-circle"></i> Cambiar Estado
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Botón para crear una nueva tarea -->
        <a href="{{ route('tareas.create') }}" class="btn btn-success mt-3">
            <i class="bi bi-plus-circle"></i> Crear Nueva Tarea
        </a>
    </div>
@endsection
