<?php

namespace App\Http\Controllers;

use App\Models\Consumo;
use Illuminate\Http\Request;

class ConsumoController extends Controller
{
    public function __construct()
    {

    }

    public function index(){
        $consumos = Consumo::paginate(20);


    }
}
