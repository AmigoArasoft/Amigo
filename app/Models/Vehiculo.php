<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Vehiculo extends Model{
	protected $fillable = ['tercero_id', 'conductor_id', 'placa', 'volumen', 'marca', 'activo'];
	
	protected static function boot(){
        parent::boot();
        static::creating(function ($tabla) {
            $tabla->user_create_id = $tabla->user_update_id = (Auth::check()) ? Auth::id() : 1;
        });
        static::updating(function ($tabla) {
            $tabla->user_update_id = (Auth::check()) ? Auth::id() : 1;
        });
    }

    public function tercero(){
        return $this->belongsTo(Tercero::class);
    }

    public function viajes(){
        return $this->hasMany(Viaje::class);
    }

    public function cubicajes(){
        return $this->hasMany(Cubicaje::class);
    }
}