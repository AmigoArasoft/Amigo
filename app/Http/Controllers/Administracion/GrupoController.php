<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Grupo;
use App\Models\Parametro;
use Illuminate\Support\Facades\Validator;

class GrupoController extends Controller{
    public function __construct(){
        $this->middleware(['permission:Grupo leer|Grupo crear|Grupo editar|Grupo borrar']);
        $this->middleware('mina');
    }

    public function index(Request $request){
        return view('mina.administracion.grupo.index');
    }

    public function list(Request $request){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Grupo::select('id', 'nombre')
            ->with(['parametros' => function ($query) {
                $query->select('nombre')->orderBy('id');
            }]))
            ->addColumn('botones', 'mina/administracion/grupo/tablaBoton')
            ->addColumn('parametros', 'mina/administracion/grupo/tablaParametro')
            ->rawColumns(['botones', 'parametros'])
            ->toJson();
    }

    public function listParametro(Request $request, $id){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Parametro::select('id', 'nombre'))
            ->addColumn('tema', $id)
            ->addColumn('botones', 'mina/administracion/grupo/tablaUnoBoton')
            ->rawColumns(['botones'])
            ->toJson();
    }

    public function create(){
        return view('mina.administracion.grupo.index', ['accion' => 'Nuevo']);
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        $dato = Grupo::create($request->all());
        return redirect()->route('grupo.editar', $dato->id)->with('info', 'Registro creado con éxito');
    }

    public function edit($id){
        $dato = Grupo::findOrFail($id);
        return view('mina.administracion.grupo.index', ['accion' => 'Editar'], compact('dato'));
    }

    public function update(Request $request, $id){
        $this->validatorUpdate($request->all(), $id)->validate();
        $dato = Grupo::findOrFail($id);
        $dato->fill($request->all())->save();
        return redirect()->route('grupo')->with('info', 'Registro actualizado con éxito');
    }

    public function updateParametro(Request $request, $id, $id0){
        $dato = Grupo::findOrFail($id);
        $dato->parametros()->syncWithoutDetaching($id0);
        return redirect()->route('grupo.editar', $id)->with('info', 'Parámetro agregado con éxito');
    }

    public function destroyParametro(Request $request, $id, $id0){
        $dato = Grupo::findOrFail($id);
        $dato->parametros()->detach($id0);
        return redirect()->route('grupo.editar', $id)->with('info', 'Parámetro Eliminado con éxito');
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'nombre' => 'required|string|max:255|unique:grupos',
        ]);
    }

    protected function validatorUpdate(array $data, $id){
        return Validator::make($data, [
            'nombre' => 'required|string|max:255|unique:grupos,nombre,'.$id,
        ]);
    }
}