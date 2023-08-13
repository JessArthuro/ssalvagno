<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $table = 'cotizaciones';

    protected $fillable = [
        'fecha_cot', 'num_cotizacion', 'num_orden', 'nombre', 'empresa_id', 'fecha_ent', 'hora_ent', 'fecha_sal', 'lugar_ent',
    ];

    public function generateFolio()
    {
        $currentYear = date('Y');
        $lastFolio = self::max('num_cotizacion');

        if ($lastFolio) {
            // Extraer el numero de cotizacion del ultimo registro
            $lastQuoteNumber = explode('-', $lastFolio)[0];
            $newQuoteNumber = intval($lastQuoteNumber) + 1;
        } else {
            // No hay numeros de cotizacion existentes, iniciar en la 215
            $newQuoteNumber = 225;
        }

        return $newQuoteNumber . '-' . $currentYear;
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }
}
