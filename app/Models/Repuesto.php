<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repuesto extends Model
{
    protected $table= 'repuesto';
    public $timestamps = false;


    protected $fillable = [
        'item','nombre','foto','ubicacion_bodega'
    ];

    protected $primaryKey = 'item';
}
