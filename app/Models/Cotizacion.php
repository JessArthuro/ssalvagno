<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $table = 'cotizaciones';

    protected $fillable = [
        'fecha',
        'num_cotizacion',
        'num_orden',
        'nombre',
        'empresa',
        'fecha_entrega',
        'hora_entrega',
        'lugar_entrega',
    ];
}
