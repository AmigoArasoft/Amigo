<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Factura extends Model{
	protected $fillable = ['tercero_id', 'fecha', 'desde', 'hasta', 'valor', 'activo', 'volumen'];

	protected static function boot(){
        parent::boot();
        static::creating(function ($tabla) {
            $fecha = Carbon::parse($tabla->fecha);
            $fechaDesde = Carbon::parse($tabla->desde);
            $fechaHasta = Carbon::parse($tabla->hasta);
            $fecha->locale('es');
            $fechaDesde->locale('es');
            $fechaHasta->locale('es');
            $dia = $fecha->isoFormat('D'); 
            $mes = $fecha->isoFormat('MMMM'); 
            $año = $fecha->isoFormat('Y'); 
            $diaDesde = $fechaDesde->isoFormat('D'); 
            $mesDesde = $fechaDesde->isoFormat('MMMM'); 
            $añoDesde = $fechaDesde->isoFormat('Y');
            $diaHasta = $fechaHasta->isoFormat('D'); 
            $mesHasta = $fechaHasta->isoFormat('MMMM'); 
            $añoHasta = $fechaHasta->isoFormat('Y');  
            $output = "{$dia} de {$mes} de {$año}";
            $outputDesde = "{$diaDesde} de {$mesDesde} de {$añoDesde}";
            $outputHasta = "{$diaHasta} de {$mesHasta} de {$añoHasta}";
            
            $tabla->user_create_id = $tabla->user_update_id = (Auth::check()) ? Auth::id() : 1;
            $tabla->fecha_nombre = $output;
            $tabla->desde_nombre = $outputDesde;
            $tabla->hasta_nombre = $outputHasta;
        });
        static::updating(function ($tabla) {
            $fecha = Carbon::parse($tabla->fecha);
            $fechaDesde = Carbon::parse($tabla->desde);
            $fechaHasta = Carbon::parse($tabla->hasta);
            $fecha->locale('es');
            $fechaDesde->locale('es');
            $fechaHasta->locale('es');
            $dia = $fecha->isoFormat('D'); 
            $mes = $fecha->isoFormat('MMMM'); 
            $año = $fecha->isoFormat('Y'); 
            $diaDesde = $fechaDesde->isoFormat('D'); 
            $mesDesde = $fechaDesde->isoFormat('MMMM'); 
            $añoDesde = $fechaDesde->isoFormat('Y');
            $diaHasta = $fechaHasta->isoFormat('D'); 
            $mesHasta = $fechaHasta->isoFormat('MMMM'); 
            $añoHasta = $fechaHasta->isoFormat('Y');  
            $output = "{$dia} de {$mes} de {$año}";
            $outputDesde = "{$diaDesde} de {$mesDesde} de {$añoDesde}";
            $outputHasta = "{$diaHasta} de {$mesHasta} de {$añoHasta}";

            $tabla->user_update_id = (Auth::check()) ? Auth::id() : 1;
            $tabla->fecha_nombre = $output;
            $tabla->desde_nombre = $outputDesde;
            $tabla->hasta_nombre = $outputHasta;
        });
    }

    public function viajes(){
        return $this->hasMany(Viaje::class);
    }

    public function tercero(){
        return $this->belongsTo(Tercero::class, 'tercero_id', 'id');
    }

    public function materiales(){
        return $this->viajes()
            ->selectRaw('material_id, materias.nombre, avg(valor) as valor, sum(volumen) as volumen, sum(total) as total')
            ->groupBy('material_id', 'materias.nombre')
            ->join('materias', 'viajes.material_id', '=', 'materias.id');
    }
}