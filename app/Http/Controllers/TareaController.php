<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TareaController extends Controller
{
    // Mostrar todas las tareas del usuario autenticado
    public function index()
    {
        $tareas = Tarea::where('usuario_id', auth()->id())->get();
        return view('tareas.index', compact('tareas'));
    }

    // Mostrar formulario para crear tarea
    public function create()
    {
        return view('tareas.create');
    }

    // Guardar nueva tarea
    public function store(Request $request)
    {
        // Validación del formulario
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_limite' => 'nullable|date', // Ahora el campo es opcional
            'estado' => 'required|in:pendiente,completada',
            'prioridad' => 'required|in:alta,media,baja',
        ]);

        // Si la fecha límite está presente, la convertimos a Carbon
        $fecha_limite = $request->fecha_limite ? Carbon::parse($request->fecha_limite) : null;

        // Crear la tarea
        Tarea::create([
            'usuario_id' => auth()->id(),  // Se asegura de que se asigna el usuario autenticado
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_limite' => $fecha_limite, // Guardar la fecha con hora, o null si no hay
            'estado' => $request->estado,
            'prioridad' => $request->prioridad,
        ]);

        return redirect()->route('tareas.index')->with('success', 'Tarea creada correctamente.');
    }

    // Mostrar formulario para editar una tarea
    public function edit(Tarea $tarea)
    {
        // Verificar si el usuario autenticado es el propietario de la tarea
        if ($tarea->usuario_id != auth()->id()) {
            return redirect()->route('tareas.index')->with('error', 'No puedes editar esta tarea.');
        }

        return view('tareas.edit', compact('tarea'));
    }

    // Actualizar tarea
    public function update(Request $request, Tarea $tarea)
    {
        // Validación del formulario
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_limite' => 'nullable|date', // Fecha es opcional
            'estado' => 'required|in:pendiente,completada',
            'prioridad' => 'required|in:alta,media,baja',
        ]);

        // Si la fecha límite está presente, la convertimos a Carbon
        $fecha_limite = $request->fecha_limite ? Carbon::parse($request->fecha_limite) : null;

        // Actualizar la tarea
        $tarea->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_limite' => $fecha_limite, // Guardar la nueva fecha con hora, o null si no hay
            'estado' => $request->estado,
            'prioridad' => $request->prioridad,
        ]);

        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada correctamente.');
    }

    // Cambiar estado de la tarea
    public function cambiarEstado(Tarea $tarea)
    {
        // Alternar el estado de la tarea
        $nuevoEstado = $tarea->estado == 'pendiente' ? 'completada' : 'pendiente';
        $tarea->update(['estado' => $nuevoEstado]);

        return redirect()->route('tareas.index')->with('success', 'Estado de la tarea actualizado.');
    }

    // Eliminar tarea
    public function destroy(Tarea $tarea)
    {
        // Verificar si el usuario autenticado es el propietario de la tarea
        if ($tarea->usuario_id != auth()->id()) {
            return redirect()->route('tareas.index')->with('error', 'No puedes eliminar esta tarea.');
        }

        // Eliminar la tarea
        $tarea->delete();

        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada correctamente.');
    }
}
