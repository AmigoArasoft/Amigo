<?php

namespace App\Http\Controllers;

use PDF;
use URL;

use Carbon\Carbon;
use App\Models\Viaje;
use Illuminate\Http\Request;

use App\Mail\CertificadoOrigen;
use App\Mail\Vale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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

    public function sendEmailCorreos(Request $request){
        try {
            $emails = explode(",", $request->emails);
            $dato = Viaje::findOrFail($request->id);
            $carpeta = (substr(URL::current(), 0, 16) == 'http://localhost') ? '' : '/mina_app';
            $lugarDocumento = $request->tipo_documento == "origen" ? 'public/pdf/certificado_origen.pdf' : 'public/pdf/vale.pdf';
            $pdf = $request->tipo_documento == "origen" ? PDF::loadView('mina.empresa.viaje.origen', compact('dato', 'carpeta')) : PDF::loadView('mina.empresa.viaje.vale', compact('dato', 'carpeta'));
            Storage::put($lugarDocumento, $pdf->output());
            if($request->tipo_documento == "origen"){
                $mail = new CertificadoOrigen($lugarDocumento, $dato->id);
            }else{
                $mail = new Vale($lugarDocumento, $dato->id);
            }
            Mail::to($emails)->send($mail);
            return redirect()->route('viaje')->with('info', $request->tipo_documento == "origen" ? 'Certificado de origen enviado correctamente' : 'Vale enviado correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('viaje')->with('error', 'Error al enviar el correo electrónico'.$th->getMessage());
        }
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