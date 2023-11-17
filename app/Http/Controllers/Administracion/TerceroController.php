<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tercero;
use App\Models\Grupo;
use Illuminate\Support\Facades\Validator;

class TerceroController extends Controller{
    public function __construct(){
        $this->middleware(['permission:Tercero leer|Tercero crear|Tercero editar|Tercero borrar']);
        $this->middleware('mina');
    }

    public function index(Request $request){
        return view('mina.administracion.tercero.index');
    }

    public function list(Request $request){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Tercero::select('id', 'nombre', 'telefono', 'email'))
            ->addColumn('botones', 'mina/administracion/tercero/tablaBoton')
            ->rawColumns(['botones'])
            ->toJson();
    }

    public function create(){
        $persona = Grupo::findOrFail(1)->parametros()->orderBy('nombre')->pluck('nombre', 'id');
        $natural = Grupo::findOrFail(2)->parametros()->orderBy('nombre')->pluck('nombre', 'id');
        $juridica = Grupo::findOrFail(3)->parametros()->orderBy('nombre')->pluck('nombre', 'id');
        return view('mina.administracion.tercero.index', ['accion' => 'Nuevo'], compact('persona', 'natural', 'juridica'));
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        Tercero::create($request->all());
        return redirect()->route('tercero')->with('info', 'Registro creado con éxito');
    }

    public function edit($id){
        $dato = Tercero::findOrFail($id);
        $persona = Grupo::findOrFail(1)->parametros()->orderBy('nombre')->pluck('nombre', 'id');
        $natural = Grupo::findOrFail(2)->parametros()->orderBy('nombre')->pluck('nombre', 'id');
        $juridica = Grupo::findOrFail(3)->parametros()->orderBy('nombre')->pluck('nombre', 'id');
        return view('mina.administracion.tercero.index', ['accion' => 'Editar'], compact('dato', 'persona', 'natural', 'juridica'));
    }

    public function update(Request $request, $id){
        $this->validatorUpdate($request->all(), $id)->validate();
        $dato = Tercero::findOrFail($id);
        $dato->fill($request->all())->save();
        return redirect()->route('tercero')->with('info', 'Registro actualizado con éxito');
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'persona_id' => 'required|exists:parametros,id',
            'documento_id' => 'required|exists:parametros,id',
            'documento' => 'required|string|min:1',
            'documento' => 'unique:terceros,documento,null,id,documento_id,'.$data['documento_id'],
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);
    }

    protected function validatorUpdate(array $data, $id){
        return Validator::make($data, [
            'persona_id' => 'required|exists:parametros,id',
            'documento_id' => 'required|exists:parametros,id',
            'documento' => 'required|string|min:1',
            'documento' => 'unique:terceros,documento,'.$id.',id,documento_id,'.$data['documento_id'],
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);
    }
}