<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tercero;
use App\Models\Grupo;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Validator;

class TransporteController extends Controller{
    public function __construct(){
        $this->middleware(['permission:Transporte leer|Transporte crear|Transporte editar|Transporte borrar']);
        $this->middleware('mina');
    }

    public function index(Request $request){
        return view('mina.empresa.transporte.index');
    }

    public function list(Request $request){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Tercero::select('id', 'nombre' , 'telefono', 'email')
                ->where('transporte', 1))
            ->addColumn('botones', 'mina/empresa/transporte/tablaBoton')
            ->rawColumns(['botones'])
            ->toJson();
    }

    public function listContact(Request $request, $id){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Tercero::findOrFail($id)->contactos()->select('terceros.id', 'terceros.nombre' , 'telefono', 'email', 'parametros.nombre as funcion', 'tercero_id')->join('parametros', 'funcion_id', '=', 'parametros.id'))
            ->addColumn('botones', 'mina/empresa/transporte/tablaBotonContacto')
            ->rawColumns(['botones'])
            ->toJson();
    }

    public function listVehicle(Request $request, $id){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Vehiculo::where('tercero_id', $id)->select('vehiculos.id', 'placa' , 'volumen', 'marca', 'tercero_id', 'terceros.nombre as conductor')
            ->leftJoin('terceros', 'conductor_id', '=', 'terceros.id'))
            ->addColumn('botones', 'mina/empresa/transporte/tablaBotonVehiculo')
            ->rawColumns(['botones'])
            ->toJson();
    }

    public function create(){
        $tab = (isset($request->tab)) ? $request->tab : 1;
        $tercero = Tercero::where('persona_id', 2)->where('transporte', 0)->pluck('nombre', 'id');
        return view('mina.empresa.transporte.index', ['accion' => 'Nuevo'], compact('tab', 'tercero'));
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        $dato = Tercero::findOrFail($request->tercero_id);
        $dato->fill(['transporte' => 1])->save();
        return redirect()->route('transporte.editar', $dato->id)->with('info', 'Registro creado con éxito');
    }

    public function edit($id){
        $tab = (session()->has('tab')) ? session('tab') : 1;
        $dato = Tercero::findOrFail($id);
        $funcion = Grupo::findOrFail(4)->parametros()->orderBy('nombre')->pluck('nombre', 'id');
        $terceros = Tercero::where('persona_id', 1)->pluck('nombre', 'id');
        $vehiculos = Vehiculo::whereNull('tercero_id')->pluck('placa', 'id');
        return view('mina.empresa.transporte.index', ['accion' => 'Editar'], compact('tab', 'dato', 'terceros', 'funcion', 'vehiculos'));
    }

    public function update(Request $request, $id){
        $trans = (isset($request->transporte) && $request->transporte == 1) ? 1 : 0;
        $dato = Tercero::findOrFail($id);
        $dato->fill(['transporte' => $trans])->save();
        return redirect()->route('transporte.editar', $dato->id)->with('info', 'Registro actualizado con éxito');
    }

    public function storeContact(Request $request, $id){
        $this->validatorContact($request->all())->validate();
        $dato = Tercero::findOrFail($id);
        $dato->contactos()->syncWithoutDetaching([$request->contacto_id => ['funcion_id' => $request->funcion_id]]);
        return redirect()->route('transporte.editar', $dato->id)->with('info', 'Registro creado con éxito')->with('tab', 2);
    }

    public function destroyContact(Request $request, $id, $id1){
        $dato = Tercero::findOrFail($id);
        $dato->contactos()->detach($id1);
        return redirect()->route('transporte.editar', $id)->with('info', 'Registro actualizado con éxito')->with('tab', 2);
    }

    public function storeVehicle(Request $request, $id){
        $this->validatorVehicle($request->all())->validate();
        $dato = Vehiculo::findOrFail($request->vehiculo_id);
        $dato->fill(['tercero_id' => $id])->save();
        return redirect()->route('transporte.editar', $id)->with('info', 'Registro creado con éxito')->with('tab', 3);
    }

    public function destroyVehicle(Request $request, $id, $id1){
        $dato = Vehiculo::findOrFail($id1);
        $dato->fill(['tercero_id' => null])->save();
        return redirect()->route('transporte.editar', $id)->with('info', 'Registro actualizado con éxito')->with('tab', 3);
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'tercero_id' => 'required|exists:terceros,id',
        ]);
    }

    protected function validatorContact(array $data){
        return Validator::make($data, [
            'contacto_id' => 'required|exists:terceros,id',
            'funcion_id' => 'required|exists:parametros,id',
        ]);
    }

    protected function validatorVehicle(array $data){
        return Validator::make($data, [
            'vehiculo_id' => 'required|exists:vehiculos,id',
        ]);
    }
}