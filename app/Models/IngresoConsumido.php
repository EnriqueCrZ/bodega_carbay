<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresoConsumido extends Model
{
    protected $table= 'ingreso_consumido';
    public $timestamps = false;
    public $incrementing = false;


    protected $fillable = [
        'idingreso_consumido','cantidad','consumo_idconsumo','ingreso_idingreso'
    ];

    protected $primaryKey = 'idingreso_consumido';
}
