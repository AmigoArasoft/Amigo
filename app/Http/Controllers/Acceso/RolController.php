<?php

namespace App\Http\Controllers\Acceso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RolController extends Controller{
    public function __construct(){
        $this->middleware(['permission:Rol leer|Rol crear|Rol editar|Rol borrar']);
        $this->middleware('mina');
    }

    public function index(Request $request){
        return view('mina.acceso.rol.index');
    }

    public function list(Request $request){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(Role::select('id', 'name')
            ->with(['permissions' => function ($query) {
                $query->select('name')->orderBy('id');
            }]))
            ->addColumn('botones', 'mina/acceso/rol/tablaBoton')
            ->addColumn('permisos', 'mina/acceso/rol/tablaPermiso')
            ->rawColumns(['botones', 'permisos'])
            ->toJson();
    }

    public function create(){
        $permissions = Permission::orderBy('id')->get();
        return view('mina.acceso.rol.index', ['accion' => 'Nuevo'], compact('permissions'));
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        Role::create(['name' => $request->all()['name'], 'guard_name' => 'web',])
            ->givePermissionTo($request->all()['permissions']);
        return redirect()->route('rol')->with('info', 'Registro creado con éxito');
    }

    public function edit($id){
        $dato = Role::findOrFail($id);
        $permissions = Permission::orderBy('id')->get();
        return view('mina.acceso.rol.index', ['accion' => 'Editar'], compact('dato', 'permissions'));
    }

    public function update(Request $request, $id){
        $this->validatorUpdate($request->all(), $id)->validate();
        $dato = Role::findOrFail($id);
        $dato->update(['name' => $request->all()['name']]);
        $dato->syncPermissions($request->all()['permissions']);
        return redirect()->route('rol')->with('info', 'Registro actualizado con éxito');
    }

    public function show($id){
        $dato = Role::findOrFail($id);
        return view('mina.acceso.rol.index', ['accion' => 'Borrar'], compact('dato'));
    }

    public function destroy($id){
        Role::findOrFail($id)->delete();
        return redirect()->route('rol')->with('info', 'Registro eliminado con éxito');
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:roles',
            'permissions' => 'required|array',
        ]);
    }

    protected function validatorUpdate(array $data, $id){
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:roles,name,'.$id,
            'permissions' => 'required|array',
        ]);
    }
}