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

    // Relacion muchos a muchos
    public function huespedes()
    {
        return $this->belongsToMany(Huesped::class, 'servicio_huesped');
    }

    public function getServicioAttribute($value)
    {
        $ids = unserialize($value);
        $alimentos = Alimento::whereIn('id', $ids)->pluck('nombre')->all();
        return $alimentos;
    }
}
