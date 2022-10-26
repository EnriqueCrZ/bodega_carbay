<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoOperacion extends Model
{
    protected $table= 'tipo_operacion';
    public $timestamps = false;
    public $incrementing = false;


    protected $fillable = [
        'idtipo_operacion','operacion',
    ];

    protected $primaryKey = 'idtipo_operacion';
}
