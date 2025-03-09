<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaTareas extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade'); // Relación con la tabla users
            $table->string('titulo');
            $table->text('descripcion')->nullable(); // Descripción opcional
            $table->dateTime('fecha_limite')->nullable(); // Fecha límite opcional
            $table->enum('estado', ['pendiente', 'completada'])->default('pendiente'); // Estado de la tarea
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Revertir las migraciones.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas');
    }
}
