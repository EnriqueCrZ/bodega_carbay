<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Llanta extends Model
{
    protected $table= 'llanta';
    public $timestamps = false;


    protected $fillable = [
        'no_ot_vale','kilometraje','cantidad','descripcion_quemado','costo_unitario','costo_total','fecha_instalacion',
        'coordinador','marca','movimiento','operacion','equipo_id','proveedor_idproveedor','coordinador_idcoordinador',
        'ingreso_idingreso'
    ];

    protected $primaryKey = 'no_ot_vale';
}
