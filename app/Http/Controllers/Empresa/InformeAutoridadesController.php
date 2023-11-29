<?php

namespace App\Http\Controllers\Empresa;

use Carbon\Carbon;
use App\Models\Tope;

use App\Models\Viaje;
use App\Models\Factura;
use Illuminate\Http\Request;
use App\Exports\FacturaExport;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class InformeAutoridadesController extends Controller{
    public function __construct(){
        $this->middleware(['permission:Factura leer|Factura crear|Factura editar|Factura borrar']);
    }

    public function index(Request $request){
        return view('mina.empresa.facturaAutoridades.index');
    }

    public function list(Request $request){
        $tope = Tope::first()->tope;

        $facturas = Factura::select('id', 'volumen', 'fecha')
        ->whereBetween('fecha', [$request->desde, $request->hasta])
        ->get();

        $facturaArray = [];
        $suma = 0;
        foreach($facturas as $fac){
            if($fac->volumen > 0){
                $facturaSuma = $fac->volumen + $suma;
            }else{
                $viajes = Viaje::where('factura_id', $fac->id)->get();
                $facturaSuma = $viajes->sum('volumen') + $suma;
            }

            if($facturaSuma <= $tope){
                array_push($facturaArray, $fac->id);
                $suma = $facturaSuma;
            }
        }

        return datatables()
            ->eloquent(
                Factura::select('facturas.id', 'terceros.nombre as operador', 'facturas.fecha_nombre as fecha', 'facturas.desde_nombre as desde', 
                'facturas.hasta_nombre as hasta', 'facturas.valor', 'facturas.activo')
                ->when(Auth::user()->tercero_id != 1, function($q){
                    return $q->where('tercero_id', Auth::user()->tercero_id);
                })
                ->join('terceros', 'facturas.tercero_id', '=', 'terceros.id')
                ->whereIn('facturas.id', $facturaArray)
            )
            ->addColumn('botones', 'mina/empresa/facturaAutoridades/tablaBoton')
            ->addColumn('metros', function (Factura $factura) {
                return $factura->viajes->sum('volumen');
            })
            ->addColumn('activo', 'mina/empresa/facturaAutoridades/tablaActivo')
            ->rawColumns(['botones', 'activo'])
            ->toJson();
    }

    public function tope(Request $request){
        if(isset($request->tope)){
            $dato = Tope::get()->count();
            if($dato <= 0){
                Tope::create([
                    'tope' => $request->tope
                ]);
            }else{
                Tope::where('id', 1)->update([
                    'tope' => $request->tope
                ]);
            }

            return redirect()->route('tope')->with('info', 'Tope actualizado correctamente');
        }

        $tope = Tope::first();
        return view('mina.tope', compact('tope'));
    }
}