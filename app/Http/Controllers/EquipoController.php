<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\TipoOperacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EquipoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $equipos = Equipo::join('tipo_operacion','tipo_operacion.idtipo_operacion','equipo.tipo_operacion_idtipo_operacion')
            ->select('equipo.*','tipo_operacion.operacion as tipo_operacion')
            ->get();


        return view('equipo.equipo',compact('equipos'));
    }

    public function create(){
        $tipoOperacion = TipoOperacion::all();
        return view('equipo.create',compact('tipoOperacion'));
    }

    public function save(Request $request){
        $validator = Validator::make($request->all(),[
            'id' => 'required|string|max:5',
            'equipo' => 'required|string|max:40',
            'unidad' => 'required|string|max:10',
            'placa' => 'required|string|max:10',
            'tipo' => 'required|string|max:40',
            'ubicacion' => 'required|string|max:13',
            'tipo_operacion' => 'required|max:5',
        ]);

        if($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $equipo = new Equipo();
        $equipo->id = strtoupper($request->id);
        $equipo->equipo = strtoupper($request->equipo);
        $equipo->unidad = strtoupper($request->unidad);
        $equipo->placa = strtoupper($request->placa);
        $equipo->tipo = strtoupper($request->tipo);
        $equipo->ubicacion = strtoupper($request->ubicacion);
        $equipo->tipo_operacion_idtipo_operacion = $request->tipo_operacion;
        $equipo->save();


        return redirect()->route('equipo')->with('status','Equipo agregado.');
    }

    public function edit($id){
        $equipo = Equipo::find($id);
        $tipoOperacion = TipoOperacion::all();

        return view('equipo.edit',compact('equipo','tipoOperacion'));
    }

    public function update(Request $request,$id){
        $equipo = Equipo::find($id);

        $equipo->id = $id;
        $equipo->equipo = $request->equipo;
        $equipo->unidad = $request->unidad;
        $equipo->placa = $request->placa;
        $equipo->tipo = $request->tipo;
        $equipo->ubicacion = $request->ubicacion;
        $equipo->tipo_operacion_idtipo_operacion = $request->tipo_operacion;
        $equipo->save();

        return redirect()->route('equipo')->with('status','Equipo actualizado.');
    }

    public function destroy(Request $request){

    }
}
