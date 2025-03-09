@extends('layouts.app')

@section('content')
    <!-- Barra de navegación de la aplicación -->
    <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand text-white" href="{{ url('/tareas') }}">
                <i class="bi bi-check-square"></i> Mis Tareas
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('tareas.create') }}"><i class="bi bi-plus-circle"></i> Crear Nueva Tarea</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link text-white"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}"><i class="bi bi-person-plus"></i> Registrar</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Formulario de edición de tarea -->
    <div class="container mt-4">
        <h1 class="mb-4 text-center text-primary">Editar Tarea</h1>

        <form action="{{ route('tareas.update', $tarea) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Campo Título -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" name="titulo" value="{{ $tarea->titulo }}" required>
            </div>

            <!-- Campo Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <textarea class="form-control" name="descripcion" rows="4" required>{{ $tarea->descripcion }}</textarea>
            </div>

            <!-- Campo Fecha Limite -->
            <div class="mb-3">
                <label for="fecha_limite" class="form-label">Fecha y Hora Límite:</label>
                <!-- Cambié a datetime-local -->
                <input type="datetime-local" class="form-control" name="fecha_limite" value="{{ \Carbon\Carbon::parse($tarea->fecha_limite)->format('Y-m-d\TH:i') }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" required>
            </div>

            <!-- Campo Estado -->
            <div class="mb-3">
                <label for="estado" class="form-label">Estado:</label>
                <select class="form-select" name="estado" required>
                    <option value="pendiente" {{ $tarea->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="completada" {{ $tarea->estado == 'completada' ? 'selected' : '' }}>Completada</option>
                </select>
            </div>

            <!-- Campo Prioridad -->
            <div class="mb-3">
                <label for="prioridad" class="form-label">Prioridad:</label>
                <select class="form-select" name="prioridad" required>
                    <option value="alta" {{ $tarea->prioridad == 'alta' ? 'selected' : '' }}>Alta</option>
                    <option value="media" {{ $tarea->prioridad == 'media' ? 'selected' : '' }}>Media</option>
                    <option value="baja" {{ $tarea->prioridad == 'baja' ? 'selected' : '' }}>Baja</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Actualizar Tarea</button>
            </div>
        </form>
    </div>
@endsection
