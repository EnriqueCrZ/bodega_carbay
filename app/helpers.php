<?php

use App\Models\Ingreso;
use App\Models\IngresoConsumido;
use App\Models\Repuesto;

function validarConsumo($idConsumo){
    return count(IngresoConsumido::where('consumo_idconsumo',$idConsumo->idconsumo)->get())>0;
}

function returnRepuesto($id){
    return Repuesto::where('id_repuesto',$id)->value('nombre');
}
