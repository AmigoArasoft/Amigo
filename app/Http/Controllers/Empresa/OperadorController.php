<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tercero;
use App\Models\Grupo;
// use App\Models\Material;
use App\Models\Tarifa;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class OperadorController extends Controller{
    public function __construct(){
        $this->middleware(['permission:Operador leer|Operador crear|Operador editar|Operador borrar']);
        $this->middleware('mina');
    }

    public function index(Request $request){
        return view('mina.empresa.operador.index');
    }

    public function list(Request $request){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Tercero::select('terceros.id', 'terceros.nombre' , 'telefono', 'email', 'transporte', 'parametros.nombre as frente')
                ->where('operador', 1)
                ->join('parametros', 'frente_id', '=', 'parametros.id'))
            ->addColumn('botones', 'mina/empresa/operador/tablaBoton')
            ->addColumn('transportador', 'mina/empresa/operador/tablaTransporte')
            ->rawColumns(['botones', 'transportador'])
            ->toJson();
    }

    public function listContact(Request $request, $id){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Tercero::findOrFail($id)->contactos()->select('terceros.id', 'terceros.nombre' , 'telefono', 'email', 'parametros.nombre as funcion', 'tercero_id')->join('parametros', 'funcion_id', '=', 'parametros.id'))
            ->addColumn('botones', 'mina/empresa/operador/tablaBotonContacto')
            ->rawColumns(['botones'])
            ->toJson();
    }

    public function listTransport(Request $request, $id){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Tercero::findOrFail($id)->transportes()->select('id', 'nombre' , 'telefono', 'email', 'tercero_id'))
            ->addColumn('botones', 'mina/empresa/operador/tablaBotonTransporte')
            ->rawColumns(['botones'])
            ->toJson();
    }

    public function listMaterial(Request $request, $id){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Tercero::findOrFail($id)->tarifas()
                ->select('id', 'nombre', 'tarifa', 'tercero_id')
            )
            ->addColumn('botones', 'mina/empresa/operador/tablaBotonMaterial')
            ->rawColumns(['botones'])
            ->toJson();
    }

    public function create(){
        $tab = (isset($request->tab)) ? $request->tab : 1;
        $tercero = Tercero::where('persona_id', 2)->where('operador', 0)->pluck('nombre', 'id');
        $frente = Grupo::findOrFail(5)->parametros()->orderBy('nombre')->pluck('nombre', 'id');
        $comprador = Grupo::findOrFail(8)->parametros()->orderBy('nombre')->pluck('nombre', 'id');
        return view('mina.empresa.operador.index', ['accion' => 'Nuevo'], compact('tab', 'tercero', 'frente', 'comprador'));
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        $trans = (isset($request->transporte) && $request->transporte == 1) ? 1 : 0;
        $dato = Tercero::findOrFail($request->tercero_id);
        if(is_null($request->file('archivo'))){
            $request->merge(['firma' => null]);
        } else {
            $request->merge(['firma' => Storage::putFile('public/firma', $request->file('archivo'))]);
        }
        $dato->fill([
            'operador' => 1,
            'transporte' => $trans,
            'frente_id' => $request->frente_id,
            'comprador_id' => $request->comprador_id,
            'rucom' => $request->rucom,
            'firma' => $request->firma,
        ])->save();
        if($trans == 1){
            $dato->transportes()->syncWithoutDetaching($dato->id);
        }
        return redirect()->route('operador.editar', $dato->id)->with('info', 'Registro creado con éxito');
    }

    public function edit($id){
        $tab = (session()->has('tab')) ? session('tab') : 1;
        $dato = Tercero::findOrFail($id);
        $funcion = Grupo::findOrFail(4)->parametros()->orderBy('nombre')->pluck('nombre', 'id');
        // $material = Material::where('activo', 1)->orderBy('nombre')->pluck('nombre', 'id');
        $material = Tarifa::where('activo', 1)->orderBy('nombre')->pluck('nombre', 'id');
        $frente = Grupo::findOrFail(5)->parametros()->orderBy('nombre')->pluck('nombre', 'id');
        $terceros = Tercero::where('persona_id', 1)->pluck('nombre', 'id');
        $transportes = Tercero::where('persona_id', 2)->where('transporte', 1)->pluck('nombre', 'id');
        $comprador = Grupo::findOrFail(8)->parametros()->orderBy('nombre')->pluck('nombre', 'id');
        return view('mina.empresa.operador.index', ['accion' => 'Editar'], compact('tab', 'dato', 'terceros', 'funcion', 'material', 'frente', 'transportes', 'comprador'));
    }

    public function update(Request $request, $id){
        $this->validatorUpdate($request->all(), $id)->validate();
        $trans = (isset($request->transporte) && $request->transporte == 1) ? 1 : 0;
        $opera = (isset($request->operador) && $request->operador == 1) ? 1 : 0;
        $comprador = ($opera == 1) ? $request->comprador_id : null ;
        $frente = ($opera == 0) ? null : $request->frente_id;
        $dato = Tercero::findOrFail($id);
        if(is_null($request->file('archivo'))){
            $request->merge(['firma' => $dato->firma]);
        } else {
            Storage::delete($dato->firma);
            $request->merge(['firma' => Storage::putFile('public/firma', $request->file('archivo'))]);
        }
        $dato->fill([
            'operador' => $opera,
            'transporte' => $trans,
            'frente_id' => $frente,
            'comprador_id' => $comprador,
            'rucom' => $request->rucom,
            'firma' => $request->firma,
        ])->save();
        if($trans == 1){
            $dato->transportes()->syncWithoutDetaching($dato->id);
        } else {
            $dato->transportes()->detach($dato->id);
        }
        return redirect()->route('operador.editar', $dato->id)->with('info', 'Registro actualizado con éxito');
    }

    public function storeContact(Request $request, $id){
        $this->validatorContact($request->all())->validate();
        $dato = Tercero::findOrFail($id);
        $dato->contactos()->syncWithoutDetaching([$request->contacto_id => ['funcion_id' => $request->funcion_id]]);
        return redirect()->route('operador.editar', $dato->id)->with('info', 'Registro creado con éxito')->with('tab', 2);
    }

    public function destroyContact(Request $request, $id, $id1){
        $dato = Tercero::findOrFail($id);
        $dato->contactos()->detach($id1);
        return redirect()->route('operador.editar', $id)->with('info', 'Registro actualizado con éxito')->with('tab', 2);
    }

    public function storeTransport(Request $request, $id){
        $this->validatorTransport($request->all())->validate();
        $dato = Tercero::findOrFail($id);
        $dato->transportes()->syncWithoutDetaching($request->transporte_id);
        return redirect()->route('operador.editar', $dato->id)->with('info', 'Registro creado con éxito')->with('tab', 3);
    }

    public function destroyTransport(Request $request, $id, $id1){
        $dato = Tercero::findOrFail($id);
        $dato->transportes()->detach($id1);
        return redirect()->route('operador.editar', $id)->with('info', 'Registro actualizado con éxito')->with('tab', 3);
    }

    public function storeMaterial(Request $request, $id){
        $this->validatorMaterial($request->all())->validate();
        $dato = Tercero::findOrFail($id);
        $dato->tarifas()->syncWithoutDetaching([$request->material_id => ['tarifa' => $request->tarifa]]);
        return redirect()->route('operador.editar', $dato->id)->with('info', 'Registro creado con éxito')->with('tab', 4);
    }

    public function destroyMaterial(Request $request, $id, $id1){
        $dato = Tercero::findOrFail($id);
        $dato->tarifas()->detach($id1);
        return redirect()->route('operador.editar', $id)->with('info', 'Registro actualizado con éxito')->with('tab', 4);
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'tercero_id' => 'required|exists:terceros,id',
            'frente_id' => 'required|exists:parametros,id|unique:terceros,frente_id,'.$data['tercero_id'],
            'comprador_id' => 'required|exists:parametros,id',
            'rucom' => 'nullable|string|max:15',
            'archivo' => 'nullable|file',
        ]);
    }

    protected function validatorUpdate(array $data, $id){
        return Validator::make($data, [
            'frente_id' => 'required|exists:parametros,id|unique:terceros,frente_id,'.$id,
            'comprador_id' => 'required|exists:parametros,id',
            'rucom' => 'nullable|string|max:15',
            'archivo' => 'nullable|file',
        ]);
    }

    protected function validatorContact(array $data){
        return Validator::make($data, [
            'contacto_id' => 'required|exists:terceros,id',
            'funcion_id' => 'required|exists:parametros,id',
        ]);
    }

    protected function validatorTransport(array $data){
        return Validator::make($data, [
            'transporte_id' => 'required|exists:terceros,id',
        ]);
    }

    protected function validatorMaterial(array $data){
        return Validator::make($data, [
            'material_id' => 'required|exists:tarifas,id',
            'tarifa' => 'required|numeric|min:0',
        ]);
    }
}