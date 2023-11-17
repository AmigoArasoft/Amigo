<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MinaController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        return view('mina.mina');
    }

    public function clave(){
        return view('auth.clave');
    }

    public function cambio(Request $request){
        $this->validate($request, [
            'current_password' => 'required|min:8',
            'password' => 'required|min:8|confirmed',
        ]);
        $user = Auth::user();
        if(Hash::check($request->current_password, $user->password)){
            $user->password = $request->password;
            if($user->save()){
                return redirect()->route('clave')->with('info', 'Clave actualizada con éxito');
            }
            return redirect()->route('clave')->withErrors('No se pudo actualizar la clave');
        }
        return redirect()->route('clave')->withErrors(['current_password' => 'La clave actual está errada']);
    }
}