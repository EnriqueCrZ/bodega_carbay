<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use App\Models\Proveedor;
use App\Models\Repuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IngresoController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request){
        $ingresos = Ingreso::join('proveedor','proveedor.id_proveedor','ingreso.proveedor_id_proveedor')
                    ->join('repuesto','repuesto.id_repuesto','ingreso.repuesto_id')
                    ->select('ingreso.*','proveedor.nit as nit_proveedor','proveedor.nombre_proveedor as nombre_proveedor','repuesto.item as item_repuesto','repuesto.nombre as nombre_repuesto')
                    ->get();


        return view('ingreso.ingreso',compact('ingresos'));
    }

    public function create(){
        $repuestos = Repuesto::all();
        $proveedores = Proveedor::all();

        return view('ingreso.create',compact('repuestos','proveedores'));
    }

    public function save(Request $request){
        $validator = Validator::make($request->all(),[
            'fecha_vale' => 'required',
            'vale' => 'required|string|max:20',
            'cantidad' => 'required',
            'costo_unitario' => 'required',
            'costo_total' => 'required',
            'repuesto'=>'required',
            'proveedor'=>'required'
        ]);

        if($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }


        $ingreso = new Ingreso();
        $ingreso->fecha = date('Y-m-d H:i:s');
        $ingreso->fecha_vale = date('Y-m-d',strtotime($request->fecha_vale));
        $ingreso->vale = strtoupper($request->vale);
        $ingreso->costo_unitario = $request->costo_unitario;
        $ingreso->costo_total = $request->costo_total;
        $ingreso->cantidad = $request->cantidad;
        $ingreso->repuesto_id = $request->repuesto;
        $ingreso->proveedor_id_proveedor = $request->proveedor;
        $ingreso->save();


        return redirect()->route('ingreso')->with('status','Ingresado.');
    }

    public function edit($id){
        $ingreso = Ingreso::find($id);
        $repuestos = Repuesto::all();
        $proveedores = Proveedor::all();


        return view('ingreso.edit',compact('ingreso','repuestos','proveedores'));
    }

    public function update(Request $request,$id){
        $ingreso = Ingreso::find($id);

        $ingreso->fecha_vale = date('Y-m-d',strtotime($request->fecha_vale));
        $ingreso->vale = strtoupper($request->vale);
        $ingreso->costo_unitario = $request->costo_unitario;
        $ingreso->costo_total = $request->costo_total;
        $ingreso->cantidad = $request->cantidad;
        $ingreso->repuesto_id = $request->repuesto;
        $ingreso->proveedor_id_proveedor = $request->proveedor;
        $ingreso->save();

        return redirect()->route('ingreso')->with('status','Ingreso actualizado.');
    }

    public function destroy(Request $request){

    }
}
