<?php

namespace App\Http\Controllers;

use App\Models\IngresoConsumido;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
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
        $now = Carbon::now();
        $from = Carbon::create($now->isoFormat('YYYY'),$now->subMonth()->isoFormat('M'),20);
        $to = Carbon::create($now->isoFormat('YYYY'),$now->addMonth()->isoFormat('M'),20);


        //DB::enableQueryLog();
        $porOperacion = IngresoConsumido::join('ingreso','ingreso.idingreso','ingreso_consumido.ingreso_idingreso')
                                        ->join('consumo','consumo.idconsumo','ingreso_consumido.consumo_idconsumo')
                                        ->join('equipo','equipo.id','consumo.equipo_id')
                                        ->join('tipo_operacion','tipo_operacion.idtipo_operacion','equipo.tipo_operacion_idtipo_operacion')
                                        ->groupBy('tipo_operacion.operacion')
                                        ->select('ingreso_consumido.*','ingreso.costo_unitario','tipo_operacion.operacion',DB::raw('sum(ingreso_consumido.cantidad * costo_unitario) as total'), 'consumo.fecha as fecha_consumo')
                                        ->whereBetween('consumo.fecha',[$from,$to])
                                        ->get();

        $porEquipo = IngresoConsumido::join('ingreso','ingreso.idingreso','ingreso_consumido.ingreso_idingreso')
                                    ->join('consumo','consumo.idconsumo','ingreso_consumido.consumo_idconsumo')
                                    ->join('equipo','equipo.id','consumo.equipo_id')
                                    ->join('tipo_operacion','tipo_operacion.idtipo_operacion','equipo.tipo_operacion_idtipo_operacion')
                                    ->groupBy('equipo.equipo')
                                    ->select('equipo.*','ingreso.costo_unitario','tipo_operacion.operacion',DB::raw('sum(ingreso_consumido.cantidad * costo_unitario) as total'),'consumo.fecha as fecha_consumo')
                                    ->whereBetween('consumo.fecha',[$from,$to])
                                    ->orderBy('total','desc')
                                    ->get();


 //Repuesto m??s pedido


        foreach($porOperacion as $po){
            $porOperacionLabels[] = $po->operacion;
            $porOperacionFecha[] = Carbon::create($po->fecha_consumo)->isoFormat('MMMM');
            $porOperacionData[] = $po->total;
        }


        //dd($porOperacionLabels,$porOperacionData,$porOperacionFecha);

        return view('welcome',compact('porOperacionLabels','porOperacionData','porOperacionFecha','porEquipo'));
    }
}
