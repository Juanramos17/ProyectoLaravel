<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

// Ruta de dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas de tareas protegidas por autenticación
Route::middleware('auth')->group(function () {
    // Rutas para gestionar las tareas
    Route::resource('tareas', TareaController::class);
    
    // Ruta para cambiar el estado de la tarea
    Route::post('tareas/{tarea}/estado', [TareaController::class, 'cambiarEstado'])->name('tareas.cambiarEstado');
    
    // Rutas de perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Autenticación
require __DIR__.'/auth.php';
