<?php

namespace App\Http\Controllers\Empresa;

use PDF;
use URL;

use Carbon\Carbon;
use App\Models\Grupo;
use App\Models\Viaje;
use App\Models\Materia;
use App\Models\Tercero;
use App\Models\Material;
use App\Models\Vehiculo;
use App\Models\Gruposubmat;
use CreateGruposubmatsTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cubicaje;
use Illuminate\Support\Facades\Auth;
use App\Models\GrupoSubMateriaMaterial;
use App\Models\Tarifa;
use App\Models\TerceroTarifa;
use Illuminate\Support\Facades\Validator;

class ViajeController extends Controller{
    public function __construct(){
        $this->middleware(['permission:Viaje leer|Viaje crear|Viaje editar|Viaje borrar'])->except('origin');
        $this->middleware('mina')->except('index', 'list', 'listInvoice', 'origin');
    }

    public function index(Request $request){
        return view('mina.empresa.viaje.index');
    }

    public function list(Request $request){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Viaje::select('viajes.nro_viaje', 'viajes.id', 'viajes.fecha_nombre as fecha', 'terceros.nombre as operador', 'vehiculos.placa', 'materias.nombre', 'viajes.volumen', 'users.name as digitador', 'viajes.activo', 'viajes.volumen_manual', 'viajes.certificado', 'viajes.fecha_certificacion', 'viajes.numero_certificacion')
                ->where('eliminado', 0)
                ->when(Auth::user()->tercero_id != 1, function($q){
                    return $q->where('operador_id', Auth::user()->tercero_id);
                })
                ->join('terceros', 'viajes.operador_id', '=', 'terceros.id')
                ->join('vehiculos', 'viajes.vehiculo_id', '=', 'vehiculos.id')
                ->join('materias', 'viajes.material_id', '=', 'materias.id')
                ->join('users', 'viajes.user_update_id', '=', 'users.id'))
            ->addColumn('botones', 'mina/empresa/viaje/tablaBoton')
            ->addColumn('volumen', 'mina/empresa/viaje/tablaBotonVolumen')
            ->addColumn('activo', 'mina/empresa/viaje/tablaActivo')
            ->addColumn('certificado', 'mina/empresa/viaje/tablaCertificado')
            ->rawColumns(['botones', 'volumen', 'activo', 'certificado'])
            ->toJson();
    }

    public function listOperator(Request $request, $id, $desde, $hasta){
        if (!$request->ajax()) return redirect('/');
        $operadorUno = Tercero::where('id', $id)->first();
        return datatables()
            ->eloquent(Viaje::select('viajes.id', 'viajes.fecha_nombre as fecha', 'terceros.nombre as operador', 'vehiculos.placa', 'materias.nombre', 'viajes.volumen', 'viajes.valor', 'viajes.total', 'viajes.nro_viaje')
                ->when($operadorUno->operador == 1, function($q) use ($id) {
                    return $q->where('operador_id', $id);
                })
                ->when($operadorUno->transporte == 1 && $operadorUno->operador == 0, function($q) use ($id) {
                    return $q->where('transporte_id', $id);
                })
                ->whereBetween('fecha', [$desde, $hasta])
                ->where('eliminado', 0)
                ->where('viajes.activo', 1)
                ->whereNull('factura_id')
                ->leftJoin('terceros', 'viajes.operador_id', '=', 'terceros.id')
                ->leftJoin('vehiculos', 'viajes.vehiculo_id', '=', 'vehiculos.id')
                ->leftJoin('materias', 'viajes.material_id', '=', 'materias.id'))
            ->toJson();
    }

    public function listInvoice(Request $request, $id){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Viaje::select('viajes.id', 'viajes.fecha_nombre as fecha', 'terceros.nombre as operador', 'vehiculos.placa', 'materias.nombre', 'viajes.volumen', 'viajes.valor', 'viajes.total', 'viajes.nro_viaje')
                ->where('factura_id', $id)
                ->join('terceros', 'viajes.operador_id', '=', 'terceros.id')
                ->join('vehiculos', 'viajes.vehiculo_id', '=', 'vehiculos.id')
                ->join('materias', 'viajes.material_id', '=', 'materias.id'))
            ->toJson();
    }

    public function create(){
        try {
            $operadores = Tercero::where('operador', 1)->whereNotNull('frente_id')->where('activo', 1)->orderBy('nombre')->get();
            $operador = $operadores->pluck('nombre', 'id');

            $subgrupo = Gruposubmat::select('nombre', 'id')
            ->where('activo', 1)
            ->get()
            ->pluck('nombre', 'id');

            $vehiculo = $conductor = [];
            if($operadores->first()->transportes){
                foreach ($operadores->first()->transportes as $d) {
                    foreach ($d->vehiculos as $e) {
                        $vehiculo[$e->id] = $e->placa;
                    }
                }
                asort($vehiculo);

                foreach ($operadores->first()->transportes as $d) {
                    foreach ($d->conductores as $e) {
                        $conductor[$e->id] = $e->nombre;
                    }
                }
                asort($conductor);
            }

            if(count($vehiculo) <= 0 && count($conductor) <= 0){
                return back()->with('error', "Todos los Operadores deben tener Transportes y Vehículos asignados para poder crear un viaje");
            }
            
            $vehi = Vehiculo::find(array_key_first($vehiculo));
            $vehiculos = Vehiculo::where('activo', 1)->get();
            $materiales = Materia::select('nombre', 'id')->where('activo', 1)->get()->pluck('nombre', 'id');
            $subgrupo_materia = GrupoSubMateriaMaterial::select('gruposubmat_id', 'material_id')->get();
            $hoy = Carbon::now()->toDateString();
            $desde = Carbon::now()->subDays(4)->toDateString();
            return view('mina.empresa.viaje.index', ['accion' => 'Nuevo'], compact('subgrupo_materia', 'operadores', 'operador', 'subgrupo', 'vehiculo', 'conductor', 'vehi', 'vehiculos', 'materiales', 'hoy', 'desde'));
        } catch (\Exception $e) {
            dd($e->getMessage().$e->getLine());
        }
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        $vehiculo = Vehiculo::findOrFail($request->vehiculo_id);
        $operador = Tercero::findOrFail($request->operador_id);
        $tarifa = TerceroTarifa::select('tarifa')
        ->where('tercero_id', $request->operador_id)
        ->join('tarifa_material', 'tarifa_material.tarifa_id', '=', 'tercero_tarifa.tarifa_id')
        ->where('tarifa_material.material_id', $request->material_id)
        ->first();

        if(!$tarifa){
            return redirect()->back()->with('error', 'Operador debe tener tarifa asociado a los materiales');
        }

        if(isset($request->nro_viaje)){
            $valeExistente = Viaje::where(['nro_viaje' => $request->nro_viaje, 'activo' => 1])->count();

            if($valeExistente > 0){
                return redirect()->back()->with('error', 'Vale existente en otro viaje');
            }
        }

        Viaje::create([
            'fecha' => $request->fecha,
            'vehiculo_id' => $request->vehiculo_id,
            'conductor_nombre' => $request->conductor_nombre,
            'operador_id' => $request->operador_id,
            'transporte_id' => $vehiculo->tercero_id,
            'material_id' => $request->material_id,
            'subgrupo_id' => $request->subgrupo_id,
            'frente_id' => $operador->frente_id,
            'volumen' => $request->volumen,
            'valor' => $tarifa->tarifa,
            'nro_viaje' => $request->nro_viaje ?? NULL,
            'cliente' => $request->cliente ?? NULL,
            'destino' => $request->destino ?? NULL
        ]);
        return redirect()->route('viaje')->with('info', 'Registro creado con éxito');
    }

    public function edit($id){
        $dato = Viaje::findOrFail($id);
        $operadores = Tercero::where('operador', 1)->where('activo', 1)->orderBy('nombre')->get();
        $operador = $operadores->pluck('nombre', 'id');
        $vehiculo = $conductor = [];
        $subgrupo = Gruposubmat::select('nombre', 'id')
        ->where('activo', 1)
        ->get()
        ->pluck('nombre', 'id');
        foreach ($operadores->find($dato->operador_id)->transportes as $d) {
            foreach ($d->vehiculos as $e) {
                $vehiculo[$e->id] = $e->placa;
            }
        }
        asort($vehiculo);
        foreach ($operadores->find($dato->operador_id)->transportes as $d) {
            foreach ($d->conductores as $e) {
                $conductor[$e->id] = $e->nombre;
            }
        }
        asort($conductor);
        $vehi = Vehiculo::findOrFail($dato->vehiculo_id);
        $vehiculos = Vehiculo::where('activo', 1)->get();
        $hoy = Carbon::createFromDate($dato->fecha)->addDays(2)->toDateString();
        $desde = Carbon::createFromDate($dato->fecha)->subDays(2)->toDateString();
        $materiales = Materia::select('nombre', 'id')->where('activo', 1)->get()->pluck('nombre', 'id');
        $subgrupo_materia = GrupoSubMateriaMaterial::select('gruposubmat_id', 'material_id')->get();
        return view('mina.empresa.viaje.index', ['accion' => 'Editar'], compact('subgrupo', 'dato', 'operadores', 'operador', 'subgrupo_materia', 'vehiculo', 'conductor', 'vehi', 'vehiculos', 'materiales', 'hoy', 'desde'));
    }

    public function update(Request $request, $id){
        $this->validator($request->all())->validate();
        $dato = Viaje::findOrFail($id);
        $vehiculo = Vehiculo::findOrFail($request->vehiculo_id);
        $operador = Tercero::findOrFail($request->operador_id);
        $tarifa = TerceroTarifa::select('tarifa')
        ->where('tercero_id', $request->operador_id)
        ->join('tarifa_material', 'tarifa_material.tarifa_id', '=', 'tercero_tarifa.tarifa_id')
        ->where('tarifa_material.material_id', $request->material_id)
        ->first();

        if(!$tarifa){
            return redirect()->back()->with('error', 'Operador debe tener tarifa asociado a los materiales');
        }

        if(isset($request->nro_viaje)){
            $valeExistente = Viaje::where(['nro_viaje' => $request->nro_viaje, 'activo' => 1])->where('id', '<>', $dato->id)->count();

            if($valeExistente > 0){
                return redirect()->back()->with('error', 'Vale existente en otro viaje');
            }
        }

        $dato->fill([
            'fecha' => $request->fecha,
            'vehiculo_id' => $request->vehiculo_id,
            'conductor_nombre' => $request->conductor_nombre,
            'operador_id' => $request->operador_id,
            'transporte_id' => $vehiculo->tercero_id,
            'material_id' => $request->material_id,
            'subgrupo_id' => $request->subgrupo_id,
            'frente_id' => $operador->frente_id,
            'volumen' => $request->volumen,
            'valor' => $tarifa->tarifa,
            'nro_viaje' => $request->nro_viaje ?? NULL,
            'cliente' => $request->cliente ?? NULL,
            'destino' => $request->destino ?? NULL
        ])->save();

        return redirect()->route('viaje')->with('info', 'Registro actualizado con éxito');
    }

    public function destroy($id){
        $dato = Viaje::findOrFail($id);
        $dato->activo = ($dato->activo == 1) ? 0 : 1;
        $dato->save();
        return redirect()->route('viaje')->with('info', 'Registro actualizado con éxito');
    }

    public function origin(Request $request){
        if(isset($request->id)){
            $dato = Viaje::findOrFail($request->id);
            $carpeta = (substr(URL::current(), 0, 16) == 'http://localhost') ? '' : '/mina_app';
            $pdf = PDF::loadView('mina.empresa.viaje.origen', compact('dato', 'carpeta'));
            return $pdf->stream('certificado_origen_'.$request->id.'.pdf');
        }
        return view('mina.origen');
    }

    public function vale(Request $request){
        if(isset($request->id)){
            $dato = Viaje::findOrFail($request->id);
            $carpeta = (substr(URL::current(), 0, 16) == 'http://localhost') ? '' : '/mina_app';
            $pdf = PDF::loadView('mina.empresa.viaje.vale', compact('dato', 'carpeta'));
            return $pdf->stream('certificado_vale_'.$request->id.'.pdf');
        }
        return view('mina.vale');
    }

    public function getVehicleCubage(Request $request){
        if(!isset($request->id_vehiculo))
            return response()->json([
                "data" => []
            ], 400);

        $getVehicle = Cubicaje::select('volumen')->where('vehiculo_id', $request->id_vehiculo)->where('activo', 1)->first();

        return response()->json([
            "data" => $getVehicle
        ], 200);
    }

    public function cambiarVolumen(Request $request){
        if(!$request->has('id_viaje') || !$request->has('volumen'))
         return redirect()->back()->with('error', 'Reintente, ha ocurrido un error');

        $viaje = Viaje::where('id', $request->id_viaje)->first();
        
        $viaje->update([
            'volumen' => $request->volumen,
            'volumen_manual' => true,
            'total' => $request->volumen * $viaje->valor
        ]);

        return redirect()->route('viaje')->with('info', 'Volumen del viaje Nro. '.$viaje->id .' ha sido actualizado correctamente');
    }

    public function getOperadores(){
        $operadores = Tercero::where('operador', 1)->whereNotNull('frente_id')->where('activo', 1)->orderBy('nombre')->get()->pluck('nombre', 'id');

        if(!$operadores)
            return response()->json([ "data" => []], 400);

        return response()->json([ 
            "data" => $operadores
        ], 200);
    }

    public function getOperadorViajeCertificado(Request $request){
        $operadorViajes = Viaje::where('operador_id', $request->operador_id)->where('activo', 1)->where('certificado', 0)->get();

        if(!$operadorViajes)
            return response()->json([ "data" => false ], 400);

        return response()->json([ 
            "data" => $operadorViajes
        ], 200);
    }

    public function certificar(Request $request){
        Validator::make($request->all(), [
            'fecha_certificacion' => 'required|date',
            'numero_certificacion' => 'required',
            'viajes_id' => 'required|array'
        ])->validate();

        $operadorViajes = Viaje::whereIn('id', $request->viajes_id)
        ->where('activo', 1)
        ->where('certificado', 0)
        ->update([
            'fecha_certificacion' => $request->fecha_certificacion,
            'numero_certificacion' => $request->numero_certificacion,
            'certificado' => 1
        ]);

        return redirect()->route('viaje')->with('info', 'Viajes certificados con éxito');
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'fecha' => 'required|date',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'conductor_nombre' => 'nullable',
            'operador_id' => 'required|exists:terceros,id',
            'material_id' => 'required|exists:materias,id',
            'subgrupo_id' => 'required|exists:gruposubmats,id',
            'volumen' => 'required|numeric|min:0.01',
        ]);
    }
}