<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Viaje extends Model{
    protected $fillable = ['fecha', 'factura', 'vehiculo_id', 'conductor_nombre', 'operador_id', 'transporte_id', 'material_id', 'subgrupo_id', 'frente_id', 'volumen', 'valor', 'activo', 'nro_viaje', 'destino', 'cliente'];

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
            $tabla->total = $tabla->volumen * $tabla->valor;
        });
        static::updating(function ($tabla) {
            $fecha = Carbon::parse($tabla->fecha);
            $fecha->locale('es');
            $dia = $fecha->isoFormat('Do'); 
            $mes = $fecha->isoFormat('MMMM'); 
            $año = $fecha->isoFormat('Y'); 
            $output = "{$dia} de {$mes} de {$año}";

            $tabla->user_update_id = (Auth::check()) ? Auth::id() : 1;
            $tabla->fecha_nombre = $output;
            $tabla->total = $tabla->volumen * $tabla->valor;
        });
    }

    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class);
    }

    public function usuarioCreado(){
        return $this->belongsTo(User::class, 'user_create_id');
    }
    
    public function conductor(){
        return $this->belongsTo(Tercero::class, 'conductor_id');
    }

    public function operador(){
        return $this->belongsTo(Tercero::class, 'operador_id');
    }

    public function transporte(){
        return $this->belongsTo(Tercero::class, 'transporte_id');
    }

    public function material(){
        return $this->belongsTo(Materia::class, 'material_id');
    }

    public function subgrupo(){
        return $this->belongsTo(Gruposubmat::class, 'subgrupo_id');
    }

    public function frente(){
        return $this->belongsTo(Parametro::class, 'frente_id');
    }
}