<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $table = 'tb_entrada';

    protected $fillable = [
        'codigo',
        'nombre',
        'apellidos',
        'telefono',
        'correo',
        'servicio',
        'estado',
        'created_at',
        'updated_at'
    ];
}
