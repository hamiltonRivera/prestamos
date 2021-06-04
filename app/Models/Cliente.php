<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = [
        'dni', 'nombres_apellidos', 'sexo', 'departamento', 'municipio', 'direccion',
        'telefono', 'email', 'fecha_nac', 'nivel_academico', 'profesion', 'estado_civil', 'imagen'
    ];

    public function contratos()
    {
        return $this->hasMany(Contrato::class);
    }

    public function pendientes()
    {
        return $this->hasManyThrough(Pendiente::class, Contrato::class);
    }

    public function fiadores()
    {
        return $this->hasMany(Fiador::class);
    }
}
