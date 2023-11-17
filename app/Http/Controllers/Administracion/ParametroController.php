<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Parametro;
use Illuminate\Support\Facades\Validator;

class ParametroController extends Controller{
    public function __construct(){
        $this->middleware(['permission:Parametro leer|Parametro crear|Parametro editar|Parametro borrar']);
        $this->middleware('mina');
    }

    public function index(Request $request){
        return view('mina.administracion.parametro.index');
    }

    public function list(Request $request){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Parametro::select('id', 'nombre'))
            ->addColumn('botones', 'mina/administracion/parametro/tablaBoton')
            ->rawColumns(['botones'])
            ->toJson();
    }

    public function create(){
        return view('mina.administracion.parametro.index', ['accion' => 'Nuevo']);
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        Parametro::create($request->all());
        return redirect()->route('parametro')->with('info', 'Registro creado con éxito');
    }

    public function edit($id){
        $dato = Parametro::findOrFail($id);
        return view('mina.administracion.parametro.index', ['accion' => 'Editar'], compact('dato'));
    }

    public function update(Request $request, $id){
        $this->validatorUpdate($request->all(), $id)->validate();
        $dato = Parametro::findOrFail($id);
        $dato->fill($request->all())->save();
        return redirect()->route('parametro')->with('info', 'Registro actualizado con éxito');
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'nombre' => 'required|string|max:255|unique:parametros',
        ]);
    }

    protected function validatorUpdate(array $data, $id){
        return Validator::make($data, [
            'nombre' => 'required|string|max:255|unique:parametros,nombre,'.$id,
        ]);
    }
}