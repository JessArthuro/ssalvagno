<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Huesped extends Model
{
    use HasFactory;

    protected $table = 'huespedes';

    protected $fillable = ['servicio_id', 'nombre', 'desayunos', 'comidas', 'cenas', 'embarcacion_id'];

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}
