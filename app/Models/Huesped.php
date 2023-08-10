<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Huesped extends Model
{
    use HasFactory;

    protected $table = 'huespedes';

    protected $fillable = ['nombre_h', 'desayunos', 'comidas', 'cenas', 'embarcacion_id'];

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'servicio_huesped');
    }
}
