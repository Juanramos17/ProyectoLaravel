<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'usuario_id',
        'titulo',
        'descripcion',
        'fecha_limite',
        'estado',
        'prioridad',
    ];

    // Relación con el usuario (cada tarea pertenece a un usuario)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
