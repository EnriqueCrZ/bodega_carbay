<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinador extends Model
{
    protected $table= 'coordinador';
    public $timestamps = false;
    public $incrementing = false;


    protected $fillable = [
        'idcoordinador','nombre_coordinador',
    ];

    protected $primaryKey = 'idcoordinador';
}
