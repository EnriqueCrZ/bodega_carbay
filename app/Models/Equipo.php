<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table= 'equipo';
    public $timestamps = false;
    public $incrementing = false;


    protected $fillable = [
        'id','equipo','unidad','placa','tipo','ubicacion','tipo_operacion_idtipo_operacion'
    ];

    protected $primaryKey = 'id';
}
