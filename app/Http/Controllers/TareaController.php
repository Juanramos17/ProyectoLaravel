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

    // Mostrar el formulario para crear una nueva tarea
    public function create()
    {
        return view('tareas.create');
    }

    // Guardar una nueva tarea
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_limite' => 'nullable|date',
            'estado' => 'required|in:pendiente,completada',
        ]);

        Tarea::create([
            'usuario_id' => auth()->id(),
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_limite' => $request->fecha_limite,
            'estado' => $request->estado,
        ]);

        return redirect()->route('tareas.index');
    }

    // Mostrar el formulario para editar una tarea
    public function edit(Tarea $tarea)
    {
        // Verificar que la tarea pertenece al usuario autenticado
        if ($tarea->usuario_id != auth()->id()) {
            return redirect()->route('tareas.index');
        }

        return view('tareas.edit', compact('tarea'));
    }

    // Actualizar una tarea
    public function update(Request $request, Tarea $tarea)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_limite' => 'nullable|date',
            'estado' => 'required|in:pendiente,completada',
        ]);

        $tarea->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_limite' => $request->fecha_limite,
            'estado' => $request->estado,
        ]);

        return redirect()->route('tareas.index');
    }

    // Eliminar una tarea
    public function destroy(Tarea $tarea)
    {
        // Verificar que la tarea pertenece al usuario autenticado
        if ($tarea->usuario_id != auth()->id()) {
            return redirect()->route('tareas.index');
        }

        $tarea->delete();
        return redirect()->route('tareas.index');
    }
}
