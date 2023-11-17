<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use Illuminate\Support\Facades\Validator;

class WelcomeController extends Controller{
    public function index(){
        return view('welcome');
    }

    public function contacto(Request $request) {
        $validador = Validator::make($request->all(), [
            'nombre' => 'required',
            'correo' => 'required|email',
            'mensaje' => 'required'
        ]);
        if ($validador->fails()) {
            return redirect(route('/').'#contacto')
                ->withErrors($validador)
                ->withInput();
        }
        \Mail::send('contacto', array(
            'nombre' => $request->get('nombre'),
            'correo' => $request->get('correo'),
            'mensaje' => $request->get('mensaje'),
        ), function($message) use ($request){
            $message->from($request->correo);
            $message->to('gerencia@garzonromero.com', 'Admin')->subject('Contacto desde garzonromero.com');
        });
        return redirect(route('/').'#contacto')->with('success', 'Hemos recibido su mensaje y nos gustaría agradecerle por escribirnos.');
    }
}