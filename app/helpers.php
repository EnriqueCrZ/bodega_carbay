<?php

use App\Models\IngresoConsumido;

function validarConsumo($idConsumo){
    return count(IngresoConsumido::where('consumo_idconsumo',$idConsumo->idconsumo)->get())>0;
}
