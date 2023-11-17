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
            ->eloquent(Documento::select('id', 'archivo', 'titulo', 'descripcion', 'activo'))
            ->addColumn('botones', 'mina/empresa/documento/tablaBoton')
            ->addColumn('activo', 'mina/empresa/documento/tablaActivo')
            ->rawColumns(['botones', 'activo'])
            ->toJson();
    }

    public function create(){
        return view('mina.empresa.documento.index', ['accion' => 'Nuevo']);
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        $request->merge(['archivo' => Storage::putFile('public/documento', $request->file('documento'))]);
        Documento::create($request->all());
        return redirect()->route('documento')->with('info', 'Registro creado con éxito');
    }

    public function edit($id){
        $dato = Documento::findOrFail($id);
        return view('mina.empresa.documento.index', ['accion' => 'Editar'], compact('dato'));
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
            'documento' => 'required|file',
        ]);
    }

    protected function validatorUpdate(array $data, $id){
        return Validator::make($data, [
            'titulo' => 'required|string|max:150|unique:documentos,titulo,'.$id,
            'descripcion' => 'required|string|max:255',
        ]);
    }
}