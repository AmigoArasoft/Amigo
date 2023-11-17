<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tema;
use App\Models\Parametro;
use App\Models\Grupo;
use Illuminate\Support\Facades\Validator;

class TemaController extends Controller{
    public function __construct(){
        $this->middleware(['permission:Tema leer|Tema crear|Tema editar|Tema borrar']);
        $this->middleware('mina');
    }

    public function index(Request $request){
        return view('mina.administracion.tema.index');
    }

    public function list(Request $request){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Tema::select('id', 'nombre')
            ->with(['subtemas' => function ($query) {
                $query->select('nombre')->orderBy('id');
            }]))
            ->addColumn('botones', 'mina/administracion/tema/tablaBoton')
            ->addColumn('parametros', 'mina/administracion/tema/tablaParametro')
            ->rawColumns(['botones', 'parametros'])
            ->toJson();
    }

    public function listParametro(Request $request, $id){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Grupo::findOrFail(7)->parametros()->select('id', 'nombre'))
            ->addColumn('tema', $id)
            ->addColumn('botones', 'mina/administracion/tema/tablaUnoBoton')
            ->rawColumns(['botones'])
            ->toJson();
    }

    public function create(){
        return view('mina.administracion.tema.index', ['accion' => 'Nuevo']);
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        $dato = Tema::create($request->all());
        return redirect()->route('tema.editar', $dato->id)->with('info', 'Registro creado con éxito');
    }

    public function edit($id){
        $dato = Tema::findOrFail($id);
        return view('mina.administracion.tema.index', ['accion' => 'Editar'], compact('dato'));
    }

    public function update(Request $request, $id){
        $this->validatorUpdate($request->all(), $id)->validate();
        $dato = Tema::findOrFail($id);
        $dato->fill($request->all())->save();
        return redirect()->route('tema')->with('info', 'Registro actualizado con éxito');
    }

    public function updateParametro(Request $request, $id, $id0){
        $dato = Tema::findOrFail($id);
        $dato->subtemas()->syncWithoutDetaching($id0);
        return redirect()->route('tema.editar', $id)->with('info', 'Parámetro agregado con éxito');
    }

    public function destroyParametro(Request $request, $id, $id0){
        $dato = Tema::findOrFail($id);
        $dato->subtemas()->detach($id0);
        return redirect()->route('tema.editar', $id)->with('info', 'Parámetro Eliminado con éxito');
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'nombre' => 'required|string|max:180|unique:temas',
        ]);
    }

    protected function validatorUpdate(array $data, $id){
        return Validator::make($data, [
            'nombre' => 'required|string|max:180|unique:temas,nombre,'.$id,
        ]);
    }
}