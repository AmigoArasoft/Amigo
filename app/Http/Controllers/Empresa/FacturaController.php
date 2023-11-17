<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Factura;
use App\Models\Tercero;
use App\Models\Viaje;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FacturaExport;

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
            ->addColumn('activo', 'mina/empresa/factura/tablaActivo')
            ->rawColumns(['botones', 'activo'])
            ->toJson();
    }

    public function create(Request $request){
        $operadores = Tercero::where('operador', 1)->where('activo', 1)->orderBy('nombre')->get();
        $operador = $operadores->pluck('nombre', 'id');
        $ope = ($request->tercero_id) ? $request->tercero_id : $operadores->first()->id;
        $fecha = ($request->fecha) ? $request->fecha : Carbon::now()->firstOfMonth()->toDateString();
        $desde = ($request->desde) ? $request->desde : Carbon::now()->firstOfMonth()->subMonth()->toDateString();
        $hasta = ($request->hasta) ? $request->hasta : Carbon::now()->firstOfMonth()->subDay()->toDateString();
        $viajes = Viaje::selectRaw('material_id, materials.nombre, count(valor) as cuenta, avg(valor) as valor, sum(volumen) as volumen, sum(total) as total')
                ->where('operador_id', $ope)
                ->whereBetween('fecha', [$desde, $hasta])
                ->where('eliminado', 0)
                ->whereNull('factura_id')
                ->groupBy('material_id', 'materials.nombre')
                ->join('materials', 'viajes.material_id', '=', 'materials.id')
                ->get();
        return view('mina.empresa.factura.index', ['accion' => 'Nuevo']
            , compact('operadores', 'operador', 'ope', 'fecha', 'desde', 'hasta', 'viajes')
        );
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        $viajes = Viaje::select('id', 'fecha_nombre', 'volumen', 'valor', 'total')
                ->where('operador_id', $request->tercero_id)
                ->whereBetween('fecha', [$request->desde, $request->hasta])
                ->whereNull('factura_id')->get();
        if($viajes->count() > 0 && $viajes->sum('total')) {
            $dato = Factura::create([
                'tercero_id' => $request->tercero_id,
                'fecha' => $request->fecha,
                'desde' => $request->desde,
                'hasta' => $request->hasta,
                'valor' => $viajes->sum('total'),
            ]);
            Viaje::select('id', 'fecha_nombre', 'volumen', 'valor', 'total')
                ->where('operador_id', $request->tercero_id)
                ->whereBetween('fecha', [$request->desde, $request->hasta])
                ->whereNull('factura_id')
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
            $fecha = ($request->fecha) ? $request->fecha : $dato->fecha;
            $desde = ($request->desde) ? $request->desde : $dato->desde;
            $hasta = ($request->hasta) ? $request->hasta : $dato->hasta;
            $viajes = Viaje::selectRaw('material_id, materials.nombre, count(valor) as cuenta, avg(valor) as valor, sum(volumen) as volumen, sum(total) as total')
                ->where('operador_id', $ope)
                ->whereBetween('fecha', [$desde, $hasta])
                ->where('eliminado', 0)
                ->whereNull('factura_id')
                ->groupBy('material_id', 'materials.nombre')
                ->join('materials', 'viajes.material_id', '=', 'materials.id')
                ->get();
        }
        return view('mina.empresa.factura.index', ['accion' => 'Editar'], compact('dato', 'operadores', 'operador', 'ope', 'fecha', 'desde', 'hasta', 'viajes'));
    }

    public function update(Request $request, $id){
        $this->validator($request->all())->validate();
        $viajes = Viaje::select('id', 'fecha_nombre', 'volumen', 'valor', 'total')
                ->where('operador_id', $request->tercero_id)
                ->whereBetween('fecha', [$request->desde, $request->hasta])
                ->whereNull('factura_id')->get();
        if($viajes->count() > 0 && $viajes->sum('total')) {
            $dato = Factura::findOrFail($id);
            $dato->fill([
                'tercero_id' => $request->tercero_id,
                'fecha' => $request->fecha,
                'desde' => $request->desde,
                'hasta' => $request->hasta,
                'valor' => $viajes->sum('total'),
            ])->save();
            Viaje::select('id', 'fecha_nombre', 'volumen', 'valor', 'total')
                ->where('operador_id', $request->tercero_id)
                ->whereBetween('fecha', [$request->desde, $request->hasta])
                ->whereNull('factura_id')
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
        $viajes = Viaje::select('viajes.fecha', 'vehiculos.placa', 'materials.nombre as material', 'parametros.nombre as submaterial', 'viajes.volumen')
            ->join('vehiculos', 'viajes.vehiculo_id', '=', 'vehiculos.id')
            ->join('materials', 'viajes.material_id', '=', 'materials.id')
            ->join('parametros', 'viajes.submaterial_id', '=', 'parametros.id')
            ->where('factura_id', $id)
            ->where('eliminado', 0)
            ->where('viajes.activo', 1)->get();
        $pdf = PDF::loadView('mina.empresa.factura.pdf', compact('viajes'));
        return $pdf->download('Factura_'.$id.'.pdf');
        
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