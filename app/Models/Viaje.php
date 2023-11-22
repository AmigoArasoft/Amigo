<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Viaje extends Model{
    protected $fillable = ['fecha', 'factura', 'vehiculo_id', 'conductor_id', 'operador_id', 'transporte_id', 'material_id', 'subgrupo_id', 'frente_id', 'volumen', 'valor', 'activo', 'nro_viaje'];

    protected static function boot(){
        parent::boot();
        static::creating(function ($tabla) {
            $tabla->user_create_id = $tabla->user_update_id = (Auth::check()) ? Auth::id() : 1;
            $tabla->fecha_nombre = Carbon::parse($tabla->fecha)->formatLocalized('%d de %B de %Y');
            $tabla->total = $tabla->volumen * $tabla->valor;
        });
        static::updating(function ($tabla) {
            $tabla->user_update_id = (Auth::check()) ? Auth::id() : 1;
            $tabla->fecha_nombre = Carbon::parse($tabla->fecha)->formatLocalized('%d de %B de %Y');
            $tabla->total = $tabla->volumen * $tabla->valor;
        });
    }

    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class);
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