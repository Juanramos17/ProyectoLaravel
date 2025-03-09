<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

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
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_limite' => 'nullable|date',
            'estado' => 'required|in:pendiente,completada',
            'prioridad' => 'required|in:alta,media,baja',
        ]);

        Tarea::create([
            'usuario_id' => auth()->id(),
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_limite' => $request->fecha_limite,
            'estado' => $request->estado,
            'prioridad' => $request->prioridad,
        ]);

        return redirect()->route('tareas.index')->with('success', 'Tarea creada correctamente.');
    }

    // Mostrar formulario para editar una tarea
    public function edit(Tarea $tarea)
    {
        if ($tarea->usuario_id != auth()->id()) {
            return redirect()->route('tareas.index')->with('error', 'No puedes editar esta tarea.');
        }

        return view('tareas.edit', compact('tarea'));
    }

    // Actualizar tarea
    public function update(Request $request, Tarea $tarea)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_limite' => 'nullable|date',
            'estado' => 'required|in:pendiente,completada',
            'prioridad' => 'required|in:alta,media,baja',
        ]);

        $tarea->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_limite' => $request->fecha_limite,
            'estado' => $request->estado,
            'prioridad' => $request->prioridad,
        ]);

        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada correctamente.');
    }

    // Cambiar estado de la tarea
    public function cambiarEstado(Tarea $tarea)
    {
        $nuevoEstado = $tarea->estado == 'pendiente' ? 'completada' : 'pendiente';
        $tarea->update(['estado' => $nuevoEstado]);

        return redirect()->route('tareas.index');
    }

    // Eliminar tarea
    public function destroy(Tarea $tarea)
    {
        if ($tarea->usuario_id != auth()->id()) {
            return redirect()->route('tareas.index');
        }

        $tarea->delete();

        return redirect()->route('tareas.index');
    }
}
