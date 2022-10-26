<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProveedorController extends Controller
{
    public function __construct()
    {

    }

    public function index(){
        $proveedores = Proveedor::paginate(20);

        return view('proveedor.proveedor',compact('proveedores'));
    }

    public function create(){
        return view('proveedor.create');
    }

    public function save(Request $request){
        $validator = Validator::make($request->all(),[
            'id_proveedor' => 'required|string|max:10',
            'nombre_proveedor' => 'required|string|max:75',
            'nit' => 'required|string|max:20',
            'observacion' => 'max:90',
        ]);

        if($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $proveedor = new Proveedor();
        $proveedor->id_proveedor = $request->id_proveedor;
        $proveedor->nit = $request->nit;
        $proveedor->nombre_proveedor = $request->nombre_proveedor;
        $proveedor->observacion = $request->observacion;
        $proveedor->save();


        return redirect()->route('proveedor')->with('status','Proveedor agregado.');
    }

    public function edit($id){
        $proveedor = Proveedor::find($id);

        return view('proveedor.edit',compact('proveedor'));
    }

    public function update(Request $request,$id){
        return redirect()->route('proveedor')->with('status','Proveedor actualizado.');
    }

    public function destroy(Request $request){

    }
}
