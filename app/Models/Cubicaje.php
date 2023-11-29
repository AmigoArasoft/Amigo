<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Cubicaje extends Model{
    use HasFactory;
    protected $fillable = ['fecha', 'fecha_nombre', 'tercero_id', 'vehiculo_id', 'volumen_ancho', 'volumen_largo', 
    'volumen_alto', 'gato_mayor', 'gato_menor', 'gato_alto', 'gato_ancho', 'borde_base', 'borde_alto', 'borde_largo', 
    'volumen', 'titular', 'operador', 'transportador', 'observacion', 'activo', 'user_create_id', 'user_update_id'];

    protected static function boot(){
        parent::boot();
        static::creating(function ($tabla) {
            $fecha = Carbon::parse($tabla->fecha);
            $fecha->locale('es');
            $dia = $fecha->isoFormat('D'); 
            $mes = $fecha->isoFormat('MMMM'); 
            $año = $fecha->isoFormat('Y'); 
            $output = "{$dia} de {$mes} de {$año}";
            $tabla->user_create_id = $tabla->user_update_id = (Auth::check()) ? Auth::id() : 1;
            $tabla->fecha_nombre = $output;
            $tabla->volumen = ($tabla->volumen_ancho * $tabla->volumen_largo * $tabla->volumen_alto)
                - ((($tabla->gato_mayor + $tabla->gato_menor)/2) * $tabla->gato_alto * $tabla->gato_ancho)
                - ((($tabla->borde_base * $tabla->borde_alto)/2) * $tabla->borde_largo * 2);
        });
        static::updating(function ($tabla) {
            $fecha = Carbon::parse($tabla->fecha);
            $fecha->locale('es');
            $dia = $fecha->isoFormat('D'); 
            $mes = $fecha->isoFormat('MMMM'); 
            $año = $fecha->isoFormat('Y'); 
            $output = "{$dia} de {$mes} de {$año}";
            $tabla->user_update_id = (Auth::check()) ? Auth::id() : 1;
            $tabla->fecha_nombre = $output;
            $tabla->volumen = ($tabla->volumen_ancho * $tabla->volumen_largo * $tabla->volumen_alto)
                - ((($tabla->gato_mayor + $tabla->gato_menor)/2) * $tabla->gato_alto * $tabla->gato_ancho)
                - ((($tabla->borde_base * $tabla->borde_alto)/2) * $tabla->borde_largo * 2);
        });
    }

    public function tercero(){
        return $this->belongsTo(Tercero::class);
    }

    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class);
    }
}