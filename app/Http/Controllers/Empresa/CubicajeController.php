<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cubicaje;
use App\Models\Tercero;
use App\Models\Vehiculo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class CubicajeController extends Controller{
    public function __construct(){
        $this->middleware(['permission:Cubicaje leer|Cubicaje crear|Cubicaje editar|Cubicaje borrar']);
    }

    public function index(Request $request){
        return view('mina.empresa.cubicaje.index');
    }

    public function list(Request $request){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Cubicaje::select('cubicajes.id', 'cubicajes.fecha_nombre as fecha', 'terceros.nombre as operador', 'vehiculos.placa as placa', 'cubicajes.volumen as volumen', 'cubicajes.activo')
                ->when(Auth::user()->tercero_id != 1, 
                    function($q){
                        return $q->where('tercero_id', Auth::user()->tercero_id);
                    })
                ->join('vehiculos', 'cubicajes.vehiculo_id', '=', 'vehiculos.id')
                ->join('terceros', 'cubicajes.tercero_id', '=', 'terceros.id'))
            ->addColumn('botones', 'mina/empresa/cubicaje/tablaBoton')
            ->addColumn('activo', 'mina/empresa/cubicaje/tablaActivo')
            ->rawColumns(['botones', 'activo'])
            ->toJson();
    }

    public function create(Request $request){
        $fecha = ($request->fecha) ? $request->fecha : Carbon::now()->toDateString();
        $operadores = Tercero::where('operador', 1)->where('activo', 1)->orderBy('nombre')->get();
        $terceros = $operadores->pluck('nombre', 'id');
        $vehiculos = $operadores->first()->transportesVehiculos()->get()->sortBy('placa')->pluck('placa', 'id');
        return view('mina.empresa.cubicaje.index', ['accion' => 'Nuevo'], compact('fecha', 'operadores', 'terceros', 'vehiculos')
        );
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        $dato = Cubicaje::create($request->all());
        $vehiculo = Vehiculo::findOrFail($dato->vehiculo_id);
        $vehiculo->update(['volumen' => $dato->volumen]);
        return redirect()->route('cubicaje')->with('info', 'Registro creado con éxito');
    }

    public function edit(Request $request, $id){
        $dato = Cubicaje::findOrFail($id);
        $operadores = Tercero::where('operador', 1)->where('activo', 1)->orderBy('nombre')->get();
        $terceros = $operadores->pluck('nombre', 'id');
        $vehiculos = $operadores->first()->transportesVehiculos()->get()->sortBy('placa')->pluck('placa', 'id');
        return view('mina.empresa.cubicaje.index', ['accion' => 'Editar'], compact('dato', 'operadores', 'terceros', 'vehiculos'));
    }

    public function update(Request $request, $id){
        $this->validator($request->all())->validate();
        $dato = Cubicaje::findOrFail($id);
        $dato->fill($request->all())->save();
        $vehiculo = Vehiculo::findOrFail($dato->vehiculo_id);
        $vehiculo->update(['volumen' => $dato->volumen]);
        return redirect()->route('cubicaje')->with('info', 'Registro actualizado con éxito');
    }

    public function destroy($id){
        $dato = Cubicaje::findOrFail($id);
        $dato->activo = ($dato->activo == 1) ? 0 : 1;
        $dato->save();
        return redirect()->route('cubicaje')->with('info', 'Registro actualizado con éxito');
    }

    public function pdf(Request $request, $id){
        $cubicaje = Cubicaje::find($id);
        $pdf = PDF::loadView('mina.empresa.cubicaje.pdf', compact('cubicaje'))->setPaper('letter', 'portrait');
        return $pdf->download('Cubicaje_'.$id.'.pdf');
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'tercero_id' => 'required|exists:terceros,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'fecha' => 'required|date',
            'volumen_ancho' => 'required|numeric|gt: 0',
            'volumen_largo' => 'required|numeric|gt: 0',
            'volumen_alto' => 'required|numeric|gt: 0',
            'gato_mayor' => 'required|numeric|min: 0',
            'gato_menor' => 'required|numeric|min: 0',
            'gato_alto' => 'required|numeric|min: 0',
            'gato_ancho' => 'required|numeric|min: 0',
            'borde_base' => 'required|numeric|min: 0',
            'borde_alto' => 'required|numeric|min: 0',
            'borde_largo' => 'required|numeric|min: 0',
            'observacion' => 'nullable|string|max:255',
            'titular' => 'required|string|max:50',
            'operador' => 'required|string|max:50',
            'transportador' => 'required|string|max:50',
        ]);
    }
}