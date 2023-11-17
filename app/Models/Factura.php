<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Factura extends Model{
	protected $fillable = ['tercero_id', 'fecha', 'desde', 'hasta', 'valor', 'activo'];

	protected static function boot(){
        parent::boot();
        static::creating(function ($tabla) {
            $tabla->user_create_id = $tabla->user_update_id = (Auth::check()) ? Auth::id() : 1;
            $tabla->fecha_nombre = Carbon::parse($tabla->fecha)->formatLocalized('%d de %B de %Y');
            $tabla->desde_nombre = Carbon::parse($tabla->desde)->formatLocalized('%d de %B de %Y');
            $tabla->hasta_nombre = Carbon::parse($tabla->hasta)->formatLocalized('%d de %B de %Y');
        });
        static::updating(function ($tabla) {
            $tabla->user_update_id = (Auth::check()) ? Auth::id() : 1;
            $tabla->fecha_nombre = Carbon::parse($tabla->fecha)->formatLocalized('%d de %B de %Y');
            $tabla->desde_nombre = Carbon::parse($tabla->desde)->formatLocalized('%d de %B de %Y');
            $tabla->hasta_nombre = Carbon::parse($tabla->hasta)->formatLocalized('%d de %B de %Y');
        });
    }

    public function viajes(){
        return $this->hasMany(Viaje::class);
    }

    public function materiales(){
        return $this->viajes()
            ->selectRaw('material_id, materials.nombre, avg(valor) as valor, sum(volumen) as volumen, sum(total) as total')
            ->groupBy('material_id', 'materials.nombre')
            ->join('materials', 'viajes.material_id', '=', 'materials.id');
    }
}