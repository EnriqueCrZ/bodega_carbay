<?php

namespace App\Http\Controllers;

use App\Models\IngresoConsumido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //DB::enableQueryLog();
        $porOperacion = IngresoConsumido::join('ingreso','ingreso.idingreso','ingreso_consumido.ingreso_idingreso')
                                        ->join('consumo','consumo.idconsumo','ingreso_consumido.consumo_idconsumo')
                                        ->join('equipo','equipo.id','consumo.equipo_id')
                                        ->join('tipo_operacion','tipo_operacion.idtipo_operacion','equipo.tipo_operacion_idtipo_operacion')
                                        ->groupBy('tipo_operacion.operacion')
                                        ->select('ingreso_consumido.*','ingreso.costo_unitario','tipo_operacion.operacion',DB::raw('sum(ingreso_consumido.cantidad * costo_unitario) as total'))
                                        ->get();




        foreach($porOperacion as $po){
            $labels[] = $po->operacion;
            $data[] = $po->total;
        }




        return view('welcome',compact('labels','data','porOperacion'));
    }
}
