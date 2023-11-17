<?php

namespace App\Http\Controllers\Acceso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class PermisoController extends Controller{
    public function __construct(){
        $this->middleware(['permission:Permiso leer|Permiso crear|Permiso editar|Permiso borrar']);
        $this->middleware('mina');
    }

    public function index(Request $request){
        return view('mina.acceso.permiso.index');
    }

    public function list(Request $request){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Permission::select('id', 'name'))
            ->addColumn('botones', 'mina/acceso/permiso/tablaBoton')
            ->rawColumns(['botones'])
            ->toJson();
    }

    public function create(){
        return view('mina.acceso.permiso.index', ['accion' => 'Nuevo']);
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        Permission::create($request->all());
        return redirect()->route('permiso')->with('info', 'Registro creado con éxito');
    }

    public function edit($id){
        $dato = Permission::findOrFail($id);
        return view('mina.acceso.permiso.index', ['accion' => 'Editar'], compact('dato'));
    }

    public function update(Request $request, $id){
        $this->validatorUpdate($request->all(), $id)->validate();
        $dato = Permission::findOrFail($id);
        $dato->fill($request->all())->save();
        return redirect()->route('permiso')->with('info', 'Registro actualizado con éxito');
    }

    public function show($id){
        $dato = Permission::findOrFail($id);
        return view('mina.acceso.permiso.index', ['accion' => 'Borrar'], compact('dato'));
    }

    public function destroy($id){
        Permission::findOrFail($id)->delete();
        return redirect()->route('permiso')->with('info', 'Registro eliminado con éxito');
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:permissions',
        ]);
    }

    protected function validatorUpdate(array $data, $id){
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:permissions,name,'.$id,
        ]);
    }
}