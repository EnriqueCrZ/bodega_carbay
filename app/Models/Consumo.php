<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumo extends Model
{
    protected $table= 'consumo';
    public $timestamps = false;


    protected $fillable = [
        'idconsumo','fecha','orden_trabajo','cantidad_devuelto','cantidad_chatarra',
    ];

    protected $primaryKey = 'idconsumo';
}