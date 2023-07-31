<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'cotizacion_id', 'alimentos_ids', 'fecha_serv', 'cantidad', 'precio_unitario', 'total', 'costo_envio'
    ];

    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }

    public function embarcacion()
    {
        return $this->belongsTo(Embarcacion::class);
    }

    public function huespedes()
    {
        return $this->hasMany(Huesped::class);
    }

    public function getServicioAttribute($value)
    {
        $ids = unserialize($value);
        $alimentos = Alimento::whereIn('id', $ids)->pluck('nombre')->all();
        return $alimentos;
    }
}
