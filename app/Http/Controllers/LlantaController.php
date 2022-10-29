<?php

namespace App\Http\Controllers;

use App\Models\Coordinador;
use App\Models\Equipo;
use App\Models\Llanta;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LlantaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $llantas = Llanta::join('equipo','equipo.id','llanta.equipo_id')
                    ->join('coordinador','coordinador.idcoordinador','llanta.coordinador_idcoordinador')
                    ->join('proveedor','proveedor.id_proveedor','llanta.proveedor_id_proveedor')
                    ->select('llanta.*','equipo.equipo','equipo.id as codigo_equipo','proveedor.nombre_proveedor','coordinador.nombre_coordinador')
                    ->get();

        return view('llanta.llanta',compact('llantas'));
    }

    public function create(){
        $equipos = Equipo::all();
        $coordinadores = Coordinador::all();
        $proveedores = Proveedor::all();
        return view('llanta.create',compact('equipos','coordinadores','proveedores'));
    }

    public function save(Request $request){
        $validator = Validator::make($request->all(),[
            'no_ot_vale' => 'required|unique:llanta',
            'cantidad' => 'required|integer',
            'descripcion_quemado' => 'required|max:100',
            'costo_unitario'=> 'required',
            'costo_total' => 'required',
            'fecha'=>'required',
            'marca'=>'required|max:45',
            'movimiento'=>'required|max:45',
            'operacion'=>'required|max:45',
            'vale'=>'required|max:20',
            'proveedor'=>'required',
            'coordinador'=>'required',
            'equipo'=>'required',
        ]);

        if($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }


        $llanta = new Llanta();
        $llanta->no_ot_vale = $request->no_ot_vale;
        $llanta->kilometraje = $request->kilometraje ?? 0;
        $llanta->cantidad = $request->cantidad;
        $llanta->descripcion_quemado = strtoupper($request->descripcion_quemado);
        $llanta->costo_unitario = $request->costo_unitario;
        $llanta->costo_total = $request->costo_total;
        $llanta->fecha_instalacion = date('Y-m-d',strtotime($request->fecha));
        $llanta->marca = strtoupper($request->marca);
        $llanta->movimiento = strtoupper($request->movimiento);
        $llanta->operacion = strtoupper($request->operacion);
        $llanta->vale = $request->vale;
        $llanta->proveedor_id_proveedor = $request->proveedor;
        $llanta->coordinador_idcoordinador = $request->coordinador;
        $llanta->equipo_id = $request->equipo;
        $llanta->save();


        return redirect()->route('llanta')->with('status','Registro agregado.');
    }

    public function edit($id){
        $llanta = Llanta::find($id);
        $equipos = Equipo::all();
        $coordinadores = Coordinador::all();
        $proveedores = Proveedor::all();

        return view('llanta.edit',compact('llanta','equipos','coordinadores','proveedores'));
    }

    public function update(Request $request,$id){
        $llanta = Llanta::find($id);

        $llanta->kilometraje = $request->kilometraje ?? 0;
        $llanta->cantidad = $request->cantidad;
        $llanta->descripcion_quemado = strtoupper($request->descripcion_quemado);
        $llanta->costo_unitario = $request->costo_unitario;
        $llanta->costo_total = $request->costo_total;
        $llanta->fecha_instalacion = date('Y-m-d',strtotime($request->fecha));
        $llanta->marca = strtoupper($request->marca);
        $llanta->movimiento = strtoupper($request->movimiento);
        $llanta->operacion = strtoupper($request->operacion);
        $llanta->vale = $request->vale;
        $llanta->proveedor_id_proveedor = $request->proveedor;
        $llanta->coordinador_idcoordinador = $request->coordinador;
        $llanta->equipo_id = $request->equipo;
        $llanta->save();

        return redirect()->route('llanta')->with('status','Registro actualizado.');
    }

    public function destroy(Request $request){

    }
}
