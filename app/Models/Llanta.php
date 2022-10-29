<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Llanta extends Model
{
    protected $table= 'llanta';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'no_ot_vale','kilometraje','cantidad','descripcion_quemado','costo_unitario','costo_total','fecha_instalacion',
        'marca','movimiento','operacion','vale','equipo_id','proveedor_idproveedor','coordinador_idcoordinador',
    ];

    protected $primaryKey = 'no_ot_vale';
}
