<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Route;

// Ruta de inicio
Route::get('/', function () {
    return view('welcome');
});

// Ruta de dashboard (solo accesible para usuarios autenticados y verificados)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas por autenticación (solo accesibles para usuarios logueados)
Route::middleware('auth')->group(function () {
    // Ruta para editar y actualizar el perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas para las tareas (CRUD), protegidas por el middleware auth
    Route::resource('tareas', TareaController::class);
});

// Cargar las rutas de autenticación (login, registro, etc.)
require __DIR__.'/auth.php';
