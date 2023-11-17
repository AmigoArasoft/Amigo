<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Documento;
use App\Models\Tema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller{
    public function __construct(){
        $this->middleware(['permission:Documento leer|Documento crear|Documento editar|Documento borrar']);
        $this->middleware('mina');
    }

    public function index(Request $request){
        return view('mina.empresa.documento.index');
    }

    public function list(Request $request){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Documento::select('documentos.id', 'archivo', 'titulo', 'descripcion', 'temas.nombre as tema', 'parametros.nombre as subtema', 'documentos.activo')
            ->leftJoin('temas', 'tema_id', '=', 'temas.id')
            ->leftJoin('parametros', 'subtema_id', '=', 'parametros.id'))
            ->addColumn('botones', 'mina/empresa/documento/tablaBoton')
            ->addColumn('activo', 'mina/empresa/documento/tablaActivo')
            ->rawColumns(['botones', 'activo'])
            ->toJson();
    }

    public function create(){
        $temas = Tema::where('activo', 1)->orderBy('nombre')->get();
        $tema = $temas->pluck('nombre', 'id');
        $subtema = ['' => 'Seleccione...'];
        foreach ($temas->first()->subtemas as $d) {
            $subtema[$d->id] = $d->nombre;
        }
        return view('mina.empresa.documento.index', ['accion' => 'Nuevo'], compact('temas', 'tema', 'subtema'));
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        $request->merge(['archivo' => Storage::putFile('public/documento', $request->file('documento'))]);
        Documento::create($request->all());
        return redirect()->route('documento')->with('info', 'Registro creado con éxito');
    }

    public function edit($id){
        $dato = Documento::findOrFail($id);
        $temas = Tema::where('activo', 1)->orderBy('nombre')->get();
        $tema = $temas->pluck('nombre', 'id');
        $subtema = ['' => 'Seleccione...'];
        foreach ($temas->where('id', $dato->tema_id)->first()->subtemas as $d) {
            $subtema[$d->id] = $d->nombre;
        }
        return view('mina.empresa.documento.index', ['accion' => 'Editar'], compact('dato', 'temas', 'tema', 'subtema'));
    }

    public function update(Request $request, $id){
        $this->validatorUpdate($request->all(), $id)->validate();
        $dato = Documento::findOrFail($id);
        if($request->file('documento')){
            Storage::delete($dato->archivo);
            $request->merge(['archivo' => Storage::putFile('public/documento', $request->file('documento'))]);
        }
        $dato->fill($request->all())->save();
        return redirect()->route('documento')->with('info', 'Registro actualizado con éxito');
    }

    public function destroy($id){
        $dato = Documento::findOrFail($id);
        $dato->activo = ($dato->activo == 1) ? 0 : 1;
        $dato->save();
        return redirect()->route('documento')->with('info', 'Registro actualizado con éxito');
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'titulo' => 'required|string|max:150|unique:documentos',
            'descripcion' => 'required|string|max:255',
            'tema_id' => 'required|exists:temas,id',
            'subtema_id' => 'nullable|exists:parametros,id',
            'documento' => 'required|file',
        ]);
    }

    protected function validatorUpdate(array $data, $id){
        return Validator::make($data, [
            'titulo' => 'required|string|max:150|unique:documentos,titulo,'.$id,
            'descripcion' => 'required|string|max:255',
            'tema_id' => 'required|exists:temas,id',
            'subtema_id' => 'nullable|exists:parametros,id',
        ]);
    }
}