<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table= 'proveedor';
    public $timestamps = false;
    public $incrementing = false;


    protected $fillable = [
        'id_proveedor','nit','nombre_proveedor','observacion'
    ];

    protected $primaryKey = 'id_proveedor';
}
