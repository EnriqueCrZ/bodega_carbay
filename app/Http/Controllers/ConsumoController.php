<?php

namespace App\Http\Controllers;

use App\Models\Consumo;
use App\Models\Equipo;
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
}
