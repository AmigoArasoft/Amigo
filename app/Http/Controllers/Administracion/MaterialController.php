<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Material;
use App\Models\Parametro;
use App\Models\Grupo;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller{
    public function __construct(){
        $this->middleware(['permission:Material leer|Material crear|Material editar|Material borrar']);
        $this->middleware('mina');
    }

    public function index(Request $request){
        return view('mina.administracion.material.index');
    }

    public function list(Request $request){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Material::select('id', 'nombre')
            ->with(['submateriales' => function ($query) {
                $query->select('nombre')->orderBy('id');
            }]))
            ->addColumn('botones', 'mina/administracion/material/tablaBoton')
            ->addColumn('parametros', 'mina/administracion/material/tablaParametro')
            ->rawColumns(['botones', 'parametros'])
            ->toJson();
    }

    public function listParametro(Request $request, $id){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Grupo::findOrFail(6)->parametros()->select('id', 'nombre'))
            ->addColumn('tema', $id)
            ->addColumn('botones', 'mina/administracion/material/tablaUnoBoton')
            ->rawColumns(['botones'])
            ->toJson();
    }

    public function create(){
        return view('mina.administracion.material.index', ['accion' => 'Nuevo']);
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        $dato = Material::create($request->all());
        return redirect()->route('material.editar', $dato->id)->with('info', 'Registro creado con éxito');
    }

    public function edit($id){
        $dato = Material::findOrFail($id);
        return view('mina.administracion.material.index', ['accion' => 'Editar'], compact('dato'));
    }

    public function update(Request $request, $id){
        $this->validatorUpdate($request->all(), $id)->validate();
        $dato = Material::findOrFail($id);
        $dato->fill($request->all())->save();
        return redirect()->route('material')->with('info', 'Registro actualizado con éxito');
    }

    public function updateParametro(Request $request, $id, $id0){
        $dato = Material::findOrFail($id);
        $dato->submateriales()->syncWithoutDetaching($id0);
        return redirect()->route('material.editar', $id)->with('info', 'Parámetro agregado con éxito');
    }

    public function destroyParametro(Request $request, $id, $id0){
        $dato = Material::findOrFail($id);
        $dato->submateriales()->detach($id0);
        return redirect()->route('material.editar', $id)->with('info', 'Parámetro Eliminado con éxito');
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'nombre' => 'required|string|max:180|unique:materials',
        ]);
    }

    protected function validatorUpdate(array $data, $id){
        return Validator::make($data, [
            'nombre' => 'required|string|max:180|unique:materials,nombre,'.$id,
        ]);
    }
}