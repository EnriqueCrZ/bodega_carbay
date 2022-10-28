<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table= 'ingreso';
    public $timestamps = false;
    public $incrementing = false;


    protected $fillable = [
        'idingreso','fecha','fecha_vale','vale','costo_unitario','costo_total','cantidad','pagado',
        'repuesto_id','proveedor_idproveedor'
    ];

    protected $primaryKey = 'idingreso';
}
