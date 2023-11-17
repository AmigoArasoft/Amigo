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
            ->eloquent(Viaje::select('viajes.id', 'viajes.fecha_nombre as fecha', 'terceros.nombre as operador', 'vehiculos.placa', 'materias.nombre', 'viajes.volumen', 'users.name as digitador', 'viajes.activo')
                ->where('eliminado', 0)
                ->whereNull('factura_id')
                ->when(Auth::user()->tercero_id != 1, function($q){
                    return $q->where('operador_id', Auth::user()->tercero_id);
                })
                ->join('terceros', 'viajes.operador_id', '=', 'terceros.id')
                ->join('vehiculos', 'viajes.vehiculo_id', '=', 'vehiculos.id')
                ->join('materias', 'viajes.material_id', '=', 'materias.id')
                ->join('users', 'viajes.user_update_id', '=', 'users.id'))
            ->addColumn('botones', 'mina/empresa/viaje/tablaBoton')
            ->addColumn('activo', 'mina/empresa/viaje/tablaActivo')
            ->rawColumns(['botones', 'activo'])
            ->toJson();
    }

    public function listOperator(Request $request, $id, $desde, $hasta){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Viaje::select('viajes.id', 'viajes.fecha_nombre as fecha', 'terceros.nombre as operador', 'vehiculos.placa', 'materias.nombre', 'viajes.volumen', 'viajes.valor', 'viajes.total')
                ->where('operador_id', $id)
                ->whereBetween('fecha', [$desde, $hasta])
                ->where('eliminado', 0)
                ->whereNull('factura_id')
                ->join('terceros', 'viajes.operador_id', '=', 'terceros.id')
                ->join('vehiculos', 'viajes.vehiculo_id', '=', 'vehiculos.id')
                ->join('materias', 'viajes.material_id', '=', 'materias.id'))
            ->toJson();
    }

    public function listInvoice(Request $request, $id){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Viaje::select('viajes.id', 'viajes.fecha_nombre as fecha', 'terceros.nombre as operador', 'vehiculos.placa', 'materias.nombre', 'viajes.volumen', 'viajes.valor', 'viajes.total')
                ->where('factura_id', $id)
                ->join('terceros', 'viajes.operador_id', '=', 'terceros.id')
                ->join('vehiculos', 'viajes.vehiculo_id', '=', 'vehiculos.id')
                ->join('materias', 'viajes.material_id', '=', 'materias.id'))
            ->toJson();
    }

    public function create(){
        $operadores = Tercero::where('operador', 1)->where('activo', 1)->orderBy('nombre')->get();
        $operador = $operadores->pluck('nombre', 'id');

        $subgrupo = Gruposubmat::select('nombre', 'id')
        ->where('activo', 1)
        ->get()
        ->pluck('nombre', 'id');

        $vehiculo = $conductor = [];
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
        $vehi = Vehiculo::findOrFail(array_key_first($vehiculo));
        $vehiculos = Vehiculo::where('activo', 1)->get();
        $materiales = Materia::select('nombre', 'id')->where('activo', 1)->get()->pluck('nombre', 'id');
        $subgrupo_materia = GrupoSubMateriaMaterial::select('gruposubmat_id', 'material_id')->get();
        $hoy = Carbon::now()->toDateString();
        $desde = Carbon::now()->subDays(4)->toDateString();
        return view('mina.empresa.viaje.index', ['accion' => 'Nuevo'], compact('subgrupo_materia', 'operadores', 'operador', 'subgrupo', 'vehiculo', 'conductor', 'vehi', 'vehiculos', 'materiales', 'hoy', 'desde'));
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        $vehiculo = Vehiculo::findOrFail($request->vehiculo_id);
        $operador = Tercero::findOrFail($request->operador_id);
        $tarifa = TerceroTarifa::select('tarifa')
        ->where('tercero_id', $request->operador_id)
        ->join('tarifa_gruposubmat', 'tarifa_gruposubmat.tarifa_id', '=', 'tercero_tarifa.tarifa_id')
        ->where('tarifa_gruposubmat.gruposubmat_id', $request->subgrupo_id)
        ->first();

        if(!$tarifa){
            return redirect()->route('viaje')->with('error', 'Operador debe tener tarifa asociado a los materiales');
        }

        Viaje::create([
            'fecha' => $request->fecha,
            'vehiculo_id' => $request->vehiculo_id,
            'conductor_id' => $request->conductor_id,
            'operador_id' => $request->operador_id,
            'transporte_id' => $vehiculo->tercero_id,
            'material_id' => $request->material_id,
            'subgrupo_id' => $request->subgrupo_id,
            'frente_id' => $operador->frente_id,
            'volumen' => $request->volumen,
            'valor' => $tarifa->tarifa
        ]);

        $vehiculo->fill([
            'conductor_id' => $request->conductor_id,
        ])->save();
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
        ->join('tarifa_gruposubmat', 'tarifa_gruposubmat.tarifa_id', '=', 'tercero_tarifa.tarifa_id')
        ->where('tarifa_gruposubmat.gruposubmat_id', $request->subgrupo_id)
        ->first();

        if(!$tarifa){
            return redirect()->route('viaje')->with('error', 'Operador debe tener tarifa asociado a los materiales');
        }

        $dato->fill([
            'fecha' => $request->fecha,
            'vehiculo_id' => $request->vehiculo_id,
            'conductor_id' => $request->conductor_id,
            'operador_id' => $request->operador_id,
            'transporte_id' => $vehiculo->tercero_id,
            'material_id' => $request->material_id,
            'subgrupo_id' => $request->subgrupo_id,
            'frente_id' => $operador->frente_id,
            'volumen' => $request->volumen,
            'valor' => $tarifa->tarifa
        ])->save();
        $vehiculo->fill([
            'conductor_id' => $request->conductor_id,
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

    protected function validator(array $data){
        return Validator::make($data, [
            'fecha' => 'required|date',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'conductor_id' => 'nullable|exists:terceros,id',
            'operador_id' => 'required|exists:terceros,id',
            'material_id' => 'required|exists:materias,id',
            'subgrupo_id' => 'required|exists:gruposubmats,id',
            'volumen' => 'required|numeric|min:0.01',
        ]);
    }
}