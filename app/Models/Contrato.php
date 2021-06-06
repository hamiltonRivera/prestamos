<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha', 'numero', 'cliente_id', 'monto_prestamo', 'mto', 'monto_interes', 'monto_total',
        'garantia', 'cuotas', 'plazo', 'periodo', 'tasa', 'status'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function pendientes()
    {
        return $this->hasMany(Pendiente::class);
    }

    public function fiadores()
    {
        return $this->hasMany(Fiador::class);
    }
}
