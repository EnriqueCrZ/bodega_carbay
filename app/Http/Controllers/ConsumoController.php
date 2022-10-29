<?php

namespace App\Http\Controllers;

use App\Models\Consumo;
use App\Models\Equipo;
use App\Models\Ingreso;
use App\Models\IngresoConsumido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConsumoController extends Controller
{
    public function __construct()
    {

    }

    public function index(){
        $consumos = Consumo::join('equipo','equipo.id','consumo.equipo_id')
                    ->select('consumo.*','equipo.equipo','equipo.id as codigo_equipo')
                    ->get();

        return view('consumo.consumo',compact('consumos'));
    }

    public function create(){
        $equipos = Equipo::all();
        return view('consumo.create',compact('equipos'));
    }

    public function save(Request $request){
        $validator = Validator::make($request->all(),[
            'fecha' => 'required',
            'orden' => 'required|integer',
            'cantidad_devuelto' => 'nullable',
            'cantidad_chatarra' => 'nullable',
            'equipo'=> 'required'
        ]);

        if($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }


        $consumo = new Consumo();
        $consumo->fecha = date('Y-m-d',strtotime($request->fecha));
        $consumo->orden_trabajo = $request->orden;
        $consumo->cantidad_devuelto = $request->cantidad_devuelto ?? null;
        $consumo->cantidad_chatarra = $request->cantidad_chatarra ?? null;
        $consumo->equipo_id = $request->equipo;
        $consumo->save();


        return redirect()->route('consumo')->with('status','Consumo agregado.');
    }

    public function edit($id){
        $consumo = Consumo::find($id);
        $equipos = Equipo::all();

        return view('consumo.edit',compact('consumo','equipos'));
    }

    public function update(Request $request,$id){
        $consumo = Consumo::find($id);

        $consumo->fecha = date('Y-m-d',strtotime($request->fecha));
        $consumo->orden_trabajo = $request->orden;
        $consumo->cantidad_devuelto = $request->cantidad_devuelto ?? null;
        $consumo->cantidad_chatarra = $request->cantidad_chatarra ?? null;
        $consumo->equipo_id = $request->equipo;
        $consumo->save();

        return redirect()->route('consumo')->with('status','Consumo actualizado.');
    }

    public function destroy(Request $request){

    }

    public function consumir($id){
        $consumo = Consumo::find($id);

        $ingresosValeConsumido = Ingreso::rightJoin('ingreso_consumido','ingreso_consumido.ingreso_idingreso','ingreso.idingreso')
                                    ->whereNotNull('ingreso_consumido.ingreso_idingreso')
                                    ->select('ingreso.*')
                                    ->groupBy('ingreso.vale')
                                    ->get();
        return view('consumo.consumir_ingreso',compact('consumo','ingresosValeConsumido'));

    }

    public function returnValeSinConsumir(){
        $ingresosValeSinConsumir = Ingreso::leftJoin('ingreso_consumido','ingreso_consumido.ingreso_idingreso','ingreso.idingreso')
                                    ->whereNull('ingreso_consumido.ingreso_idingreso')
                                    ->select('ingreso.*')
                                    ->groupBy('ingreso.vale')
                                    ->get();

        foreach($ingresosValeSinConsumir as $key => $iv){
            $valeConsumido = Ingreso::join('ingreso_consumido','ingreso_consumido.ingreso_idingreso','ingreso.idingreso')
                                    ->where('ingreso.vale',$iv->vale)
                                    ->get();

            if(count($valeConsumido)>0){
                $ingresosValeSinConsumir->forget($key);
            }
        }
        return view('consumo.vale.vale_sin_consumir',compact('ingresosValeSinConsumir'));
    }

    public function returnValeConsumido(){
        $ingresos = Ingreso::leftJoin('ingreso_consumido','ingreso_consumido.ingreso_idingreso','ingreso.idingreso')
                            ->whereNull('ingreso_consumido.ingreso_idingreso')
                            ->select('ingreso.*')
                            ->get();


        return view('consumo.vale.vale_consumido',compact('ingresos'));
    }


    public function guardarConsumo(Request $request,$id){
        if($request->tipoVale == 'sinConsumir'){
            $ingresos = Ingreso::where('vale',$request->vale)->get();
            foreach($ingresos as $i){
                $ingresoConsumido = new IngresoConsumido();
                $ingresoConsumido->cantidad = $i->cantidad;
                $ingresoConsumido->consumo_idconsumo = $id;
                $ingresoConsumido->ingreso_idingreso = $i->idingreso;
                $ingresoConsumido->save();
            }
        } else{
            $ingresoConsumido = new IngresoConsumido();
            $ingresoConsumido->cantidad = $request->cantidad;
            $ingresoConsumido->consumo_idconsumo = $id;
            $ingresoConsumido->ingreso_idingreso = $request->vale;
            $ingresoConsumido->save();
        }
        return redirect()->route('consumo')->with('status','Consumido.');

    }

    public function detallesConsumo(Request $request){
        $id = $request->id;
        $total = 0;

        $ingresosConsumidos = IngresoConsumido::join('ingreso','ingreso.idingreso','ingreso_consumido.ingreso_idingreso')
                            ->join('repuesto','repuesto.id_repuesto','ingreso.repuesto_id')
                            ->where('consumo_idconsumo',$id)
                            ->select('ingreso_consumido.*','repuesto.nombre as repuesto','ingreso.costo_unitario as costo_unitario')
                            ->get();
        foreach($ingresosConsumidos as $key => $ic){
            $data[$key]['Cantidad'] = $ic->cantidad;
            $data[$key]['Repuesto'] = $ic->repuesto;
            $data[$key]['Costo Unitario'] = $ic->costo_unitario;
            $data[$key]['Costo Total'] = $ic->cantidad * $ic->costo_unitario;
        }

        foreach($data as $key => $d){
            $total += $d['Costo Total'];
        }

        return view('consumo.modalDetalles.modal',compact('data','total'));
    }
}
