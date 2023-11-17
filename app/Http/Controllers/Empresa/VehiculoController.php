<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Vehiculo;
use App\Models\Tercero;
use Illuminate\Support\Facades\Validator;

class VehiculoController extends Controller{
    public function __construct(){
        $this->middleware(['permission:Vehiculo leer|Vehiculo crear|Vehiculo editar|Vehiculo borrar']);
        $this->middleware('mina');
    }

    public function index(Request $request){
        return view('mina.empresa.vehiculo.index');
    }

    public function list(Request $request){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Vehiculo::select('vehiculos.id', 'operador.nombre as operador', 'conductor.nombre as conductor', 'placa' , 'volumen', 'marca', 'vehiculos.activo')
            ->leftJoin('terceros as conductor', 'conductor_id', '=', 'conductor.id')
            ->leftJoin('terceros as operador', 'tercero_id', '=', 'operador.id'))
            ->addColumn('botones', 'mina/empresa/vehiculo/tablaBoton')
            ->addColumn('activo', 'mina/empresa/vehiculo/tablaActivo')
            ->rawColumns(['botones', 'activo'])
            ->toJson();
    }

    public function create(){
        $transportes = Tercero::where('transporte', 1)->where('activo', 1)->get();
        $tercero = $conductor = ['' => 'Seleccione...'];
        foreach ($transportes as $d) {
            $tercero[$d->id] = $d->nombre;
        }
        return view('mina.empresa.vehiculo.index', ['accion' => 'Nuevo'], compact('transportes', 'tercero', 'conductor'));
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        Vehiculo::create($request->all());
        return redirect()->route('vehiculo')->with('info', 'Registro creado con éxito');
    }

    public function edit($id){
        $dato = Vehiculo::findOrFail($id);
        $transportes = Tercero::where('transporte', 1)->where('activo', 1)->get();
        $tercero = $conductor = ['' => 'Seleccione...'];
        foreach ($transportes as $d) {
            $tercero[$d->id] = $d->nombre;
        }
        if($dato->tercero_id){
            foreach ($transportes->find($dato->tercero_id)->conductores as $d) {
                $conductor[$d->id] = $d->nombre;
            }
        }
        return view('mina.empresa.vehiculo.index', ['accion' => 'Editar'], compact('dato', 'transportes', 'tercero', 'conductor'));
    }

    public function update(Request $request, $id){
        $this->validatorUpdate($request->all(), $id)->validate();
        $dato = Vehiculo::findOrFail($id);
        $dato->fill($request->all())->save();
        return redirect()->route('vehiculo')->with('info', 'Registro actualizado con éxito');
    }

    public function destroy($id){
        $dato = Vehiculo::findOrFail($id);
        $dato->activo = ($dato->activo == 1) ? 0 : 1;
        $dato->save();
        return redirect()->route('vehiculo')->with('info', 'Registro actualizado con éxito');
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'tercero_id' => 'nullable|exists:terceros,id',
            'conductor_id' => 'nullable|exists:terceros,id',
            'placa' => 'required|string|max:6|unique:vehiculos',
            'volumen' => 'required|numeric|min:0.01',
            'marca' => 'nullable|string|max:50',
        ]);
    }

    protected function validatorUpdate(array $data, $id){
        return Validator::make($data, [
            'tercero_id' => 'nullable|exists:terceros,id',
            'conductor_id' => 'nullable|exists:terceros,id',
            'placa' => 'required|string|max:6|unique:vehiculos,placa,'.$id,
            'volumen' => 'required|numeric|min:0.01',
            'marca' => 'nullable|string|max:50',
        ]);
    }
}