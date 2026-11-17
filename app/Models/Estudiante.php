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
        'edad',
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
            'edad' => 'integer',
            'semestre' => 'integer',
        ];
    }
}
