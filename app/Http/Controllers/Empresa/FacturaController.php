<?php

namespace App\Http\Controllers\Empresa;

use Carbon\Carbon;
use App\Models\Viaje;

use App\Models\Factura;
use App\Models\Tercero;
use Illuminate\Http\Request;
use App\Exports\FacturaExport;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class FacturaController extends Controller{
    public function __construct(){
        $this->middleware(['permission:Factura leer|Factura crear|Factura editar|Factura borrar']);
    }

    public function index(Request $request){
        return view('mina.empresa.factura.index');
    }

    public function list(Request $request){
        if (!$request->ajax()) return redirect('/');

        return datatables()
            ->eloquent(Factura::select('facturas.id', 'terceros.nombre as operador', 'facturas.fecha_nombre as fecha', 'facturas.desde_nombre as desde', 'facturas.hasta_nombre as hasta', 'facturas.valor', 'facturas.activo')
                ->when(Auth::user()->tercero_id != 1, function($q){
                    return $q->where('tercero_id', Auth::user()->tercero_id);
                })
                ->join('terceros', 'facturas.tercero_id', '=', 'terceros.id'))
            ->addColumn('botones', 'mina/empresa/factura/tablaBoton')
            ->addColumn('metros', function (Factura $factura) {
                return $factura->viajes->sum('volumen');
            })
            ->addColumn('activo', 'mina/empresa/factura/tablaActivo')
            ->rawColumns(['botones', 'activo'])
            ->toJson();
    }

    public function create(Request $request){
        $operadores = Tercero::where('operador', 1)->orWhere('transporte', 1)->where('activo', 1)->orderBy('nombre')->get();
        $operador = $operadores->pluck('nombre', 'id');
        $ope = ($request->tercero_id) ? $request->tercero_id : $operadores->first()->id;
        $fecha = ($request->fecha) ? $request->fecha : Carbon::now()->firstOfMonth()->toDateString();
        $desde = ($request->desde) ? $request->desde : Carbon::now()->firstOfMonth()->toDateString();
        $hasta = ($request->hasta) ? $request->hasta : Carbon::now()->toDateString();
        $operadorUno = Tercero::where('id', $ope)->first();
        $viajes = Viaje::selectRaw('viajes.material_id, materias.nombre, count(valor) as cuenta, sum(tercero_tarifa.tarifa) as valor, sum(volumen) as volumen, sum(total) as total')
        ->when($operadorUno->operador == 1, function($q) use ($ope) {
            return $q->where('operador_id', $ope);
        })
        ->when($operadorUno->transporte == 1 && $operadorUno->operador == 0, function($q) use ($ope) {
            return $q->where('transporte_id', $ope);
        })
        ->whereBetween('fecha', [$desde, $hasta])
        ->where('eliminado', 0)
        ->where('tercero_tarifa.tercero_id', $ope)
        ->where('viajes.activo', 1)
        ->whereNull('factura_id')
        ->groupBy('viajes.material_id', 'materias.nombre')
        ->join('materias', 'viajes.material_id', '=', 'materias.id')
        ->join('tarifa_material', 'tarifa_material.material_id', '=', 'materias.id')
        ->join('tercero_tarifa', 'tercero_tarifa.tarifa_id', '=', 'tarifa_material.tarifa_id')
        ->get();
        return view('mina.empresa.factura.index', ['accion' => 'Nuevo']
            , compact('operadores', 'operador', 'ope', 'fecha', 'desde', 'hasta', 'viajes')
        );
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        $operadorUno = Tercero::where('id', $request->tercero_id)->first();
        $viajes = Viaje::select('id', 'fecha_nombre', 'volumen', 'valor', 'total')
        ->when($operadorUno->operador == 1, function($q) use ($request) {
            return $q->where('operador_id', $request->tercero_id);
        })
        ->when($operadorUno->transporte == 1 && $operadorUno->operador == 0, function($q) use ($request) {
            return $q->where('transporte_id', $request->tercero_id);
        })->whereBetween('fecha', [$request->desde, $request->hasta])
        ->whereNull('factura_id')
        ->where('eliminado', 0)
        ->where('activo', 1)
        ->get();

        if($viajes->count() > 0 && $viajes->sum('total')) {
            $dato = Factura::create([
                'tercero_id' => $request->tercero_id,
                'fecha' => $request->fecha,
                'desde' => $request->desde,
                'hasta' => $request->hasta,
                'valor' => $viajes->sum('total'),
                'volumen' => $viajes->sum('volumen')
            ]);
            Viaje::select('id', 'fecha_nombre', 'volumen', 'valor', 'total')
                ->when($operadorUno->operador == 1, function($q) use ($request) {
                    return $q->where('operador_id', $request->tercero_id);
                })
                ->when($operadorUno->transporte == 1 && $operadorUno->operador == 0, function($q) use ($request) {
                    return $q->where('transporte_id', $request->tercero_id);
                })
                ->whereBetween('fecha', [$request->desde, $request->hasta])
                ->whereNull('factura_id')
                ->where('eliminado', 0)
                ->where('activo', 1)
                ->update(['factura_id' => $dato->id]);
        }
        return redirect()->route('factura')->with('info', 'Registro creado con éxito');
    }

    public function edit(Request $request, $id){
        $dato = Factura::findOrFail($id);
        if ($dato->valor > 0) {
            $operadores = $operador = $ope = $fecha = $desde = $hasta = $viajes = null;
        } else {
            $operadores = Tercero::where('operador', 1)->where('activo', 1)->orderBy('nombre')->get();
            $operador = $operadores->pluck('nombre', 'id');
            $ope = ($request->tercero_id) ? $request->tercero_id : $dato->tercero_id;
            $operadorUno = Tercero::where('id', $ope)->first();
            $fecha = ($request->fecha) ? $request->fecha : $dato->fecha;
            $desde = ($request->desde) ? $request->desde : $dato->desde;
            $hasta = ($request->hasta) ? $request->hasta : $dato->hasta;
            $viajes = Viaje::selectRaw('material_id, materias.nombre, count(valor) as cuenta, avg(valor) as valor, sum(volumen) as volumen, sum(total) as total')
                ->when($operadorUno->operador == 1, function($q) use ($ope) {
                    return $q->where('operador_id', $ope);
                })
                ->when($operadorUno->transporte == 1 && $operadorUno->operador == 0, function($q) use ($ope) {
                    return $q->where('transporte_id', $ope);
                })
                ->whereBetween('fecha', [$desde, $hasta])
                ->where('eliminado', 0)
                ->where('viajes.activo', 1)
                ->whereNull('factura_id')
                ->groupBy('material_id', 'materias.nombre')
                ->join('materias', 'viajes.material_id', '=', 'materias.id')
                ->get();
        }
        return view('mina.empresa.factura.index', ['accion' => 'Editar'], compact('dato', 'operadores', 'operador', 'ope', 'fecha', 'desde', 'hasta', 'viajes'));
    }

    public function update(Request $request, $id){
        $this->validator($request->all())->validate();
        $operadorUno = Tercero::where('id', $request->tercero_id)->first();
        $viajes = Viaje::select('id', 'fecha_nombre', 'volumen', 'valor', 'total')
        ->when($operadorUno->operador == 1, function($q) use ($request) {
            return $q->where('operador_id', $request->tercero_id);
        })
        ->when($operadorUno->transporte == 1 && $operadorUno->operador == 0, function($q) use ($request) {
            return $q->where('transporte_id', $request->tercero_id);
        })->whereBetween('fecha', [$request->desde, $request->hasta])
        ->whereNull('factura_id')
        ->where('eliminado', 0)
        ->where('activo', 1)
        ->get();
        
        if($viajes->count() > 0 && $viajes->sum('total')) {
            $dato = Factura::findOrFail($id);
            $dato->fill([
                'tercero_id' => $request->tercero_id,
                'fecha' => $request->fecha,
                'desde' => $request->desde,
                'hasta' => $request->hasta,
                'valor' => $viajes->sum('total'),
                'volumen' => $viajes->sum('volumen')
            ])->save();
            Viaje::select('id', 'fecha_nombre', 'volumen', 'valor', 'total')
                ->when($operadorUno->operador == 1, function($q) use ($request) {
                    return $q->where('operador_id', $request->tercero_id);
                })
                ->when($operadorUno->transporte == 1 && $operadorUno->operador == 0, function($q) use ($request) {
                    return $q->where('transporte_id', $request->tercero_id);
                })
                ->whereBetween('fecha', [$request->desde, $request->hasta])
                ->whereNull('factura_id')
                ->where('eliminado', 0)
                ->where('activo', 1)
                ->update(['factura_id' => $dato->id]);
        }
        return redirect()->route('factura')->with('info', 'Registro actualizado con éxito');
    }

    public function destroy($id){
        $dato = Factura::findOrFail($id);
        $dato->valor =  0;
        $dato->save();
        Viaje::select('id', 'fecha_nombre', 'volumen', 'valor', 'total')
                ->where('factura_id', $id)
                ->update(['factura_id' => null]);
        return redirect()->route('factura')->with('info', 'Registro actualizado con éxito');
    }

    public function pdf(Request $request, $id){
        $factura = Factura::find($id);
        $viajes = Viaje::select('viajes.fecha', 'vehiculos.placa', 'viajes.id', 'viajes.nro_viaje', 'materias.nombre', 'viajes.volumen')
            ->join('vehiculos', 'viajes.vehiculo_id', '=', 'vehiculos.id')
            ->join('materias', 'viajes.material_id', '=', 'materias.id')
            ->join('gruposubmats', 'viajes.subgrupo_id', '=', 'gruposubmats.id')
            ->where('factura_id', $id)
            ->where('eliminado', 0)
            ->where('viajes.activo', 1)
            ->get();

        $pdf = PDF::loadView('mina.empresa.factura.pdf', compact('viajes', 'factura'));
        return $pdf->download('factura_pdf_'.$id.'.pdf');
        
    }

    public function excel(Request $request, $id){
        return Excel::download(new FacturaExport($id), 'Factura_'.$id.'.xlsx');
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'tercero_id' => 'required|exists:terceros,id',
            'fecha' => 'required|date',
            'desde' => 'required|date',
            'hasta' => 'required|date',
        ]);
    }
}