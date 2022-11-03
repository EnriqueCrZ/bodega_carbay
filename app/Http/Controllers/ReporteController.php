<?php

namespace App\Http\Controllers;

use App\Exports\ReporteGeneral;
use App\Models\IngresoConsumido;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){

        $query = trim($request->get('s'));


        $now = Carbon::now();
        $to = $request->to == null ? Carbon::create($now->isoFormat('YYYY'),$now->isoFormat('M'),$now->isoFormat('D')) :
                            Carbon::create($request->to);
        $from = $request->from ==null ? Carbon::create($now->isoFormat('YYYY'),$now->subMonth()->isoFormat('M'),$now->isoFormat('D')) :
                            Carbon::create($request->from);

        $reporte = IngresoConsumido::join('ingreso','ingreso.idingreso','ingreso_consumido.ingreso_idingreso')
                ->join('proveedor','proveedor.id_proveedor','ingreso.proveedor_id_proveedor')
                ->join('repuesto','repuesto.id_repuesto','ingreso.repuesto_id')
                ->join('consumo','consumo.idconsumo','ingreso_consumido.consumo_idconsumo')
                ->join('equipo','equipo.id','consumo.equipo_id')
                ->join('tipo_operacion','tipo_operacion.idtipo_operacion','equipo.tipo_operacion_idtipo_operacion')
                ->select('repuesto.id_repuesto as no_parte','repuesto.nombre as descripcion_parte','ingreso_consumido.cantidad','equipo.equipo','proveedor.nombre_proveedor as proveedor','proveedor.nit',
                         'ingreso.fecha_vale','ingreso.vale','ingreso.costo_unitario','ingreso.pagado as estado')
                ->whereBetween('ingreso.fecha_vale',[$from,$to])
                ->where(function($query_search) use ($query){
                           $query_search->where('repuesto.id_repuesto','LIKE','%'.$query.'%')
                                         ->orWhere('repuesto.nombre','LIKE','%'.$query.'%')
                                         ->orWhere('equipo','LIKE','%'.$query.'%')
                                         ->orWhere('proveedor.nombre_proveedor','LIKE','%'.$query.'%')
                                         ->orWhere('proveedor.nit','LIKE','%'.$query.'%')
                                         ->orWhere('ingreso.vale','LIKE','%'.$query.'%')
                                         ->orWhere('ingreso.pagado','LIKE','%'.$query.'%');
                         })
                ->get();


        return view('reporte.general',compact('reporte','query','to','from'));
    }

    public function reporteExcel($cryptedFrom,$cryptedTo,$query = null){
        $from = decrypt($cryptedFrom);
        $to = decrypt($cryptedTo);

        return Excel::download(new ReporteGeneral($from,$to,$query),'reporte_general_'.Carbon::now().'.xlsx');
    }
}
