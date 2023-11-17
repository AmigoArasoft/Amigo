<?php

namespace App\Http\Controllers\Acceso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Tercero;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller{
    public function __construct(){
        $this->middleware(['permission:Usuario leer|Usuario crear|Usuario editar|Usuario borrar']);
        $this->middleware('mina');
    }

    public function index(Request $request){
        return view('mina.acceso.usuario.index');
    }

    public function list(Request $request){
        if (!$request->ajax()) return redirect('/');
        return datatables()
            ->eloquent(User::select('users.id', 'terceros.nombre as empresa', 'name', 'users.email', 'users.activo')
            ->join('terceros', 'users.tercero_id', '=', 'terceros.id')
            ->with(['roles' => function ($query) {
                $query->select('name')->orderBy('id');
            }]))
            ->addColumn('botones', 'mina.acceso/usuario/tablaBoton')
            ->addColumn('roles', 'mina.acceso/usuario/tablaRol')
            ->addColumn('activo', 'mina.acceso/usuario/tablaActivo')
            ->rawColumns(['botones', 'roles', 'activo'])
            ->toJson();
    }

    public function create(){
        $roles = Role::orderBy('id')->get();
        $tercero = Tercero::where('id', 1)->orWhere('operador', 1)->orderBy('nombre')->pluck('nombre', 'id');
        return view('mina.acceso.usuario.index', ['accion' => 'Nuevo'], compact('roles', 'tercero'));
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        User::create($request->all())->assignRole($request->all()['roles']);
        return redirect()->route('usuario')->with('info', 'Registro creado con éxito');
    }

    public function edit($id){
        $dato = User::findOrFail($id);
        $roles = Role::orderBy('id')->get();
        $tercero = Tercero::where('id', 1)->orWhere('operador', 1)->orderBy('nombre')->pluck('nombre', 'id');
        return view('mina.acceso.usuario.index', ['accion' => 'Editar'], compact('dato', 'roles', 'tercero'));
    }

    public function update(Request $request, $id){
        $this->validatorUpdate($request->all(), $id)->validate();
        $dato = User::findOrFail($id);
        if(empty($request->password)) {
            $dato->update([
                'name' => $request->all()['name'], 
                'email' => $request->all()['email'], 
                'tercero_id' => $request->all()['tercero_id'], 
                'telefono' => $request->all()['telefono']
            ]);
        } else {
            $dato->fill($request->all())->save();
        }
        $dato->syncRoles($request->all()['roles']);
        return redirect()->route('usuario')->with('info', 'Registro actualizado con éxito');
    }

    public function show($id){
        $dato = User::findOrFail($id);
        return view('mina.acceso.usuario.index', ['accion' => 'Borrar'], compact('dato'));
    }

    public function destroy($id){
        $dato = User::findOrFail($id);
        $dato->activo = ($dato->activo == 1) ? 0 : 1;
        $dato->save();
        return redirect()->route('usuario')->with('info', 'Registro inactivado con éxito');
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'telefono' => 'required|min:7|max:255',
            'tercero_id' => 'required|exists:terceros,id',
            'password' => 'required|min:8|max:255',
            'roles' => 'required|array',
        ]);
    }

    protected function validatorUpdate(array $data, $id){
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,'.$id,
            'telefono' => 'required|min:7|max:255',
            'tercero_id' => 'required|exists:terceros,id',
            'password' => 'nullable|min:8|max:255',
            'roles' => 'required|array',
        ]);
    }
}