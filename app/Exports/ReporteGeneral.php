<?php

namespace App\Exports;

use App\Models\IngresoConsumido;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReporteGeneral implements FromView{

    private $from;
    private $to;
    private $query;

    public function __construct($from,$to,$query)
    {
        $this->from = $from;
        $this->to = $to;
        $this->query = $query;
    }

    public function view(): View{
        $parametro = $this->query;

        // no parte, descripcion, equipo, proveedor, nit, vale, estado

        $reporte = IngresoConsumido::join('ingreso','ingreso.idingreso','ingreso_consumido.ingreso_idingreso')
                ->join('proveedor','proveedor.id_proveedor','ingreso.proveedor_id_proveedor')
                ->join('repuesto','repuesto.id_repuesto','ingreso.repuesto_id')
                ->join('consumo','consumo.idconsumo','ingreso_consumido.consumo_idconsumo')
                ->join('equipo','equipo.id','consumo.equipo_id')
                ->join('tipo_operacion','tipo_operacion.idtipo_operacion','equipo.tipo_operacion_idtipo_operacion')
                ->select('repuesto.id_repuesto as no_parte','repuesto.nombre as descripcion_parte','ingreso_consumido.cantidad','equipo.equipo','proveedor.nombre_proveedor as proveedor','proveedor.nit',
                         'ingreso.fecha_vale','ingreso.vale','ingreso.costo_unitario','ingreso.pagado as estado')
                ->whereBetween('ingreso.fecha_vale',[$this->from,$this->to])
                ->where(function($query_search) use ($parametro){
                    $query_search->where('repuesto.id_repuesto','LIKE','%'.$parametro.'%')
                                ->orWhere('repuesto.nombre','LIKE','%'.$parametro.'%')
                                ->orWhere('equipo','LIKE','%'.$parametro.'%')
                                ->orWhere('proveedor.nombre_proveedor','LIKE','%'.$parametro.'%')
                                ->orWhere('proveedor.nit','LIKE','%'.$parametro.'%')
                                ->orWhere('ingreso.vale','LIKE','%'.$parametro.'%')
                                ->orWhere('ingreso.pagado','LIKE','%'.$parametro.'%');
                })
                ->get();


        return view('reporte.excel.general',compact('reporte'));
    }
}
