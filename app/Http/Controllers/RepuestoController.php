<?php

namespace App\Http\Controllers;

use App\Models\Repuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RepuestoController extends Controller
{
    public function __construct()
    {

    }

    public function index(){
        $repuestos = Repuesto::all();


        return view('repuesto.repuesto',compact('repuestos'));
    }

    public function create(){
        return view('repuesto.create');
    }

    public function save(Request $request){
        $validator = Validator::make($request->all(),[
            'item' => 'required|string|max:5',
            'nombre' => 'required|string|max:75',
            'ubicacion_bodega' => 'max:10',
        ]);

        if($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $repuesto = new Repuesto();
        $repuesto->item = strtoupper($request->item);
        $repuesto->nombre = strtoupper($request->nombre);
        $repuesto->ubicacion_bodega = strtoupper($request->ubicacion_bodega ?? 'no');
        $repuesto->save();


        return redirect()->route('repuesto')->with('status','Repuesto agregado.');
    }

    public function edit($id){
        $id = decrypt($id);
        $repuesto = Repuesto::find($id);


        return view('repuesto.edit',compact('repuesto'));
    }

    public function update(Request $request,$id){
        $id = decrypt($id);
        $repuesto = Repuesto::find($id);

        $repuesto->item = $id;
        $repuesto->nombre = strtoupper($request->nombre);
        $repuesto->ubicacion_bodega = strtoupper($request->ubicacion_bodega ?? 'no');
        $repuesto->save();

        return redirect()->route('repuesto')->with('status','Repuesto actualizado.');
    }

    public function destroy(Request $request){

    }
}
