<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendiente extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha_contrato', 'contrato_id', 'fecha_cuota', 'monto', 'status'
    ];

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }
}
