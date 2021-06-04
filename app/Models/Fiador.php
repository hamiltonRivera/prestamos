<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fiador extends Model
{
    use HasFactory;
    protected $fillable = [
        'dni', 'nombres_apellidos', 'sexo', 'departamento', 'municipio', 'direccion',
        'telefono', 'email', 'fecha_nac', 'nivel_academico', 'profesion', 'estado_civil'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
