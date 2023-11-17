<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tercero;
use App\Models\Grupo;
use Illuminate\Support\Facades\Validator;

class EmpresaController extends Controller{
    public function __construct(){
        $this->middleware(['permission:Empresa leer|Empresa crear|Empresa editar|Empresa borrar']);
        $this->middleware('mina');
    }

    public function index(Request $request){
        $dato = Tercero::findOrFail(1);
        $terceros = Tercero::where('persona_id', 1)->pluck('nombre', 'id');
        $funcion = Grupo::findOrFail(4)->parametros()->orderBy('nombre')->pluck('nombre', 'id');
        return view('mina.empresa.empresa.index', compact('dato', 'terceros', 'funcion'));
    }

    public function listContact(Request $request, $id){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Tercero::findOrFail($id)->contactos()->select('terceros.id', 'terceros.nombre' , 'telefono', 'email', 'parametros.nombre as funcion', 'tercero_id')->join('parametros', 'funcion_id', '=', 'parametros.id'))
            ->addColumn('botones', 'mina/empresa/empresa/tablaBotonContacto')
            ->rawColumns(['botones'])
            ->toJson();
    }

    public function storeContact(Request $request, $id){
        $this->validatorContact($request->all())->validate();
        $dato = Tercero::findOrFail($id);
        $dato->contactos()->syncWithoutDetaching([$request->contacto_id => ['funcion_id' => $request->funcion_id]]);
        return redirect()->route('empresa', $dato->id)->with('info', 'Registro creado con éxito');
    }

    public function destroyContact(Request $request, $id, $id1){
        $dato = Tercero::findOrFail($id);
        $dato->contactos()->detach($id1);
        return redirect()->route('empresa', $id)->with('info', 'Registro actualizado con éxito');
    }

    protected function validatorContact(array $data){
        return Validator::make($data, [
            'contacto_id' => 'required|exists:terceros,id',
            'funcion_id' => 'required|exists:parametros,id',
        ]);
    }
}