<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'cotizacion_id', 'servicio', 'fecha_serv', 'huesped', 'cantidad', 'precio_unitario', 'total'
    ];

    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }

    public function getServicioAttribute($value)
    {
        $ids = unserialize($value);
        $alimentos = Alimento::whereIn('id', $ids)->pluck('nombre')->all();
        return $alimentos;
    }
}
