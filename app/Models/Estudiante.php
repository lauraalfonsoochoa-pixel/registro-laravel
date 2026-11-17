<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiantes';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'codigo',
        'programa',
        'semestre',
        'correo',
        'telefono',
        'direccion',
    ];

    protected function casts(): array
    {
        return [
            'fecha_nacimiento' => 'date',
            'semestre' => 'integer',
        ];
    }
}
